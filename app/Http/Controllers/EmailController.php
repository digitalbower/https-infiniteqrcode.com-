<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrialEndMail;
use App\Mail\AutoRenewMail;
use App\Mail\CardExpiryReminderMail;

class EmailController extends Controller
{
    public function sendTrialEndEmail($user)
{
    $data = [
        'user' => $user,
        'trial_end_date' => $user->trial_ends_at->format('F d, Y'),
        'subscription_link' => route('subscription.plans'),
        'support_link' => route('support.contact')
    ];

    Mail::to($user->email)->queue(new TrialEndMail($data));
}
public function updateAutoRenew(Request $request)
{
    $user = Auth::user();
    $status = $request->auto_renew ? 'Enabled' : 'Disabled';

    // Update user's auto-renewal status in the database
    $user->renew_status = $status;
    $user->save();

    // Send auto-renewal status email
    Mail::to($user->email)->send(new AutoRenewMail($user, $status));

    return back()->with('success', 'Auto-renewal status updated successfully.');
}
public function sendRenewalReminder()
{
    $users = User::where('subscribe_status', 'Active')->get(); // Get active subscribers

    foreach ($users as $user) {
        $renewalType = $user->plan_type; // Assume 'Monthly' or 'Yearly'
        $renewalDate = now()->addDays(7); // Assume renewal is in 7 days
        $amount = $user->plan_type === 'Monthly' ? 10 : 100; // Example amounts

        // Send renewal reminder email
        Mail::to($user->email)->send(new RenewalReminderMail($user, $renewalType, $renewalDate, $amount));
    }

    return back()->with('success', 'Renewal reminders sent successfully.');
}
public function sendCardExpiryReminder($user, $expiryDate)
{
    $updateLink = url('/billing'); // Link to update payment details

    // Send card expiry reminder email
    Mail::to($user->email)->send(new CardExpiryReminderMail($user, $expiryDate, $updateLink));

    return back()->with('success', 'Card expiry reminder email sent.');
}
}
