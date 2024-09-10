<?php

namespace App\Livewire\Front\Panel\Components\Company;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class CompanyBuildings extends Component
{
    use LivewireAlert,WithoutUrlPagination;

    public function mount(): void
    {

    }

    public function render()
    {
        $buildings =  auth()->user()->buildings()->has('companies')->paginate(10) ?? [];
        return view('livewire.front.panel.components.company.company-buildings', compact('buildings'));
    }
}
