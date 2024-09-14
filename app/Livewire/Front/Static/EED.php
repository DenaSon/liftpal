<?php

namespace App\Livewire\Front\Static;

use App\Models\Error;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

class EED extends Component
{
    use LivewireAlert;
    public $errors =[];
    public $type;
    public $code = '';
    public $result  = null;
    public $errorCode;
    public $error_types;

    public function updatedCode($value)
    {
        if(Str::length($value) > 0)
        {
            $result = Error::where('type','like',$this->type)->where('code',$value)->first();
        }
    }


    public function mount()
    {
       $this->error_types = Error::select(['type'])->distinct()->get();
    }


    public function render()
    {


        return view('livewire.front.static.e-e-d')
            ->with(['errors' => $this->error_types])
            ->title('سیستم تفسیر خطاهای آسانسور');
    }
}
