<?php

namespace App\Livewire\Front\Panel\Components;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class FaultAlert extends Component
{

    use LivewireAlert;

    public $elevator_id;
    public $building_list;
    public $building_id;
    public $description;
    public $cause;

    public $elevator_list;


    public function show($id)
    {
        $building = \App\Models\Building::with('members','elevators')->find($id);
        $this->elevator_list = $building->members;


    }

    public function mount()
    {
        $this->building_list = \App\Models\Building::whereUserId(Auth::id())->get();

    }

    public function render()
    {
        return view('livewire.front.panel.components.fault-alert');
    }
}
