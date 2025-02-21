<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrialEndMail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $data;
   
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('⏳ Your Free Trial Ends Soon – Don’t Lose Access!')
                    ->view('emails.trial_end')
                    ->with(['user' => $this->data]);
    }
}
