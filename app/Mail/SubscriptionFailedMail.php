<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionFailedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $planName;
    public $renewalDate;
    public $amount;

    public function __construct($user, $planName, $renewalDate, $amount)
    {
        $this->user = $user;
        $this->planName = $planName;
        $this->renewalDate = $renewalDate;
        $this->amount = $amount;
    }

    public function build()
    {
        return $this->subject('Action Required: Subscription Renewal Failed')
                    ->view('emails.subscription_renewed_failed');
    }
}
