<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CardExpiryReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $expiryDate;
    public $updateLink;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $expiryDate, $updateLink)
    {
        $this->user = $user;
        $this->expiryDate = $expiryDate; // Example: "March 2025"
        $this->updateLink = $updateLink;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Card is Expiring Soon - Update Now')
                    ->view('emails.card_expiry_reminder')
                    ->with([
                        'user' => $this->user,
                        'expiryDate' => $this->expiryDate,
                        'updateLink' => $this->updateLink,
                    ]);
    }
}
