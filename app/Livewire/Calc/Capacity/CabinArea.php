<?php

namespace App\Livewire\Calc\Capacity;

use Illuminate\Support\Facades\RateLimiter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CabinArea extends Component
{
    use LivewireAlert;


    public $calcName;

    public $length;
    public $width;
    public $thickness=0.5;
    public $elevatorCabinArea;

    public function calcCabinArea()
    {

         $this->validate([
            'length' => 'required|numeric|min:0.01|max:100',
            'width' => 'required|numeric|min:0.01|max:100',
            'thickness' => 'required|numeric|min:0.01|max:100',

        ]);


        $executed = RateLimiter::attempt(
            'show-result'.session()->getId(),
            10,
            function()
            {
                $this->elevatorCabinArea = ($this->length - 2 * $this->thickness) * ($this->width - 2 * $this->thickness);
            }
        );

        if (! $executed) {
            $this->alert('warning','لطفا چند لحظه دیگر مجددا سعی کنید.',['position'=>'center']);

        }







    }

    public function render()
    {
        return view('livewire.calc.capacity.cabin-area');
    }
}
