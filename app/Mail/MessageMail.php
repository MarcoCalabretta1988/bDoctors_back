<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MessageMail extends Mailable
{
    use Queueable, SerializesModels;
    public $sender;
    public $subject;
    public $message;
    /**
     * Create a new message instance.
     */
    public function __construct($sender, $subject, $message)
    {
        $this->sender = $sender;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Dottore ha ricevuto un nuovo messaggio!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $sender = $this->sender;
        $subject = $this->subject;
        $message = $this->message;
        return new Content(
            view: 'mail.new_message',
            with: compact('sender', 'subject', 'message')
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