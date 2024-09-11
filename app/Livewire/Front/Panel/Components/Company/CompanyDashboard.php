<?php

namespace App\Livewire\Front\Panel\Components\Company;

use App\Models\Company;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Throwable;

#[Lazy]
class CompanyDashboard extends Component
{
    use LivewireAlert,WithoutUrlPagination;
    public $active = null;

    public $companyName;
    public $telephone;
    public $managerNationalCode;
    public $licenceCode;
    public $economicCode;
    public $registrationCode;
    public $licenceExpire;
    public $province;
    public $address;
    public $rules = false;


    public function mount()
    {

        $this->authorize('company');

        $this->active = (bool)Company::whereUserId(auth()->id())->first();

    }

    public function registerCompany()
    {
        try
        {
         $validated =    $this->validate([
                'licenceExpire' => 'required',
                'companyName' => 'required|string|max:255',
                'licenceCode' => 'required|numeric|unique:companies,licence_code',
                'economicCode' => 'required|numeric',
                'registrationCode' => 'required|numeric|unique:companies,registration_code',
                'managerNationalCode' => 'required|numeric',
                'province' => 'required|string',
                'address' => 'required|string|max:500',
                'telephone' => 'required|numeric|unique:companies,telephone',
                'rules' => 'accepted',
            ]);


            $licenceExpire = toSystemDateOnly($this->licenceExpire);

            if (Carbon::parse($licenceExpire)->lessThanOrEqualTo(Carbon::now()))
            {
                $this->alert('error', 'تاریخ انقضاء صحیح وارد نشده است');
            }
            else
            {

                Company::create([
                    'name' => $validated['companyName'],
                    'telephone' => $validated['telephone'],
                    'economic_code' => $validated['economicCode'],
                    'licence_code' => $validated['licenceCode'],
                    'registration_code' => $validated['registrationCode'],
                    'license_expiration_date' => $licenceExpire,
                    'manager_national_code' => $validated['managerNationalCode'],
                    'province' => $validated['province'],
                    'address' => $validated['address'],
                    'user_id' => Auth::id(),
                    'active' => 0
                ]);

            $this->flash('success','ثبت شرکت با موفقیت انجام شد',[],route('panel',['page'=>'company-dashboard']));

            }



        }
        catch (Throwable $e)
        {
            $this->alert('warning',$e->getMessage());
        }


    }


    public function render()
    {
        $this->authorize('company');
        return view('livewire.front.panel.components.company.company-dashboard');
    }
}
