<?php

namespace App\Livewire\Adminarea;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use withPagination,WithoutUrlPagination;
    public function render()
    {
        return view('livewire.adminarea.dashboard');
    }
}
