<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class userRegisterNotify extends Notification
{
    use Queueable;
    protected $plainPassword;


    /**
     * Create a new notification instance.
     */
    public function __construct($plainPassword)
    {
        $this->plainPassword = $plainPassword;
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
                    ->line('ثبت نام شما  با موفقیت انجام شد.' )
                    ->line('کلمه عبور شما : '.  $this->plainPassword)
                    ->subject('تکمیل ثبت نام در آتل')
                    ->action('ورود به آتل', url('/'))
                    ->line('از ثبت نام شما  متشکریم!');
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
