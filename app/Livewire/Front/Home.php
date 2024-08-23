<?php
namespace App\Livewire\Front;


use App\Mail\home\supportMail;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
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

    public function userSearch()
    {
        try
        {
            $this->validate(['search'=>'required|string|min:0|max:200']);

            $searchTerm = $this->search;

            $searchTerms = explode(' ', $searchTerm);
            $firstName = $searchTerms[0] ?? ''; // نام
            $lastName = $searchTerms[1] ?? ''; // نام خانوادگی


            $profiles = \App\Models\Profile::where(function($query) use ($firstName, $lastName) {
                $query->where(function($q) use ($firstName) {
                    $q->where('name', 'LIKE', '%' . $firstName . '%');
                })
                    ->where(function($q) use ($lastName) {
                        $q->where('last_name', 'LIKE', '%' . $lastName . '%');
                    });
            })->get();

           if ($profiles->count() > 0 )
           {
               $userId = $profiles->first()?->user_id;

               $this->redirectRoute('singleExpert',['id'=>$userId,'name'=> Str::replace(' ','-',$searchTerms[0] . ' ' . $searchTerms[1]) ]);
           }
           else
           {
               $this->alert('info','نتیجه ای یافت نشد');
           }


        }
        catch (Throwable $e)
        {
            $this->alert('error', $e->getMessage());

        }
    }



    public function render()
    {

        $title = getSetting('website_title') ?? 'LiftPal';
        return view('livewire.front.home')->title($title);

    }
}
