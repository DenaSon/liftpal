<?php

namespace App\Livewire\Front\Panel\Components;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Profile extends Component
{


    use LivewireAlert;
    public $pageTitle = '';
    public $name;
    public $last_name;
    public $email;
    public $resume;
    public $education;
    public $authUser =null;
    public $authUserProfile = '';


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
