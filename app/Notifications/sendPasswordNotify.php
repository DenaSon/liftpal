<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class sendPasswordNotify extends Notification
{
    use Queueable;
    protected $plainPassword;
    protected $email;

    /**
     * Create a new notification instance.
     */
    public function __construct($plainPassword,$email)
    {
        $this->plainPassword = $plainPassword;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('اطلاعات حساب کاربری در آتل')
                    ->replyTo(getSetting('system_admin_email') ?? 'fake@fake.com')
                    ->view('admin.inc.email.userRegisterNotify',['email' => $this->email,'password'=>$this->plainPassword]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
