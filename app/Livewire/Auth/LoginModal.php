<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LoginModal extends Component
{

    use LivewireAlert;

    public $phone;
    public $password;

    public function login()
    {

        $credentials = $this->validate([
            'phone' => ['required', 'numeric', 'digits:11', 'regex:/^09\d{9}$/'],
            'password' => 'required|min:8'

        ]);


        if (Auth::attempt($credentials,true)) {
            // Authentication was successful
            request()->session()->regenerate();

            // Redirect the authenticated user to the intended page or dashboard
            return redirect()->to('dashboard');

        }
        $this->alert('warning','کاربری با این مشخصات یافت نشد',['position'=>'center']);
    }

    public function render()
    {
        return view('livewire.auth.login-modal');
    }
}
