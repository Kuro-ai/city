<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $username;
    public $useremail;
    /**
     * Create a new message instance.
     */
    public function __construct($order, $username, $useremail)
    {
        $this->order = $order;
        $this->username = $username;
        $this->useremail = $useremail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.order-confirmation',
        );
    }

    public function build()
    {
        return $this->view('emails.order-confirmation')
                    ->with([
                        'order' => $this->order,
                        'username' => $this->username,
                        'useremail' => $this->useremail
                    ]);
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
