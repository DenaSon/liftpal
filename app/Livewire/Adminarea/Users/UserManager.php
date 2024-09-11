<?php

namespace App\Livewire\Adminarea\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $listeners = ['loadMore'];
    public $perPage = 10;
    public function loadMore()
    {
        $this->perPage += 5;
    }


    public function render()
    {
        $users = User::paginate($this->perPage);

        return view('livewire.adminarea.users.user-manager',compact('users'));
    }
}
