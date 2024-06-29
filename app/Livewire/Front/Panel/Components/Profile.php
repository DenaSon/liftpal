<?php

namespace App\Livewire\Front\Panel\Components;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class Profile extends Component
{


    use LivewireAlert;
    public $pageTitle = '';
    public $name;
    public $last_name;
    public $email;
    public $resume;
    public $authUser =null;
    public $authUserProfile = '';

    #[Title('پنل کاربری')]

    public function mount()
    {
        $this->authUser = auth()?->user();
        $this->authUserProfile = $this->authUser->profile;
        $this->resume = $this->authUserProfile?->resume;


    }


    public function render()
    {
        return view('livewire.front.panel.components.profile');
    }
}
