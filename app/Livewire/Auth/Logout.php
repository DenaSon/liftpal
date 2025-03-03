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
       return redirect()->route('home');

    }

    public function render()
    {

        return <<<'blade'

                <span wire:confirm="از سیستم خارج می شوید؟" wire:click="logout">خروج</span>

blade;
    }
}
