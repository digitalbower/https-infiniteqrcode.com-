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
use App\Models\Subscription;
use App\Models\UserSubscription;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentMethod;

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
            }

            $setupIntent = SetupIntent::create([
                'customer' => $user->stripe_customer_id, 
            ]);

            return response()->json(['clientSecret' => $setupIntent->client_secret]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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
        try{

            DB::beginTransaction();

            Stripe::setApiKey(config('services.stripe.secret'));

            $data = $request->all(); 

            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            // Fetch user details
            $existingPlan = $user->plan;
            $newPlan = trim($request->plan);
            if ($existingPlan === $newPlan && $user->subscribe_status === 'Active') {
                return response()->json(['success' => false, 'message' => 'Already subscribed.']);
            }

            $duration = $request->duration == '30' ? 'monthly' : 'yearly';
            $amount = intval($request->price * 100); // Convert to cents
            $setupIntent = SetupIntent::retrieve($request->setup_intent_id);
            $paymentMethodId = $setupIntent->payment_method;

            // Create Stripe Customer (or retrieve existing)
            if (!$user->stripe_customer_id) {
                $customer = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'payment_method' => $paymentMethodId,
                    'invoice_settings' => ['default_payment_method' => $paymentMethodId],
                ]);
                $user->stripe_customer_id = $customer->id;
                $user->save();
            } else {
                $customer = Customer::retrieve($user->stripe_customer_id);
            }
            // Calculate subscription end date based on duration
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d', strtotime(
                $duration === 'daily' ? '+1 day' : ($duration === 'monthly' ? '+1 month' : '+1 year')
            ));
            $startDate = now();
            $endDate = ($duration === 'monthly') ? now()->addMonth() : now()->addYear();
            // Create PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'customer' => $customer->id,
                'payment_method' => $paymentMethodId,
                'confirmation_method' => 'automatic',
                'confirm' => true,
                'setup_future_usage' => 'off_session',
                'receipt_email' => $user->email,
                'return_url' => 'https://infiniteqrcode.com/return',
            ]);
            
            if ($paymentIntent->status === 'requires_action' && $paymentIntent->next_action->type === 'use_stripe_sdk') {
                return response()->json([
                    'success' => false,
                    'requires_action' => true,
                    'payment_intent_client_secret' => $paymentIntent->client_secret
                ]);
            }
            $chargeId = $paymentIntent->latest_charge;
            $charge = \Stripe\Charge::retrieve($chargeId);
            $receiptUrl = $chargeId ? $charge->receipt_url : null; 
            // if (!$chargeId) {
            //     return response()->json(['success' => false, 'error' => 'PaymentIntent did not generate a charge.']);
            // }
        
            // try {
            //     $charge = $paymentIntent->charges->data[0] ?? null;
            //     if ($charge) {
            //         $receiptUrl = $charge->receipt_url;
            //     }
            // } catch (\Stripe\Exception\ApiErrorException $e) {
            //     return response()->json(['success' => false, 'error' => 'Failed to retrieve charge: ' . $e->getMessage()]);
            // }
            
            // Store subscription in DB
            $subscription = UserSubscription::create([
                'user_id' => $user->id,
                'plan_id' => $newPlan,
                'stripe_customer_id' => $customer->id,
                'stripe_payment_intent_id' => $paymentIntent->id,
                'default_payment_method' => $paymentMethodId,
                'paid_amount' => $request->price,
                'plan_interval' => $duration,
                'customer_name' => $user->firstname . ' ' . $user->lastname,
                'customer_email' => $user->email,
                'plan_period_start' => $startDate,
                'plan_period_end' =>  $endDate,
                'status' => 'Active',
                'ReceiptURL' => $receiptUrl,
            ]);

            // Update user record
            if($user){
                $user->payment_method_id=$paymentMethodId;
                $user->payment_intent_id=$paymentIntent->id;
                $user->subscribe_status='Active';
                $user->renew_status= 'Enabled';
                $user->plan= $newPlan;
                $user->duration= $duration;
                $user->subscription_start=$startDate;
                $user->subscription_end = $endDate;
                $user->save();
            }
           

             // ✅ Send confirmation email
             Mail::send('emails.subscription', ['user' => $user, 'plan' => $data['plan'], 'endDate' => $endDate], function ($message) use ($user, $data) {
                $message->to($user->email)->subject("Welcome to Plan {$data['plan']} - Your Upgrade Is Complete!");
            });
            DB::commit();
            return response()->json(['success' => true, 'receipt_url' => $subscription->receipt_url]);
         
        } catch (\Stripe\Exception\CardException $e) {
            DB::rollBack();
            return response()->json(['error' => $this->handleStripeError($e)], 400);
        } catch (Exception $e) {
            DB::rollBack();
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
            $customerId = $request->customerid;
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
            'payment_intent_id' => 'required|string',
            'customer_id' => 'required|string',
        ]);

        try {
            // Set Stripe API Key from .env
            Stripe::setApiKey(config('services.stripe.secret'));

            // Retrieve request data
            $customerId = $request->customer_id; 
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
