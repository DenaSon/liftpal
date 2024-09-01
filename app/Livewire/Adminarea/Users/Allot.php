<?php

namespace App\Livewire\Adminarea\Users;

use App\Livewire\Front\Panel\Components\Building;
use App\Models\BuildingTechnician;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Http;
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
    public $technicians = [];
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

            $building = \App\Models\Building::find($this->buildingId);


            $exists_all = $building->technicians()
                ->wherePivot('company_id', $this->companyId)
                ->wherePivot('user_id', $this->technicianId)
                ->exists();


            $exists_company = $building->technicians()
                ->wherePivot('company_id', $this->companyId)
                ->exists();

            if (!$exists_all && !$exists_company) {
                $building->technicians()->attach($this->technicianId, ['company_id' => $this->companyId]);

                $this->alert('success', 'تخصیص کارشناس فنی برای ساختمان با موفقیت انجام شد');
            } else {

                if ($exists_all) {
                    $this->alert('info', 'این تکنسین و شرکت قبلاً به این ساختمان تخصیص داده شده‌اند');
                } elseif ($exists_company) {
                    $this->alert('info', 'این شرکت قبلاً به این ساختمان تخصیص داده شده است');
                }
            }


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


    public function deleteRelation($technicianId, $buildingId, $companyId)
    {
        try {

            $building = \App\Models\Building::findOrFail($buildingId);


            $building->technicians()->wherePivot('company_id', $companyId)->detach($technicianId);


            $this->buildingTechnicians = \App\Models\Building::with(['technicians', 'companies'])->get();

           $this->alert('success','ارتباط با موفقیت حذف شد');

        } catch (\Exception $e) {
            // Handle any errors
            $this->alert('warning', $e->getMessage());
        }
    }




    public function render()
    {

        $buildingTechnician = BuildingTechnician::where('company_id', 1)->first();

        return view('livewire.adminarea.users.allot',compact('buildingTechnician'));
    }
}
