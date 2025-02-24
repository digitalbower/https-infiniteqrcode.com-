<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RenewSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $subject;
    public $view;
    public ?string $logo; // Nullable string for the logo

    /**
     * Create a new message instance.
     */
   
    public function __construct(User $user, $subject, $view)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->view = $view;
        // Convert image to Base64
        $imagePath = public_path('demoimg/logo.png'); // Update the path if needed
        if (file_exists($imagePath)) {
            $imageData = base64_encode(file_get_contents($imagePath));
            $mimeType = mime_content_type($imagePath);
            $this->logo = "data:$mimeType;base64,$imageData";
        } else {
            $this->logo = null; // If the file doesn't exist
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->view,
            with: [
                'logo' => $this->logo
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
