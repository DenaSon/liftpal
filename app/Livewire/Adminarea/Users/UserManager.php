<?php

namespace App\Livewire\Adminarea\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $listeners = ['loadMoreTriggered'];

    public function loadMoreTriggered()
    {
        $this->dispatch('loadMore');
    }


    public function render()
    {
        return view('livewire.adminarea.users.user-manager',['users'=>User::paginate(10)]);
    }
}
