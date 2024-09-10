<?php

namespace App\Livewire\Components;


use Livewire\Component;
use Livewire\WithoutUrlPagination;


class RequestsTable extends Component
{
    use WithoutUrlPagination;

    public $class = null;
    public $card_class;

    public function mount()
    {


    }

    public function render()
    {
        $requests = \App\Models\Request::paginate(10);
        return view('livewire.components.requests-table',compact('requests'));
    }

}
