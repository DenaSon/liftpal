<?php

namespace App\Livewire\Front\Static;

use App\Models\Error;
use Illuminate\Support\Facades\RateLimiter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

class EED extends Component
{
    use LivewireAlert;
    public $errors =[];
    public $result  = null;
    public $errorCode;
    public $type;


    public function mount()
    {
       $this->errors = Error::select(['type'])->distinct()->get();
    }


    public function render()
    {


        return view('livewire.front.static.e-e-d')
            ->with(['errors' => $this->errors])
            ->title('سیستم تفسیر خطاهای آسانسور');
    }
}
