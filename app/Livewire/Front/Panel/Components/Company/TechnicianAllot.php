<?php

namespace App\Livewire\Front\Panel\Components\Company;

use App\Models\Company;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TechnicianAllot extends Component
{
    public $users =  [];
    public $search='';



    use  LivewireAlert;

    public function mount()
    {
        $this->authorize('company');


    }

    public function allotToCompany(User $user): void
    {
        $company_id = auth()->user()->company->id;
        $user->companies()->syncWithoutDetaching($company_id);

    }

    public function deAllotTechnician(User $user)
    {
        $company_id = auth()->user()->company->id;
        $user->companies()->detach($company_id);
        $this->alert('success','کارشناس از لیست شرکت شما حذف شد');

    }

    public function updatedSearch($value): void
    {
        if (strlen($value) > 10)
        {
            $this->users = User::with(['company','profile'])
                ->where('phone', 'like', '%' . $this->search . '%')
                ->whereRole('technician')
                ->take(2)
                ->get(['id','phone']);
        }
        else
        {
            $this->users = [];
        }




    }

    public function render()
    {
        $technicians  = auth()->user()->companies->first()->technicians;
        return view('livewire.front.panel.components.company.technician-allot', compact('technicians'));
    }
}
