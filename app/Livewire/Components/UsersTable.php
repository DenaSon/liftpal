<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Lazy]
class UsersTable extends Component
{
    use WithPagination,WithoutUrlPagination;

    public $role ='';
    public $class = '';
    public $list_name ='';
    public $card_class;

    public function mount($role = null,$class = 'striped')
    {
        $this->role = $role;
        $this->class = $class;


    }

    public function render()
    {
        if ($this->role == "all")
        {
            $users = User::latest('created_at')->paginate(15);
        }
        else
        {
            $users = User::whereRole($this->role)->latest('created_at')->paginate(10);
        }
        return view('livewire.components.users-table',['users'=>$users]);
    }
}
