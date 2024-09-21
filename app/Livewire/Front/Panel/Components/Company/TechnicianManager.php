<?php

namespace App\Livewire\Front\Panel\Components\Company;


use App\Models\Skill;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TechnicianManager extends Component
{

    public $type = 'all';

    use LivewireAlert;

    public $skillsApproved = [];



    public function mount()
    {


    }

    public function installers()
    {
        $this->type = 'installer';
    }
    public function maintenances()
    {
        $this->type = 'maintenance';
    }

    public function approved($skillId,$userId): void
    {
        $user = User::findOrFail($userId);

        $user->skills()->updateExistingPivot($skillId, ['approved' => 1]);
        $this->flash('success','مهارت تایید شد',[],route('panel',['page'=>'company-technicians']));
    }

    public function removeApproved($skillId,$userId): void
    {
        $user = User::findOrFail($userId);

        $user->skills()->updateExistingPivot($skillId, ['approved' => 0]);
        $this->flash('success','مهارت لغو شد',[],route('panel',['page'=>'company-technicians']));

    }


//    public function removeSkill($userId, $skillId)
//    {
//        $user = \App\Models\User::find($userId);
//        $user->skills()->detach($skillId);
//        $this->flash('success','مهارت برای کارشناس حذف شد',[],route('panel',['page'=>'company-technicians']));
//
//    }


    public function render()
    {
        if ($this->type == 'installer')
        {
            $companyTechnicians = auth()->user()->company->technicians()->whereHas('skills', function ($query) {
                $query->where('skills.id', 11)
                    ->wherePivot('approved', 1);
            })->get();
        }
        elseif ($this->type == 'maintenance')
        {
            $companyTechnicians = auth()->user()->company->technicians()->whereHas('skills', function ($query) {
                $query->where('skills.id', 12)
                    ->wherePivot('approved', 1);
            })->get();
        }
        else
        {
            $companyTechnicians = auth()->user()->company->technicians;
        }


        return view('livewire.front.panel.components.company.technician-manager', compact('companyTechnicians'));
    }
}
