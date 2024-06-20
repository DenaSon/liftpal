<?php

namespace App\Livewire\Front\Home;

use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public function render()
    {
        return view('livewire.front.home.search');
    }
}
