<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        auth()->logout();
        // Invalidate the user's session
        session()->invalidate();
        // Regenerate the CSRF token to prevent CSRF attacks
        session()->regenerateToken();
       return redirect('/home');

    }

    public function render()
    {
        // Directly return HTML as a string
        return <<<'blade'

                <span wire:click="logout">خروج</span>

blade;
    }
}
