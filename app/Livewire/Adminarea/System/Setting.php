<?php

namespace App\Livewire\Adminarea\System;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

class Setting extends Component
{
    use LivewireAlert;
    public function resetRememberTokens()
    {
        try
        {
            User::query()->update(['remember_token'=>null]);
            $this->alert('success','عملیات با موفقیت انجام شد');
        }
        catch (Throwable $e)
        {
            $this->alert('warning','عملیات حذف نشست ها شکست خورد');
            setLog('Reset-RememberToken',$e->getMessage(). ' ' . $e->getFile(). ' ' . $e->getLine(),'danger');
        }

    }



    public function render()
    {
        return view('livewire.adminarea.system.setting');
    }
}
