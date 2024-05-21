<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationCancellation extends Mailable
{
    use Queueable, SerializesModels;
    public $reservation;
    public $user;
    /**
     * Create a new message instance.
     */
    public function __construct($reservation, $user)
    {
        $this->reservation = $reservation;
        $this->user = $user;
    }

    public function build()
    {
        return $this->markdown('emails.reservation-cancellation')
                    ->with([
                        'reservation' => $this->reservation,
                        'user' => $this->user,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservation Cancellation~',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-order-notification',
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
