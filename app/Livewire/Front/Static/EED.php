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


    public function updatedCode($value)
    {
        if (is_numeric($value) && is_string($this->type))
        {
            if(Str::length($value) > 0)
            {
                $msg =  Error::where('type','like','%'.$this->type.'%')->where('code',$value)->first();
                if ($msg)
                {
                    $this->result = $msg;
                }
                else
                {
                    $this->result['description'] = 'خطا یافت نشد';
                }
            }

        }
        else
        {
            abort(404);
        }
    }


    public function mount()
    {

    }


    public function render()
    {

        $error_types = Error::select(['type'])->distinct()->get();
        return view('livewire.front.static.e-e-d',compact('error_types'))
            ->title('سیستم تفسیر خطاهای آسانسور');
    }
}
