<?php

namespace App\Mail\home;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class supportMail extends Mailable
{
    use Queueable, SerializesModels;
    public $fullname;
    public $phone;
    public $text;

    /**
     * Create a new message instance.
     */
    public function __construct($fullname, $phone, $text)
    {
        $this->fullname = $fullname;
        $this->phone = $phone;
        $this->text = $text;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(
            from: getSetting('support_manager_email'),
            replyTo: 'No-Replay@gmail.com',
            subject: 'Liftpal Home Support Request :'.$this->phone,
        );
    }

    public function build(): void
    {
        $this->view('mails.homeSupport')
            ->with([
                'fullname' => $this->fullname,
                'phone' => $this->phone,
                'subject' => 'Support :' . $this->phone,
                'text' => $this->text,
            ]);
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.homeSupport',
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
