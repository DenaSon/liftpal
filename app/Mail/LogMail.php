<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class LogMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $content;


    /**
     * Create a new message instance.
     */
    public function __construct(array $content =[])
    {
        $this->content = $content;


    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: getSetting('system_admin_email'),
            replyTo: getSetting('system_admin_email'),
            subject: config('app.name').' Danger Error',



        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $lastErrorDescription = $this->content['description'];
        return new Content(
            view: 'admin.inc.email.log',
            with: [
                'description' => $lastErrorDescription, //Send to View
            ],

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
