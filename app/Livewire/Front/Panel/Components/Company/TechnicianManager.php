<?php

namespace App\Livewire\Front\Panel\Components\Company;


use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TechnicianManager extends Component
{
    use LivewireAlert;
    public function removeSkill($userId, $skillId)
    {
        $user = \App\Models\User::find($userId);
        $user->skills()->detach($skillId);
        $this->flash('success','مهارت برای کارشناس حذف شد',[],route('panel',['page'=>'company-technicians']));

    }


    public function render()
    {
        $companyTechnicians  = auth()->user()->company->technicians;

        return view('livewire.front.panel.components.company.technician-manager',compact('companyTechnicians'));
    }
}
