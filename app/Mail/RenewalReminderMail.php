<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RenewalReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $renewalType;
    public $renewalDate;
    public $amount;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $renewalType, $renewalDate, $amount)
    {
        $this->user = $user;
        $this->renewalType = $renewalType; // "Monthly" or "Yearly"
        $this->renewalDate = $renewalDate;
        $this->amount = $amount;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("Your {$this->renewalType} Subscription Renewal Reminder")
                    ->view('emails.renewal_reminder')
                    ->with([
                        'user' => $this->user,
                        'renewalType' => $this->renewalType,
                        'renewalDate' => $this->renewalDate,
                        'amount' => $this->amount
                    ]);
    }
}
