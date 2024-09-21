<?php

namespace App\Livewire\Components;


use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Lazy]
class RequestsTable extends Component
{
    use WithPagination,WithoutUrlPagination;

    public $class = null;
    public $card_class;

    public function mount()
    {


    }

    public function render()
    {
        $requests = \App\Models\Request::latest('created_at')->paginate(10);
        return view('livewire.components.requests-table',compact('requests'));
    }

}
