<?php

namespace App\Livewire\Front\Static;

use App\Models\Subscriber;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

class Newsletter extends Component
{
    use LivewireAlert;

    public $email;


    public function saveEmail()
    {
        $limit= RateLimiter::attempt(
            'subscribber.' . session()->getId(),
            2,function()
            {
                try {
                    $this->validate(['email' => 'required|email|unique:subscribers,email']);
                    $email = $this->email;
                    $newsletter = new Subscriber();
                    $newsletter->email = $email;
                    $newsletter->subscribed = 1;
                    $newsletter->save();
                    $this->alert('success', 'ایمیل شما با موفقیت در خبرنامه ثبت شد');
                    $this->reset();
                } catch (Throwable $e) {
                    $this->alert('warning', $e->getMessage());
                }
        },300
        );

        if (!$limit)
        {
            $this->alert('warning','لطفا چند لحظه بعد مجدد تلاش کنید');
        }
    }


    public function render()
    {
        return view('livewire.front.static.newsletter');
    }
}
