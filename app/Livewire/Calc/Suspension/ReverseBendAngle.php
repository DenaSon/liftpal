<?php

namespace App\Livewire\Calc\Suspension;

use Livewire\Component;

class ReverseBendAngle extends Component
{
    public $calcName;
    public $length;
    public $diameter;
    public $result;

    public function calcAngle()
    {
        $this->validate([
            'length' =>'required|numeric|max:10000|min:0.1',
            'diameter' =>'required|numeric|max:10000|min:0.1',
        ]);
        $alpha = (360 * $this->length) / (pi() * $this->diameter);
        $this->result = number_format($alpha,3);

    }


    public function render()
    {
        return view('livewire.calc.suspension.reverse-bend-angle');
    }
}
