<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $packageType;
    public $packageDuration;
    public $expiryDate;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $packageType, $packageDuration, $expiryDate)
    {
        $this->user = $user;
        $this->packageType = $packageType; // Basic, Premium, etc.
        $this->packageDuration = $packageDuration; // Monthly, Yearly, etc.
        $this->expiryDate = $expiryDate; // Subscription expiry date
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Subscription is Active - ' . ucfirst($this->packageType) . ' Plan')
                    ->view('emails.subscription')
                    ->with([
                        'user' => $this->user,
                        'packageType' => $this->packageType,
                        'packageDuration' => $this->packageDuration,
                        'expiryDate' => $this->expiryDate,
                    ]);
    }
}
