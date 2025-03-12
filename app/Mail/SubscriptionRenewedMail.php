<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class SubscriptionRenewedMail extends Mailable
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
        return $this->subject('Your Subscription Has Been Renewed')
                    ->view('emails.subscription_renewed');
    }
}
