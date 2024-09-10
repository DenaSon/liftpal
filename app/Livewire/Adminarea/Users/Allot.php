<?php

namespace App\Livewire\Adminarea\Users;

use App\Livewire\Front\Panel\Components\Building;
use App\Models\BuildingTechnician;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Throwable;

class Allot extends Component
{
    use LivewireAlert,WithPagination,WithoutUrlPagination;

   public $technicianId='',$companyId='',$buildingId='';

    public $companies = [];
    public $buildings = [];

    public $buildingFilter = null;
    public $companyFilter = null;

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



    public function allot(): void
    {

        try {
            $this->validate([
                'buildingId' => 'required|exists:buildings,id',
                'companyId' => 'required|exists:companies,id',
            ]);

            $exists = DB::table('building_company')
                ->where('building_id', $this->buildingId)
                ->exists();

           if (!$exists)
           {
               DB::table('building_company')->insert([
                   'building_id' => $this->buildingId,
                   'company_id' => $this->companyId,
                   'created_at'=>now(),
                   'updated_at'=>now()
               ]);

               $this->flash('success','ساختمان برای شرکت ثبت شد',[],route('management',['page'=>'allot']));
           }
           else
           {
               $this->alert('warning','ساختمان انتخاب شده از قبل برای شرکت ثبت شده است');
           }


        }
        catch (Throwable $e)
        {
            $this->flash('warning',$e->getMessage(),[],route('management',['page'=>'allot']));
        }
    }

    public function deAllot($id)
    {
        $deleted = DB::table('building_company')->where('building_id', $id)->delete();

        if ($deleted) {
            $this->flash('success', 'رابطه با موفقیت حذف شد',[],route('management',['page'=>'allot']));
        } else {
            $this->alert('warning', 'رابطه یافت نشد یا قبلاً حذف شده است');
        }
    }


    public function mount()
    {

        $this->buildings = \App\Models\Building::take(20)->latest()->get();
        $this->companies = Company::latest()->get();

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

        $company_list  = Company::latest()->paginate(10);
        return view('livewire.adminarea.users.allot',compact('company_list'));
    }
}
