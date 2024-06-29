<?php

namespace App\Livewire\Front\Panel;

use Livewire\Attributes\Title;
use Livewire\Component;


class Clientarea extends Component
{

    public $authUser = '';


    public $activePage = '';
    public $pageTitle = null;


    public function mount()
    {
        $this->authUser = auth()?->user();
    }

    public function render()
    {
        $this->activePage = 'حساب کاربری';


        return view('livewire.front.panel.clientarea');
    }
}
