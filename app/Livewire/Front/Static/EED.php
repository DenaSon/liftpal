<?php

namespace App\Livewire\Front\Static;

use App\Models\Error;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EED extends Component
{
    use LivewireAlert;
    public $errors =[];
    public $errorCode;
    public $result;

    public function mount()
    {
        $this->errors = Error::all();

    }

    public function fetchError()
    {
        try
        {

            $this->validate([
                'errorCode' => 'required|string|min:2|max:45|exists:errors,code',
            ]);

            $this->result = Error::where('code', $this->errorCode)->first();

            if (!$this->result) {
                $this->alert('error', 'Error not found');
            }
        }
        catch (\Throwable $e)
        {
            $this->alert('error',$e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.front.static.e-e-d')
            ->with(['errors' => $this->errors])
            ->title('سیستم تفسیر خطاهای آسانسور');
    }
}
