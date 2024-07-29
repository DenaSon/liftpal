<?php

namespace App\Livewire\Front\User;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class Expert extends Component
{
    public $user = null;
    use LivewireAlert;

    public function mount($id, $name)
    {

        $this->user = User::with('profile')
            ->whereRole('technician')
            ->findOrFail($id);
    }


    public function render()
    {
        return view('livewire.front.user.expert');
    }
}
