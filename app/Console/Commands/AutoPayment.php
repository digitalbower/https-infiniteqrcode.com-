<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Console\Command;
use Stripe\Stripe;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentIntent;
use Stripe\Charge;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionRenewalFailedMail;
use App\Mail\SubscriptionRenewedMail;

class AutoPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process auto-payments for active subscriptions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // Get users with subscriptions due for renewal
        $users = User::select('id', 'stripe_customer_id', 'payment_method_id', 'subscription_end', 'price', 'duration', 'email', 'plan', 'firstname', 'lastname')
        ->whereDate('subscription_end', '<=', Carbon::today())
        ->where('renew_status', 'Enabled')
        ->where('subscribe_status', 'Active')
        ->where('plan', '!=', 'free')
        ->where('payment_failed_at', '=', null)
        ->get();

        if ($users->isEmpty()) {
        Log::info('No subscriptions require renewal at this time.');
        echo 'No subscriptions require renewal at this time.';
        return;
        }

        foreach ($users as $user) {
            $amount = intval($user->price * 100); // Stripe expects amount in cents
            if (!filter_var($amount, FILTER_VALIDATE_INT) || $amount < 50) {
                Log::error("Invalid charge amount for user: {$user->email}. Amount: $amount");
                continue;
            }
            $name = $user->firstname . ' ' . $user->lastname;
            $newStartDate = Carbon::today()->toDateString();
            $newEndDate = $user->duration === 'monthly' ? Carbon::today()->addMonth()->toDateString() : Carbon::today()->addYear()->toDateString();
        
            try {               
                // Ensure user has a valid payment method
                if (!$user->payment_method_id) {
                    Log::warning("No payment method found for user: {$user->email}. Skipping auto-payment.");
                    continue; // Skip this user
                }

                // Retrieve and validate payment method
                $paymentMethod = \Stripe\PaymentMethod::retrieve($user->payment_method_id);

                if ($paymentMethod->card->exp_year < date('Y') || 
                    ($paymentMethod->card->exp_year == date('Y') && $paymentMethod->card->exp_month < date('m'))) {
                    Log::warning("Expired card detected for user: {$user->email}. Expiry: {$paymentMethod->card->exp_month}/{$paymentMethod->card->exp_year}");
                    $user->update(['payment_failed_at' => now()]);
                   // Add mail Subject:Action Required:Subscription Renewal failed
                   Mail::to($user->email)->send(new SubscriptionRenewalFailedMail($user));
                    Log::info("Subscription Renewal failed email sent to user: {$user->email}");
                    continue; // Skip to the next user
                }
                // Attach payment method to customer only if not already attached
                if ($paymentMethod->customer !== $user->stripe_customer_id) {
                    $paymentMethod->attach(['customer' => $user->stripe_customer_id]);
                }

                // Retrieve the Stripe customer
                $customer = \Stripe\Customer::retrieve($user->stripe_customer_id);

                // Check and update the default payment method
                $currentDefaultPaymentMethod = $customer->invoice_settings->default_payment_method ?? null;
                if ($currentDefaultPaymentMethod !== $user->payment_method_id) {
                    \Stripe\Customer::update(
                        $user->stripe_customer_id,
                        ['invoice_settings' => ['default_payment_method' => $user->payment_method_id]]
                    );
                    Log::info("Updated default payment method for user: {$user->email}");
                } else {
                    Log::info("Default payment method already set for user: {$user->email}");
                }
                
                //  Proceed to create the PaymentIntent only if the card is valid
                $paymentIntent = PaymentIntent::create([
                    'amount' => $amount,
                    'currency' => 'usd',
                    'customer' => $user->stripe_customer_id,
                    'payment_method' => $user->payment_method_id,
                    'confirmation_method' => 'automatic',
                    'confirm' => true,
                    'setup_future_usage' => 'off_session',
                    'receipt_email' => $user->email,
                    'return_url' => url('/stripe/subscribe'),

                ]); 
                Log::info("payment intent status : {$paymentIntent->status}");

                // Handle 3D Secure
                if ($paymentIntent->status === 'requires_action') {
                    Log::warning("Payment requires additional action for user: {$user->email}. Sending email notification.");
                    
                    // Update user so you know it needs action
                    $user->update(['payment_failed_at' => now()]);
            
                    // Add mail Subject:Action Required:Subscription Renewal failed
                    Mail::to($user->email)->send(new SubscriptionRenewalFailedMail($user));

                    continue; // Skip further processing for this user
                }
                
                
                $paymentIntentId = $paymentIntent->id;
                $charge = Charge::retrieve($paymentIntent->latest_charge);
                $receiptUrl = $charge->receipt_url;
        
                // Update user's subscription dates
                $user->update([
                    'subscription_start' => $newStartDate,
                    'subscription_end' => $newEndDate,
                    'payment_intent_id' => $paymentIntentId,
                ]);
        
                // Save to user_subscriptions table
                UserSubscription::create([
                    'user_id' => $user->id,
                    'plan_id' => $user->plan,
                    'stripe_customer_id' => $user->stripe_customer_id,
                    'stripe_payment_intent_id' => $paymentIntentId,
                    'default_payment_method' => $user->payment_method_id,
                    'paid_amount' => $user->price,
                    'plan_interval' => $user->duration,
                    'customer_name' => $name,
                    'customer_email' => $user->email,
                    'plan_period_start' => $newStartDate,
                    'plan_period_end' => $newEndDate,
                    'status' => 'Active',
                    'ReceiptURL' => $receiptUrl,
                ]);
        
                Log::info("Renewal completed for user: {$user->email}, Amount: {$user->price}, Duration: {$user->duration}, New StartDate: $newStartDate, New EndDate: $newEndDate");
                
                //Add Mail Subject::Your Subscription has been Renewed
                Mail::to($user->email)->send(new SubscriptionRenewedMail($user));
            } 
            catch (\Stripe\Exception\CardException $e) {
                // Mark payment as failed
                $user->update(['payment_failed_at' => now()]);
                
               // Add mail Subject:Action Required:Subscription Renewal failed
               Mail::to($user->email)->send(new SubscriptionRenewalFailedMail($user));

                Log::error("Payment failed for user: {$user->email}. Stripe Error: " . $e->getError()->message);
        
        
            } catch (\Exception $e) {

                Log::error("Unexpected error for user: {$user->email}. Error: " . $e->getMessage());
            }
        }
        

    }
}
