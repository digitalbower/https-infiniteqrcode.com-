<?php

namespace App\Console\Commands;

use App\Mail\AutoRenewReminderMail;
use App\Mail\FreeSubscriptionReminderMail;
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
        $twoDaysFromNow = Carbon::now()->addDays(1);

        // Paid subscribers with auto-renew enabled
        $paidSubscriptions = User::where('renew_status', 'Enabled')
            ->whereIn('plan', ['basic','pro','expert'])
            ->whereDate('subscription_end', $twoDaysFromNow)
            ->get();

        foreach ($paidSubscriptions as $subscription) {
            if ($subscription && $subscription->email) {
               //Add Mail Subject::Subscription Auto-Renewal Notice
            }
        }

        // Free subscribers (optional: only send reminders if they have an expiry date)
        $freeSubscriptions = User::where('plan', 'free')
            ->whereDate('subscription_end', $twoDaysFromNow)
            ->get();

        foreach ($freeSubscriptions as $subscription) {
            if ($subscription && $subscription->email) {
                //Add Mail Subject::Your Free trial is about to expire
            }
        }

        $this->info('Auto-renew reminders sent for both paid and free subscriptions.');
    }
}
