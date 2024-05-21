<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $reservation;
    public $username;
    public $useremail;
    /**
     * Create a new message instance.
     */
    public function __construct($reservation, $username, $useremail)
    {
        $this->reservation = $reservation;
        $this->username = $username;
        $this->useremail = $useremail;
    }

    public function build()
    {
        return $this->view('emails.reservation-confirmation')
                    ->with([
                        'order' => $this->reservation,
                        'username' => $this->username,
                        'useremail' => $this->useremail
                    ]);
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservation Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reservation-confirmation',
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
