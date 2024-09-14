<?php

namespace App\Livewire\Front\Static;

use App\Models\Error;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

class EED extends Component
{
    use LivewireAlert;

    public $errors = [];
    public $type;
    public $code = '';
    public $result = null;
    public $errorCode;

    public function updatedCode($value)
    {
        try
        {
            // Validate the 'type' field before proceeding
            $this->validate(['type' => 'required|string']);

            // Check if 'value' is numeric and 'type' is a string
            if (!is_numeric($value) || empty($this->type)) {
                $this->alert('warning', 'نوع تابلو انتخاب نشده است یا مقدار وارد شده صحیح نمی‌باشد');
                return;
            }


            if (Str::length($value) > 0) {
                // Find the error message based on the 'type' and 'code'
                $msg = Error::where('type', 'like', '%' . $this->type . '%')
                    ->where('code', $value)
                    ->first(['description']);


                $this->result = $msg ?: ['description' => 'خطا یافت نشد'];
            }
        }
        catch (Throwable $e) {
            $this->alert('warning', 'مشکلی در اعتبارسنجی وجود دارد: ' . $e->getMessage());
        }

    }



    public function mount()
    {

    }


    public function render()
    {

        $error_types = Error::select(['type'])->distinct()->get();
        return view('livewire.front.static.e-e-d', compact('error_types'))
            ->title('سیستم تفسیر خطاهای آسانسور');
    }
}
