<?php

namespace App\Livewire\Front\Panel\Components\Company;


use App\Models\Skill;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TechnicianManager extends Component
{

    use LivewireAlert;

    public $skillsApproved = [];



    public function mount()
    {


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
        $companyTechnicians = auth()->user()->company->technicians;

        return view('livewire.front.panel.components.company.technician-manager', compact('companyTechnicians'));
    }
}
