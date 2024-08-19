<?php
namespace App\Livewire\Front;


use App\Mail\home\supportMail;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;


class Home extends Component
{
    use LivewireAlert;
    public $search = '';

    public $fullname;
    public $phone;
    public $text;


    public function mount()
    {
        if (auth()->check())
        {
            $this->phone = auth()->user()->phone;
            $this->fullname = auth()->user()->profile?->name .' '.auth()->user()->profile?->last_name;
        }

        if (!empty(request()->input('action') && request()->input('action') == 'login')) {
            $this->dispatch('login-action');
        }
    }

    public function sendSupport()
    {
        try
        {

            $executed = RateLimiter::attempt(
                'send-support-request'.session()->getId(),
                1,
                function()
                {
                    $this->validate([
                        'phone' => 'required|numeric|digits_between:10,11',
                        'text' => 'required|string|max:255',
                        'fullname' => 'required|string|max:100',
                    ]);

                    Mail::to(getSetting('support_manager_email'))->send(new SupportMail($this->fullname, $this->phone, $this->text));

                    $this->alert('success','درخواست شما ثبت شد،بزودی کارشناسان ما با شما تماس خواهند گرفت');
                    $this->reset(['fullname', 'phone', 'text']);

                }

            );
            if (!$executed)
            {
                $this->alert('warning','تعداد درخواست بیش از حد مجاز است');

            }


        }
        catch (Throwable $e)
        {
            $this->alert('warning', $e->getMessage());
            Log::error('Support request email failed to send', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id(),
                'session_id' => session()->getId(),
            ]);
        }
    }


    public function render()
    {

        $title = getSetting('website_title') ?? 'LiftPal';
        return view('livewire.front.home')->title($title);

    }
}
