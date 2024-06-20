<?php

namespace App\Livewire\Front\Home;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Calculator extends Component
{
    use LivewireAlert;
    public $selectedOption = 1;




    public function render()
    {

            return view('livewire.front.home.calculator');

    }
}
