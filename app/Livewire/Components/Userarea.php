<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Userarea extends Component
{

    public $class = '';

    public function userarea()
    {
        $role = Auth::user()->role;

        $roleRoutes = [
            'company'   => ['route' => 'panel', 'params' => ['page' => 'company-dashboard']],
            'manager'   => ['route' => 'panel', 'params' => ['page' => 'main']],
            'admin'     => ['route' => 'dashboard', 'params' => []],
            'technician'=> ['route' => 'panel', 'params' => ['page' => 'main']],
            'customer'=> ['route' => 'panel', 'params' => ['page' => 'main']],
        ];

        if (isset($roleRoutes[$role]))
        {
            $this->redirectRoute($roleRoutes[$role]['route'], $roleRoutes[$role]['params'], [], true);
        }

    }



    public function render()
    {

        return <<<HTML
            <a role="button" class="$this->class"wire:click.debounce.100ms="userarea">حساب کاربری</a>
        HTML;
    }
}
