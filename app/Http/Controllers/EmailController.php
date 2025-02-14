<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrialEndMail;

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
}
