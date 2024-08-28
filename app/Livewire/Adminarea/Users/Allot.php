<?php

namespace App\Livewire\Adminarea\Users;

use App\Livewire\Front\Panel\Components\Building;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

class Allot extends Component
{
    use  LivewireAlert;

   public $technicianId='',$companyId='',$buildingId;

    public $companies = [];
    public $buildings = [];
    public $technicians;

    public $buildingFilter = null;
    public $companyFilter = null;
    public $technicianFilter = null;


    public function updatedCompanyFilter($value): void
    {

        if (Str::length($value) > 1)
        {
            $this->companies = \App\Models\Company::where('name', 'like', '%' . $value . '%')->latest()->take(20)->get();
        }
        else
        {
            $this->companies = \App\Models\Company::take(25)->inRandomOrder()->get();
        }
    }

    public function updatedBuildingFilter($value): void
    {
        if (Str::length($value) > 1)
        {
            $this->buildings = \App\Models\Building::where('builder_name', 'like', '%' . $value . '%')->latest()->take(20)->get();
        }
        else
        {
            $this->buildings = \App\Models\Building::take(25)->inRandomOrder()->get();
        }
    }

    public function updatedTechnicianFilter($value): void
    {
        if (Str::length($value) > 1)
        {
            $this->technicians = \App\Models\User::whereRole('technician')
                ->where('phone', 'like',  '%'.$value . '%' )
                ->latest()->take(20)->get();
        }
        else
        {
            $this->technicians = \App\Models\User::whereRole('technician')->take(25)->inRandomOrder()->get();
        }
    }

    public function allot()
    {
        $this->alert('success','df');
        try {
            $this->validate([
                'buildingId' => 'required|exists:buildings,id',
                'companyId' => 'required|exists:companies,id',
                'technicianId' => 'required|exists:users,id',
            ]);



        }
        catch (Throwable $e)
        {
            $this->alert('warning',$e->getMessage());
        }
    }


    public function mount()
    {
        $this->companies = Company::take(20)->latest()->get();
        $this->buildings = \App\Models\Building::take(20)->latest()->get();
        $this->technicians = User::whereRole('technician')->take(20)->latest()->get();
    }

    public function buildingFilter()
    {

    }


    public function render()
    {
        return view('livewire.adminarea.users.allot');
    }
}
