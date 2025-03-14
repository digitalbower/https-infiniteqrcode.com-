<?php

namespace App\Console\Commands;

use App\Mail\AutoRenewMail;
use App\Mail\TrialEndMail;
use App\Mail\TrialPeriodEndedUpgradetoContinueAccess;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendAutoRenewReminder extends Command
{
    protected $signature = 'send:auto-renew-reminder';
    protected $description = 'Send auto-renew reminder emails for both paid and free subscriptions';

    public function handle()
    {
        $paidDaysEnds = Carbon::tomorrow();
        $freeDaysEnds = Carbon::now()->subDays(6);
        $trialEndedYesterday = Carbon::now()->subDays(8);

        // Paid subscribers with auto-renew enabled
        $paidSubscriptions = User::whereIn('plan', ['basic','pro','expert'])
            ->whereDate('subscription_end', $paidDaysEnds)
            ->where('renew_status', 'Enabled')
            ->where('subscribe_status', 'Active')
            ->get(); 
        if ($paidSubscriptions->isEmpty()) {
            \Log::info('No Paid subscriptions renewal');
            echo 'No Paid subscriptions renewal';
            return;
        }
        foreach ($paidSubscriptions as $subscription) {
            if ($subscription && $subscription->email) {
               //Add Mail Subject::Subscription Auto-Renewal Notice
                Mail::to($subscription->email)
                    ->send(new AutoRenewMail($subscription,$subscription->status));
                    
             \Log::info("Paid user: {$subscription->email}");
            }
        }

        // Free subscribers (optional: only send reminders if the trial is about to expire)
        $freeSubscriptions = User::where('plan', 'free')
            ->whereDate('created_at', $freeDaysEnds)
            ->where('renew_status', 'Enabled')
            ->where('subscribe_status', 'Active')
            ->get();
        if ($freeSubscriptions->isEmpty()) {
            \Log::info('No Free Paid subscriptions renewal');
            echo 'No Free Paid subscriptions renewal';
            return;
        }   
        foreach ($freeSubscriptions as $subscription) {
            if ($subscription && $subscription->email) {
                //Add Mail Subject::Your Free trial is about to expire
                Mail::to($subscription->email)
                    ->send(new TrialEndMail($subscription));
                \Log::info("Free trial user: {$subscription->email}");      
            }
        }
        
        // Trial ended email for free users
        $expiredFreeSubscriptions = User::where('plan', 'free')
            ->whereDate('created_at',  $trialEndedYesterday)
            ->where('renew_status', 'Enabled')
            ->where('subscribe_status', 'Active')
            ->get();
        if ($expiredFreeSubscriptions->isEmpty()) {
            \Log::info('No Trial ended free users renewal');
            echo 'No Trial ended free users renewal';
            return;
        }  
        foreach ($expiredFreeSubscriptions as $subscription) {
            if ($subscription && $subscription->email) {
                $user = User::where('email',$subscription->email)->first(); 
                $user->subscribe_status = "Inactive";
                $user->renew_status = "disabled";
                $user->save();

                //Add Mail Subject::Your Free trial is expired
                Mail::to($subscription->email)
                    ->send(new TrialPeriodEndedUpgradetoContinueAccess($subscription));
                \Log::info("Free trial user expired: {$subscription->email}");
            }
        }

        $this->info('Auto-renew reminders sent for both paid and free subscriptions.');
    }
}
