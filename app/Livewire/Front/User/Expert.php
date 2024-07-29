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

        $this->user = User::with('profile', 'comments')
            ->whereRole('technician')
            ->findOrFail($id);
    }


    public function render()
    {
        $title = $this->user->profile->name . ' ' . $this->user->profile->last_name;
        $text = 'کارشناس فنی ';

        return view('livewire.front.user.expert')->title($text . ' ' . $title);
    }
}
