<?php
namespace App\Livewire\Front\Home;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class AdviceForm extends Component
{
    use LivewireAlert;
    public $phone='';
    public $email='';
    public $text='';

    public function mount()
    {
        auth()->check() ? $this->phone = auth()->user()->phone : $this->phone='';
        auth()->check() ? $this->email = auth()->user()->email : $this->email='';

    }

    public function send()
    {

        $this->validate( [
            'phone' => 'required|numeric',
            'email'=>'nullable|email',
            'text'=>'required|string|min:5|max:255'
        ]);



            $this->alert('info','پیام شما ارسال شد');
            $this->reset();
            $this->dispatch('close-modal');
        return view('livewire.front.home.advice-form');

    }

    public function render()
    {
        return view('livewire.front.home.advice-form');
    }
}
