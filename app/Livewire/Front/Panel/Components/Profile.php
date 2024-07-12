<?php

namespace App\Livewire\Front\Panel\Components;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Lazy;
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
    public $authUser = null;
    public $authUserProfile = '';
    public $skillId;
    public $skill = [];

    protected $listeners = ['confirmSkillDelete'];

    public function mount()
    {
        $this->authUser = auth()->user();

        if ($this->authUser) {
            $this->authUserProfile = $this->authUser->profile;
            $this->resume = $this->authUserProfile->resume ?? null;
            $this->name = $this->authUserProfile->name ?? null;
            $this->last_name = $this->authUserProfile->last_name ?? null;
            $this->email = $this->authUser->email ?? null;
            $this->education = $this->authUserProfile->education ?? null;
        }
    }

    public function saveSkill()
    {
        try {
            $this->validate(['skill' => 'required|exists:skills,id']);
            $user = User::find(auth()->id());

            if ($user->skills()->where('skill_id', $this->skill)->exists()) {
                $this->alert('warning', 'این مهارت قبلاً برای شما ثبت شده است', ['position' => 'center']);
            } else {
                $user->skills()->attach($this->skill);

                $this->alert('success', 'مهارت جدید برای شما ثبت شد', ['position' => 'center']);
            }
        } catch (Throwable $e) {
            $this->alert('error', $e->getMessage(), ['position' => 'center']);
        }
    }

    public function skillDelete($skillId)
    {
        $this->skillId = $skillId;
        $this->confirm('مهارت حذف شود؟', ['onConfirmed' => 'confirmSkillDelete']);
    }

    public function confirmSkillDelete()
    {
        try {
            $user = auth()->user();

            if ($user) {
                $user->skills()->detach($this->skillId);
                $this->alert('success', 'مهارت با موفقیت حذف شد', ['position' => 'center']);

            } else {
                $this->alert('error', 'کاربر یافت نشد', ['position' => 'center']);
            }
        } catch (Throwable $e) {
            $this->alert('error', $e->getMessage(), ['position' => 'center']);
        }
    }

    public function updateProfileInfo()
    {
        try {
            $this->validate([
                'name' => 'nullable|string|max:50|min:2',
                'last_name' => 'nullable|string|max:50|min:2',
                'email' => 'nullable|email|max:85|min:3',
                'education' => 'nullable|string|in:دیپلم,کاردانی,کارشناسی,کارشناسی ارشد,دکتری'
            ]);

            $user = auth()->user();

            if ($user) {
                if ($this->email) {
                    $user->email = $this->email;
                }
                $user->save();

                $profile = $user->profile;
                if ($profile) {
                    if ($this->name) {
                        $profile->name = $this->name;
                    }
                    if ($this->last_name) {
                        $profile->last_name = $this->last_name;
                    }
                    if ($this->education) {
                        $profile->education = $this->education;
                    }
                    if ($this->resume) {
                        $profile->resume = $this->resume;
                    }
                    $profile->save();
                }

                $this->alert('success', 'اطلاعات پروفایل ویرایش شد', ['position' => 'center']);
            }
        } catch (\Exception $e) {
            $this->alert('warning', $e->getMessage(), ['position' => 'center']);
        }
    }

    public function render()
    {
        return view('livewire.front.panel.components.profile');
    }
}
