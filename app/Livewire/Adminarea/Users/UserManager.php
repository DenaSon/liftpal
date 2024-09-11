<?php

namespace App\Livewire\Adminarea\Users;

use App\Models\User;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination,WithoutUrlPagination,LivewireAlert;

    protected $listeners = ['loadMore'];
    public $perPage = 10;
    public $search = '';


    public function loadMore()
    {
        $this->perPage += 5;
    }
    public function searchUser()
    {
        $this->resetPage();
    }



    public function render()
    {
       $users =  User::query()
        ->when(trim($this->search), function ($query) {
            $query->where('phone', 'like', '%' . $this->search . '%')
                ->orWhereHas('profile', function ($q) {
                    $q->where('last_name', 'like', '%' . $this->search . '%');
                });
        })
        ->latest('created_at')
        ->paginate($this->perPage);

        return view('livewire.adminarea.users.user-manager',compact('users'));
    }
}
