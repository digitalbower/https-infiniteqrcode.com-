<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AutoRenewMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $status)
    {
        $this->user = $user;
        $this->status = $status; // "Enabled" or "Disabled"
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Subscription Auto-Renewal Notice')
                    ->view('emails.auto_renew')
                    ->with([
                        'user' => $this->user,
                        'status' => $this->status,
                    ]);
    }
}
