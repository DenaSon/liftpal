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


        $this->redirectRoute('home',[],true,true);

    }

    public function render()
    {
        // Directly return HTML as a string
        return <<<'blade'
            <div>
                <button wire:click="logout" class="dropdown-item">خروج</button>
            </div>
blade;
    }
}
