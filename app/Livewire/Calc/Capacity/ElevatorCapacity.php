<?php

namespace App\Livewire\Calc\Capacity;

use Livewire\Component;

class ElevatorCapacity extends Component
{
    public $calcName;
    public $elevatorCapacity;
    public $maxWeight='';


    public function calcCapacity()
    {
        $this->validate([
            'maxWeight' =>'required|numeric|max:5000000|min:0'

        ]);

        $this->elevatorCapacity = floor(($this->maxWeight / 75) - 1);
    }

    public function render()
    {
        return view('livewire.calc.capacity.elevator-capacity');
    }
}
