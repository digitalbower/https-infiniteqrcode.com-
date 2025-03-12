<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionRenewalFailedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $plan;
    public $amount;
    public $date;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $plan, $amount, $date)
    {
        $this->user = $user;
        $this->plan = $plan;
        $this->amount = $amount;
        $this->date = $date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Action Required:Subscription Renewal Failed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.subscription_renewed_failed',
            with: [
                'user' => $this->user,
                'plan' => $this->plan,
                'amount' => $this->amount,
                'date' => $this->date,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}
