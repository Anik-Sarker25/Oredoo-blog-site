<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $mails = "";
    public function __construct($mailinfo)
    {
        $this->mails = $mailinfo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address("anikhasen25@gmail.com", "Oredoo-User"),
            replyTo: [
                new Address($this->mails['email'], $this->mails['name']),
            ],
            subject: $this->mails['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contactmail',
            with: [
                'maillername' => $this->mails['name'],
                'mailleremail' => $this->mails['email'],
                'maillersubject' => $this->mails['subject'],
                'maillermessage' => $this->mails['message'],
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
