<?php

namespace App\Livewire\Calc;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Main extends Component
{
    public $selectedCategory = '';
    use LivewireAlert;

    public function updatedSelectedCategory()
    {

    }


    public function render()
    {
        $title = 'ماشین حساب';
        $page_title = 'ماشین حساب';

        return view('livewire.calc.main',compact('page_title'))

            ->title($title);
    }
}
