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



    public $lat = '55.156476611281';
    public $lng = '37.082999580804';


    public function setlocation()
    {
        $this->lat = '30.66439741244777';
        $this->lng = '51.582633722338954';


    }

    public function mount()
    {
        $this->errors = Error::all();

    }

    public function updatedErrorCode($value): void
    {
        try
        {

            $executed = RateLimiter::attempt(
                'request-eed'.session()->getId(),
                5,
                function() use($value)
                {

                    $this->validate(['errorCode' => 'required|exists:errors,id|numeric']);

                    $existCode = Error::whereId($value)->first();
                    if($existCode)
                    {
                        $this->dispatch('remove-alert');
                        $this->errorCode = $existCode->code;
                        $this->result = $existCode;
                        switch ($this->result->type)
                        {
                            case 'mechanical':
                                $this->type = 'مکانیک';
                                break;

                            case 'electrical':
                                $this->type = 'الکترونیک';
                                break;

                            case 'software':
                                $this->type = 'نرم افزاری';
                                break;

                            case 'environmental':
                                $this->type = 'محیطی';
                                break;

                            case 'human':
                                $this->type = 'انسانی';
                                break;

                            case 'other':
                                $this->type = 'عمومی';
                                break;

                            default:
                                $this->type = 'نامشخص';
                                break;
                        }


                    }
                    else
                    {
                        $this->alert('warning','کد خطا وجود ندارد');
                    }
                }
            );

            if (! $executed) {
                $this->alert('warning', 'لطفا 1 دقیقه دیگر مجدد سعی کنید', [
                    'text' => 'در هر دقیقه 5 بررسی می توانید انجام دهید',
                    'showConfirmButton' => true,
                    'ConfirmButtonText' => 'تایید',
                    'timer' => 50000,
                    'timerProgressBar' =>true,


                ]);
            }


        }
        catch (Throwable $e)
        {
            $this->alert('warning',$e->getMessage());
        }

    }


    public function render()
    {
        return view('livewire.front.static.e-e-d')
            ->with(['errors' => $this->errors])
            ->title('سیستم تفسیر خطاهای آسانسور');
    }
}
