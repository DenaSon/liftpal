<?php

namespace App\Livewire\Front\Static;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Throwable;

class ContactUs extends Component
{

    use LivewireAlert;

    public $name = '';
    public $email = '';
    public $phone = '';
    public $subject = '';
    public $text = '';

    public function mount()
    {
        $this->phone = auth()->check() ? auth()->user()->phone : '';
    }

    public function send()
    {

        $executed = RateLimiter::attempt(
            'send-message',
            $perMinute = 1,
            function () {

                $support_email = getSetting('support_manager_email');
                $this->validate([
                    'name' => 'required|string|max:25',
                    'email' => 'required|email',
                    'text' => 'required|string|max:1000',
                    'phone' => 'numeric|required|digits:11'
                ]);

                try {
                    Mail::to($support_email)->send(new ContactMail($this->name, $this->email, $this->phone, $this->subject, $this->text));
                    $this->alert('success', 'پیغام شما با موفقیت ارسال شد');
                    $this->reset('name','email','text');

                }
                catch (Throwable $e) {
                    setLog('Send-Email-ContactUs', $e->getMessage(), 'danger');
                    $this->alert('warning', 'خطایی در ارسال پیام شما رخ داد،لطفا مجدد سعی کنید');
                }


            }
        );

        if (!$executed) {
            $this->alert('error', 'لطفا 3 دقیقه دیگر مجددا سعی کنید.');
        }


    }


    #[Title('تماس باما')]
    public function render()
    {
        $page_title = 'تماس باما';
        return view('livewire.front.static.contact-us')->with('page_title', $page_title);
    }
}
