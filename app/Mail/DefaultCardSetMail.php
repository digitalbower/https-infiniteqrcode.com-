<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DefaultCardSetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cardLast4;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $cardLast4)
    {
        $this->user = $user;
        $this->cardLast4 = $cardLast4; // Last 4 digits of the new default card
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Default Payment Method Has Been Updated')
                    ->view('emails.default_card_set')
                    ->with([
                        'user' => $this->user,
                        'cardLast4' => $this->cardLast4,
                    ]);
    }
}
