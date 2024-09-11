<?php

namespace App\Livewire\Adminarea\Company;

use App\Models\Company;
use App\Models\Message;
use Illuminate\Support\Facades\RateLimiter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Throwable;

#[Lazy]
class Companies extends Component
{
    use  WithoutUrlPagination,LivewireAlert;

#[Locked]
public $company_id;




    public function activeCompany($company_id)
    {

        try
        {
            $this->company_id = $company_id;
            $company  = Company::find($company_id);
            $execute  = RateLimiter::attempt('company-'.$company_id,2,function () use($company)
            {

                Company::whereId($this->company_id)->update(['active' => 1]);
                $this->alert('success','وضعیت شرکت به فعال تغییر یافت');

                $template_id = config('sms.company_active_notify');
                $parameter = new \Cryptommer\Smsir\Objects\Parameters('company_name',$company->name);
                $parameters = array($parameter);
                sendVerifySms($company->owner->phone,$template_id,$parameters);

                $this->sendActiveMessage($company);

            },120);

            if (!$execute)
            {
                $this->alert('error','درخواست بیش از حد مجاز');
            }

        }
        catch (Throwable $e)
        {
            $this->alert('warning',$e->getMessage());
            setLog('Company-Notify-Sms',$e->getMessage(),'danger');
        }

    }

    private function sendActiveMessage($company): void
    {

        try {
            $title = 'فعالسازی حساب کاربری';
            $content = 'حساب کاربری شما به عنوان شرکت با موفقیت فعالسازی شده و می توانید از تمام امکانات سامانه استفاده کنید';
            $sender_id = auth()->user()->id;
            $receiver_id = $company->user_id;


            $newMessage = new Message();
            $newMessage->sender_id = $sender_id;
            $newMessage->receiver_id = $receiver_id;
            $newMessage->title = $title;
            $newMessage->content = $content;
            $newMessage->is_read = 0;
            $newMessage->save();
        }
        catch (Throwable $e)
        {
            $this->alert('warning',$e->getMessage());

        }


        }



    public function deActiveCompany($company_id)
    {
        $this->company_id = $company_id;
        Company::whereId($this->company_id)->update(['active' => 0]);
        $this->alert('success','وضعیت شرکت به غیرفعال تغییر یافت');
    }



    public function render()
    {
        $companies = Company::latest()->paginate(20);
        return view('livewire.adminarea.company.companies',compact('companies'));
    }
}
