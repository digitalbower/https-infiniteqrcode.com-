<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\SetupIntent;
use Stripe\PaymentIntent;
use App\Models\User;
use App\Models\UserSubscription;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentMethod;
use App\Mail\SubscriptionPlanChange;
use App\Mail\SubscriptionRenewedMail;

class StripController extends Controller
{
    public function createSetupIntent()
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $user = Auth::user();
            if (!$user->stripe_customer_id) {
                $customer = Customer::create([
                    'email' => $user->email,
                    'name' => $user->firstname,
                ]);

                $user->stripe_customer_id = $customer->id;
                $user->save();
            }else {
                $customer = Customer::retrieve($user->stripe_customer_id);
            }

            $setupIntent = SetupIntent::create([
                'customer' => $user->stripe_customer_id, 
                'usage' => 'off_session',  // Optional, depending on your use case
            ]);
            return response()->json(['clientSecret' => $setupIntent->client_secret]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function createPaymentIntent(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method_id' => 'required|string',
        ]);
        
        Stripe::setApiKey(config('services.stripe.secret'));

        $user = auth()->user();

        $amount = intval($request->amount * 100);

        if ($amount <= 0) {
            \Log::error('Invalid amount detected', ['user_id' => $user->id, 'amount' => $amount]);
            return response()->json(['error' => 'Invalid amount.'], 400);
        }
       try {
            \Log::info('Creating PaymentIntent', ['user_id' => $user->id, 'amount' => $amount]);

                $paymentIntent = PaymentIntent::create([
                    'amount' => $amount,
                    'currency' => 'usd',
                    'customer' => $user->stripe_customer_id,
                    'payment_method' => $request->payment_method_id,
                    'confirmation_method' => 'automatic',
                    'confirm' => true,
                    'setup_future_usage' => 'off_session',
                    'receipt_email' => $user->email,
                    'return_url' => url('/stripe/subscribe'),

                ]);

            \Log::info('PaymentIntent created', ['status' => $paymentIntent->status]);

                if ($paymentIntent->status === 'requires_action') {
                    return response()->json([
                        'success' => false,
                        'requires_action' => true,
                        'payment_intent_client_secret' => $paymentIntent->client_secret,
                        'payment_intent_id' => $paymentIntent->id,
                    ]);
                }
                return response()->json([
                    'success' => true,
                    'payment_intent' => $paymentIntent, 
                ]);
            
           
    
        } catch (\Stripe\Exception\ApiErrorException $e) {
            \Log::error('Stripe API Error', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            \Log::error('Unexpected Error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Unexpected error occurred.'], 500);
        }
    }
    public function subscribe(Request $request)
    { 
        $request->validate([
            'payment_method_id' => 'required|string',
            'plan' => 'required|string',
            'duration' => 'required|in:30,365',
            'price' => 'required|numeric',
            'setup_intent_id' => 'required|string',
        ]);
    
        Stripe::setApiKey(config('services.stripe.secret'));
        DB::beginTransaction();
    
        try {
           
            if (!auth()->check()) {
                \Log::error('Unauthorized access attempt.');
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $user = Auth::user();
    
            // Ensure no duplicate active subscriptions
            
            $newPlan = trim($request->plan);
            \Log::error("plan",['plan'=>$newPlan]);
            $existingPlan = $user->plan;
            // if ($existingPlan === $newPlan && $user->subscribe_status === 'Active' && $user->payment_failed_at === null) {
            //     return response()->json(['success' => false, 'message' => 'Already subscribed.']);
            // }
           
            $duration = $request->duration == '30' ? 'monthly' : 'yearly';
            
            \Log::error("duration",['duration'=>$duration]);
            $amount = intval($request->price * 100); // Convert to cents
            $setupIntent = SetupIntent::retrieve($request->setup_intent_id); 
            $paymentMethodId = $setupIntent->payment_method;
            \Log::error("paymentMethodId",['paymentMethodId'=>$paymentMethodId]);

            // Attach new payment method
            $customer = Customer::retrieve($user->stripe_customer_id);

            $currentDefaultPaymentMethod = $customer->invoice_settings->default_payment_method ?? null;
            if ($currentDefaultPaymentMethod !== $paymentMethodId) {
                \Stripe\Customer::update(
                    $user->stripe_customer_id,
                    ['invoice_settings' => ['default_payment_method' => $paymentMethodId]]
                );
            }
            if (!$paymentMethodId) {
                \Log::error('Failed to retrieve payment method.', ['setup_intent_id' => $request->setup_intent_id]);
                throw new \Exception('Failed to retrieve payment method.');
            }
            $startDate = now();
            $endDate = ($duration === 'monthly') ? $startDate->copy()->addMonth() : $startDate->copy()->addYear();
            $startDate = $startDate->format('Y-m-d H:i:s');
            $endDate = $endDate->format('Y-m-d H:i:s');
            // Reuse existing PaymentIntent if available
            if ($request->payment_intent_id) {
                $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            }    
            \Log::error("paymentIntent",['paymentIntent'=>$paymentIntent]);

            // Retrieve charge details
            $chargeId = $paymentIntent->latest_charge;
            if (!$chargeId) {
                \Log::error('PaymentIntent did not generate a charge.', ['payment_intent_id' => $paymentIntent->id]);
                throw new \Exception('PaymentIntent did not generate a charge.');
            }
    
            $charge = \Stripe\Charge::retrieve($chargeId);
            $receiptUrl = $charge->receipt_url ?? null;
    
            // Update subscription and user records
             UserSubscription::create(
                [
                'stripe_payment_intent_id' => $paymentIntent->id,
                'stripe_customer_id' => $user->stripe_customer_id,
                'user_id' => $user->id,
                'plan_id' => $newPlan,
                'default_payment_method' => $paymentMethodId,
                'paid_amount' => $request->price,
                'plan_interval' => $duration,
                'customer_name' => $user->firstname . ' ' . $user->lastname,
                'customer_email' => $user->email,
                'plan_period_start' => $startDate,
                'plan_period_end' => $endDate,
                'status' => 'Active',
                'ReceiptURL' => $receiptUrl,
            ]);
    
            $user->update([
                'payment_method_id' => $paymentMethodId,
                'payment_intent_id' => $paymentIntent->id,
                'subscribe_status' => 'Active',
                'renew_status' => 'Enabled',
                'plan' => $newPlan,
                'duration' => $duration,
                'subscription_start' => $startDate,
                'subscription_end' => $endDate,
                'price'=>$request->price ?? $user->price
            ]);
    
            // Send confirmation email
            // Mail::send('emails.subscription', ['user' => $user, 'plan' => $newPlan, 'endDate' => $endDate], function ($message) use ($user, $newPlan) {
            //     $message->to($user->email)->subject("Welcome to Plan {$newPlan} - Your Upgrade Is Complete!");
            // });
              Mail::to($user->email)->send(new SubscriptionPlanChange($user, $newPlan, $endDate, $request->price, $existingPlan));

            if($user->payment_failed_at){
                session()->forget('showPaymentPopup');
                $user->update(['payment_failed_at' => null]);
                //Add Mail Subject::Your Subscription has been Renewed
                 Mail::to($user->email)->send(new SubscriptionRenewedMail($user, $newPlan,  $endDate, $request->price));
            }
            DB::commit();
            return response()->json(['success' => true, 'receipt_url' => $receiptUrl]);
    
        } catch (\Stripe\Exception\CardException $e) {
            DB::rollBack();
            \Log::error('Card declined:', ['message' => $e->getMessage()]);
            return response()->json(['error' => $this->handleStripeError($e)], 400);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            DB::rollBack();
            \Log::error('Stripe API error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Stripe API error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('General error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    private function handleStripeError($e)
    {
        $error = $e->getError();
        switch ($error->code) {
            case 'card_declined': return "Your card was declined.";
            case 'expired_card': return "Your card has expired.";
            case 'incorrect_cvc': return "Incorrect CVC code.";
            case 'processing_error': return "Processing error, try again.";
            case 'insufficient_funds': return "Insufficient funds.";
            case 'authentication_required': return "Authentication required.";
            default: return $error->message ?? "Payment error.";
        }
    }
    public function savePaymentCard(Request $request)
    {
        // Validate request
        $request->validate([
            'customerid' => 'required|string',
            'amount' => 'required|numeric',
            'paymentMethodId' => 'required|string',
        ]);

        try {
            // Set Stripe API Key
            Stripe::setApiKey(config('services.stripe.secret'));

            // Retrieve request data
            $customerId = $request->customerid ?? Auth::user()->strip_customer_id;
            $amount = $request->amount * 100; // Convert to cents
            $paymentMethodId = $request->paymentMethodId;

            // Attach the payment method to the customer
            $paymentMethod = PaymentMethod::retrieve($paymentMethodId); 
            $paymentMethod->attach(['customer' => $customerId]);

            // Create a PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'customer' => $customerId,
                'setup_future_usage' => 'off_session',
                'payment_method' => $paymentMethodId,
                'confirm' => true,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',
                ],
            ]);

            // Update user's payment method in database
            DB::transaction(function () use ($customerId, $paymentMethodId) {
                $user = User::where('stripe_customer_id', $customerId)->first();
                $user->payment_method_id = $paymentMethodId;
                $user->save();
            });

            return response()->json([
                'message' => 'Payment successful!',
                'clientSecret' => $paymentIntent->client_secret
            ], 200);

        } catch (\Stripe\Exception\CardException $e) {
            return response()->json(['error' => 'Stripe Card Error: ' . $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    public function getCustomerPaymentMethods(Request $request)
    {
        // Validate request
        $request->validate([
            'customer_id' => 'required|string',
        ]);
        
        try {
            // Set Stripe API Key from .env
            Stripe::setApiKey(config('services.stripe.secret'));

            // Now you can use $user->stripe_id safely

            $customerId = $request->customer_id ?? Auth::user()->strip_customer_id;

            $cardDetails = [];

            // Retrieve customer's payment methods
            $paymentMethods = PaymentMethod::all([
                'customer' => $customerId,
                'type' => 'card',
            ]);

            $customer = Customer::retrieve($customerId); 
            $defaultCardId = $customer->invoice_settings->default_payment_method ?? '';

            $defaultSet = !empty($defaultCardId); // Check if a default card is already set

            foreach ($paymentMethods->data as $paymentMethod) {
                $card = $paymentMethod->card;
                
                if ($card) {
                    // Set default card if none is set
                    if (!$defaultSet) {
                        $customer->invoice_settings->default_payment_method = $paymentMethod->id;
                        $customer->save();
                        $defaultCardId = $paymentMethod->id;
                        $defaultSet = true;
                    }

                    $cardDetails[] = [
                        'id' => $paymentMethod->id,
                        'brand' => $card->brand,
                        'last4' => $card->last4,
                        'exp_month' => $card->exp_month,
                        'exp_year' => $card->exp_year,
                        'default' => $paymentMethod->id === $defaultCardId,
                    ];
                }
            } 

            return response()->json([
                'success' => true,
                'card' => $cardDetails,
            ]);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function updateDefaultCard(Request $request)
    {
        // Validate request
        $request->validate([
            'cardId' => 'required|string',
            'customerid' => 'required|string',
        ]);

        try {
            // Set Stripe API Key from .env
            Stripe::setApiKey(config('services.stripe.secret'));

            // Retrieve request data
            $cardId = $request->cardId;
            $customerId = $request->customerid;

            // Update the default payment method for the customer
            $customer = Customer::update($customerId, [
                'invoice_settings' => [
                    'default_payment_method' => $cardId,
                ],
            ]);
          
            return response()->json([
                'success' => true,
                'message' => 'Default card updated successfully.',
            ]);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
