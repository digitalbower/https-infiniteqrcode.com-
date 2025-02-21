<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentFailureMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $amount;
    public $reason;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $amount, $reason)
    {
        $this->user = $user;
        $this->amount = $amount;
        $this->reason = $reason; // Example: "Insufficient Funds" or "Card Expired"
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Payment Failed for Your Subscription')
                    ->view('emails.payment_failure')
                    ->with([
                        'user' => $this->user,
                        'amount' => $this->amount,
                        'reason' => $this->reason,
                    ]);
    }
}
