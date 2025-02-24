<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionFailedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $reason;
    public $retryLink;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $reason, $retryLink)
    {
        $this->user = $user;
        $this->reason = $reason; // Example: "Insufficient Funds" or "Card Expired"
        $this->retryLink = $retryLink;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Subscription Payment Failed')
                    ->view('emails.subscription_failed')
                    ->with([
                        'user' => $this->user,
                        'reason' => $this->reason,
                        'retryLink' => $this->retryLink,
                    ]);
    }
}
