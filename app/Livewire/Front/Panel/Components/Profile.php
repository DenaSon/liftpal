<?php

namespace App\Livewire\Front\Panel\Components;

use App\Models\Skill;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Throwable;

#[Lazy]
class Profile extends Component
{


    use LivewireAlert;

    public $name;
    public $last_name;
    public $email;
    public $resume;
    public $education;
    public $authUser =null;
    public $authUserProfile = '';


    public $skill =[];

    public function mount()
    {
        $this->authUser = auth()?->user();
        $this->authUserProfile = $this->authUser->profile;
        $this->resume = $this->authUserProfile?->resume;




    }
    public function skillDelete($skillId)
    {
        try
        {
            $user = auth()->user();

            if ($user) {
                $user->skills()->detach($skillId);
                $this->alert('success', 'مهارت با موفقیت حذف شد', ['position' => 'center']);
            }
            else {
                $this->alert('error', 'کاربر یافت نشد', ['position' => 'center']);
            }
        }
        catch (Throwable $e)
        {
            $this->alert('error', $e->getMessage(), ['position' => 'center']);
        }
    }

    public function saveSkill()
    {
        try
        {
            $this->validate(['skill'=>'required|unique:skills,name']);

            $user = User::find(auth()->id());

            $user->skills()->attach($skill->id);
            $this->alert('success','مهارت جدید برای شما ثبت شد',['position'=>'center']);
        }
        catch(Throwable $e)
        {
            $this->alert('error',$e->getMessage(),['position'=>'center']);
        }

    }

    public function updateProfileInfo()
    {
       try
       {
           $this->validate([
               'name' => 'nullable|string|max:50|min:2',
               'last_name' => 'nullable|string|max:50|min:2',
               'email'=>'nullable|email|max:85|min:3'
           ]);
       }
       catch(\Exception $e)
       {
           $this->alert('warning',$e->getMessage());
       }
    }

    public function render()
    {
        return view('livewire.front.panel.components.profile');
    }
}
