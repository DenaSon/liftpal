<?php

namespace App\Livewire\Front\Home;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Subscriber extends Component
{
    use LivewireAlert;
    public $email;

    public function save()
    {

        $this->validate( [
            'email' => 'required|email|unique:subscribers,email',

        ]);

        $subscribe_model = new \App\Models\Subscriber();
        $subscribe_model->email = $this->email;
        $subscribe_model->save();

        $this->alert('success','ایمیل شما با موفقیت ثبت شد'. ' '. $this->email);
        $this->reset();
    }


    public function render()
    {
        return view('livewire.front.home.subscriber');
    }
}
