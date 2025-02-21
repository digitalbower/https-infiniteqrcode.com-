<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCardAddedMail extends Mailable
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
        $this->cardLast4 = $cardLast4; // Last 4 digits of the card
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Card Added to Your Account')
                    ->view('emails.new_card_added')
                    ->with([
                        'user' => $this->user,
                        'cardLast4' => $this->cardLast4,
                    ]);
    }
}
