<?php

namespace App\Livewire\Front\Panel\Components;

use Livewire\Attributes\Lazy;
use Livewire\Component;
#[Lazy]
class Main extends Component
{

    public function render()
    {
        return view('livewire.front.panel.components.main');
    }
}
