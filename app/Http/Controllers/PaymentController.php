<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe\Charge;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\SetupIntent;
use Stripe\Exception\CardException;
use Stripe\Exception\ApiErrorException;
use Exception;
use App\Models\User;
use App\Models\UserSubscription;
use Mail;


class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    { 
        $stripeKey = "sk_test_51Q4eUWLg6tc3IU2s1KIvKWpoun2MNomSJ6zCrEiMKQzcWx5CKcTeYr1i10rgtCi6Z9jolQQTLkDYX6SB6peRe9fR00GcXSFy4m";
        $user = Auth::user();
        $data = $request->all(); 
        
        $existingPlan = trim($user->plan);
        $requestedPlan = trim($data['plan']);
    
        if ($existingPlan === $requestedPlan && $user->subscribe_status === 'Active') {
            return response()->json(['success' => false]);
        }
    
        Stripe::setApiKey($stripeKey);
    
        try {
            $user = Auth::user();

    // Check if the user has a Stripe Customer ID; if not, create one
    if (!$user->stripe_customer_id) {
        $customer = Customer::create([
            'email' => $user->email,
            'name' => $user->firstname . ' ' . $user->lastname,
        ]);
        $user->update(['stripe_customer_id' => $customer->id]);
    }

    // Create a SetupIntent for saving the payment method
    $setupIntent = SetupIntent::create([
        'customer' => $user->stripe_customer_id,
    ]); 
          

    
    
            // ✅ Retrieve the Setup Intent
            // $setupIntent = SetupIntent::retrieve($setupIntentId);
            // $paymentMethodId = "card"; 

            
    

    // $paymentMethodId = $setupIntent->payment_method; 
    
            // ✅ Create or update Stripe Customer
            $customer = Customer::create([
                'name' => $user->firstname . ' ' . $user->lastname,
                'email' => $user->email,
                'payment_method' => $paymentMethodId,
                'invoice_settings' => ['default_payment_method' => $paymentMethodId],
            ]);
    
           ;
           
            $amount = intval($data['bprice'] . '00'); // Convert price to cents
            $duration = $data['duration'] == '30' ? 'monthly' : 'yearly';
            $startDate = now();
            $endDate = ($duration === 'monthly') ? now()->addMonth() : now()->addYear();
    
            // ✅ Create PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'customer' => $customer->id,
                'payment_method' => 'card',
                'payment_method' => $paymentMethodId,
                'confirmation_method' => 'automatic',
                'confirm' => true,
                'setup_future_usage' => 'off_session',
                'receipt_email' => $user->email,
                'return_url' => 'https://infiniteqrcode.com/return', // URL for 3D Secure redirection
            ]);
    

            
            if ($paymentIntent->status === 'requires_action') {
                return response()->json([
                    'success' => false,
                    'requires_action' => true,
                    'payment_intent_client_secret' => $paymentIntent->client_secret
                ]);
            }
    
            $chargeId = $paymentIntent->latest_charge;
            $receiptUrl = $chargeId ? PaymentIntent::retrieve($paymentIntent->id)->charges->data[0]->receipt_url : null;
    
            // ✅ Save subscription to database
            DB::transaction(function () use ($user, $customer, $paymentIntent, $paymentMethodId, $data, $startDate, $endDate, $receiptUrl, $duration) {
                UserSubscription::create([
                    'user_id' => $user->id,
                    'plan_id' => $data['plan'],
                    'stripe_customer_id' => $customer->id,
                    'stripe_payment_intent_id' => $paymentIntent->id,
                    'default_payment_method' => $paymentMethodId,
                    'paid_amount' => $data['price'],
                    'plan_interval' => $duration,
                    'customer_name' => $user->firstname . ' ' . $user->lastname,
                    'customer_email' => $user->email,
                    'plan_period_start' => $startDate,
                    'plan_period_end' => $endDate,
                    'status' => 'Active',
                    'receipt_url' => $receiptUrl
                ]);
    
                $user->update([
                    'stripe_customer_id' => $customer->id,
                    'payment_method_id' => $paymentMethodId,
                    'payment_intent_id' => $paymentIntent->id,
                    'subscribe_status' => 'Active',
                    'renew_status' => 'Enabled',
                    'price' => $data['price'],
                    'plan' => $data['plan'],
                    'duration' => $duration,
                    'subscription_start' => $startDate,
                    'subscription_end' => $endDate,
                ]);
            });
    
            // ✅ Send confirmation email
            Mail::send('emails.subscription', ['user' => $user, 'plan' => $data['plan'], 'endDate' => $endDate], function ($message) use ($user, $data) {
                $message->to($user->email)->subject("Welcome to Plan {$data['plan']} - Your Upgrade Is Complete!");
            });
    
            return response()->json(['success' => true, 'receipt_url' => $receiptUrl]);
        } catch (CardException $e) {
            return response()->json(['success' => false, 'error' => 'CardException: ' . $e->getMessage()]);
        } catch (ApiErrorException $e) {
            return response()->json(['success' => false, 'error' => 'ApiErrorException: ' . $e->getMessage()]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => 'GeneralException: ' . $e->getMessage()]);
        }
    }
}


