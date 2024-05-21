<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $reservationId;
    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $reservationId)
    {
        $this->name = $name;
        $this->email = $email;
        $this->reservationId = $reservationId;
    }

      public function build()
    {
        return $this->view('emails.admin-notification')
                    ->with([
                        'reservationId' => $this->reservationId,
                        'name' => $this->name,
                        'email' => $this->email
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.admin-notification',
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
