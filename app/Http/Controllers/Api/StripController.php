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
    
        Stripe::setApiKey(config('services.stripe.secret'));
        DB::beginTransaction();
    
        try {
            $user = Auth::user();
            if (!$user) {
                \Log::error('Unauthorized access attempt.');
                return response()->json(['error' => 'Unauthorized'], 401);
            }
    
            // Ensure no duplicate active subscriptions
            $existingPlan = $user->plan;
            $newPlan = trim($request->plan);
            if ($existingPlan === $newPlan && $user->subscribe_status === 'Active') {
                return response()->json(['success' => false, 'message' => 'Already subscribed.']);
            }
    
            $duration = $request->duration == '30' ? 'monthly' : 'yearly';
            $amount = intval($request->price * 100); // Convert to cents
            $setupIntent = SetupIntent::retrieve($request->setup_intent_id);
            $paymentMethodId = $setupIntent->payment_method;
    
            if (!$paymentMethodId) {
                \Log::error('Failed to retrieve payment method.', ['setup_intent_id' => $request->setup_intent_id]);
                throw new \Exception('Failed to retrieve payment method.');
            }
    
            // Create or retrieve Stripe customer
            if (!$user->stripe_customer_id) {
                $customer = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'payment_method' => $paymentMethodId,
                    'invoice_settings' => ['default_payment_method' => $paymentMethodId],
                ]);
                $user->update(['stripe_customer_id' => $customer->id]);
            } else {
                $customer = Customer::retrieve($user->stripe_customer_id);
            }
    
            $startDate = now();
            $endDate = ($duration === 'monthly') ? $startDate->copy()->addMonth() : $startDate->copy()->addYear();
            // Reuse existing PaymentIntent if available
            if ($request->payment_intent_id) {
                $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            } else {
                $payment_intent_id = $user->payment_intent_id;
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
                    'return_url' => url('/subscription/confirm?payment_intent_id=' . $payment_intent_id ?? $request->payment_intent_id),
                ]);
            }
            
            \Log::info('PaymentIntent created:', ['id' => $paymentIntent->id, 'status' => $paymentIntent->status]);
    
            // Save subscription with pending status
            $subscription = UserSubscription::updateOrCreate(
            ['stripe_payment_intent_id' => $paymentIntent->id],
            [
                'user_id' => $user->id,
                'plan_id' => $newPlan,
                'stripe_customer_id' => $customer->id,
                'default_payment_method' => $paymentMethodId,
                'paid_amount' => $request->price,
                'plan_interval' => $duration,
                'customer_name' => $user->firstname . ' ' . $user->lastname,
                'customer_email' => $user->email,
                'plan_period_start' => $startDate,
                'plan_period_end' => $endDate,
                'status' => 'Pending',
            ]
            );
            
            $user->update([
                'payment_method_id' => $paymentMethodId,
                'payment_intent_id' => $paymentIntent->id,
                'subscribe_status' => 'Pending',
                'renew_status' => 'Enabled',
                'plan' => $newPlan,
                'duration' => $duration,
            ]);
            
    
            if ($paymentIntent->status === 'requires_action') {
                DB::commit();
                return response()->json([
                    'requires_action' => true,
                    'payment_intent_client_secret' => $paymentIntent->client_secret,
                    'payment_intent_id' => $paymentIntent->id,
                ]);
            }
            // Retrieve charge details
            $chargeId = $paymentIntent->latest_charge;
            if (!$chargeId) {
                \Log::error('PaymentIntent did not generate a charge.', ['payment_intent_id' => $paymentIntent->id]);
                throw new \Exception('PaymentIntent did not generate a charge.');
            }
    
            $charge = \Stripe\Charge::retrieve($chargeId);
            $receiptUrl = $charge->receipt_url ?? null;
    
            // Update subscription and user records
            $subscription->update([
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
            ]);
    
            // Send confirmation email
            Mail::send('emails.subscription', ['user' => $user, 'plan' => $newPlan, 'endDate' => $endDate], function ($message) use ($user, $newPlan) {
                $message->to($user->email)->subject("Welcome to Plan {$newPlan} - Your Upgrade Is Complete!");
            });
    
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
   public function confirmSubscription(Request $request)
    {
        $paymentIntentId = $request->input('payment_intent_id');

        if (!$paymentIntentId) {
            return redirect('/dashboard')->with('error', 'Payment not found.');
        }
        Stripe::setApiKey(config('services.stripe.secret'));
        DB::beginTransaction();
    
        try {
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            $subscription = UserSubscription::where('stripe_payment_intent_id', $paymentIntent->id)->first();
    
            if (!$subscription) {
                \Log::error('Subscription not found.', ['payment_intent_id' => $paymentIntent->id]);
                DB::rollBack();
                return response()->json(['success' => false, 'error' => 'Subscription not found.']);
            }
    
            $user = Auth::user();
            if (!$user) {
                \Log::error('Unauthorized user trying to confirm subscription.');
                DB::rollBack();
                return response()->json(['success' => false, 'error' => 'Unauthorized.']);
            }
    
            \Log::info('Payment Intent:', ['status' => $paymentIntent->status, 'id' => $paymentIntent->id]);
    
            if ($paymentIntent->status === 'succeeded') {
                $startDate = now();
                $endDate = ($subscription->plan_interval === 'monthly') ? $startDate->copy()->addMonth() : $startDate->copy()->addYear();
                
                $chargeId = $paymentIntent->latest_charge;
                if (!$chargeId) {
                    \Log::error('PaymentIntent did not generate a charge.', ['payment_intent_id' => $paymentIntent->id]);
                    DB::rollBack();
                    return response()->json(['success' => false, 'error' => 'PaymentIntent did not generate a charge.']);
                }
    
                $charge = \Stripe\Charge::retrieve($chargeId);
                $receiptUrl = $charge->receipt_url ?? null;
    
                // Update subscription
                $subscription->update([
                    'status' => 'Active',
                    'plan_period_start' => $startDate,
                    'plan_period_end' => $endDate,
                    'ReceiptURL' => $receiptUrl,
                ]);
    
                // Update user
                $user->update([
                    'subscribe_status' => 'Active',
                    'subscription_start' => $startDate,
                    'subscription_end' => $endDate,
                ]);
    
                // Send confirmation email
                Mail::send('emails.subscription', [
                    'user' => $user,
                    'plan' => $subscription->plan_id,
                    'endDate' => $endDate
                ], function ($message) use ($user, $subscription) {
                    $message->to($user->email)->subject("Welcome to Plan {$subscription->plan_id} - Your Upgrade Is Complete!");
                });
    
                DB::commit();
                return response()->json(['success' => true, 'receipt_url' => $receiptUrl]);
            }
    
            DB::rollBack();
            return response()->json(['success' => false, 'error' => 'Payment not completed.']);
        } 
        catch (\Stripe\Exception\CardException $e) {
            DB::rollBack();
            \Log::error('Card declined:', ['message' => $e->getMessage()]);
            return response()->json(['error' => $this->handleStripeError($e)], 400);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            DB::rollBack();
            \Log::error('Stripe API error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Stripe API error: ' . $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error confirming subscription:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => 'An error occurred while confirming the subscription.']);
        }
    }

}
