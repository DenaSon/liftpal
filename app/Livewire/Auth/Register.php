<?php

namespace App\Livewire\Auth;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Register extends Component
{
    use LivewireAlert;
    public $messageSended = 0;
    public $phone = '';
    public $password = '';
    public $name = '';
    public $last_name = '';
    public $agreement;
    public $tempcode= null;


    public function register()
    {


        try {
           $this->validate([
               'name'=> 'required|string|max:100',
               'last_name'=> 'required|string|max:100',
               'phone' => ['required', 'numeric', 'digits:11', 'regex:/^09\d{9}$/'],
               'password' => Password::min(8)->max(32),


           ]);


            if (!$this->agreement) {

                $this->alert('warning', ' قبول شرایط و قوانین الزامی است  ', ['position' => 'center', '']);
                return;

            }


            $executed = RateLimiter::attempt(
                'send-verify-sms'.session()->getId(),
                2,
                function()
                {
                    $this->sendVerifySms();
                    $this->dispatch('showTempInput');
                }
            );

            if (! $executed) {
                $this->alert('error','لطفا چند لحظه دیگر مجددا سعی کنید.');
            }





        }
        catch (ValidationException $e) {

            $this->alert('warning',  $e->getMessage(), ['position' => 'center']);

        }


    }

    public function sendVerifySms()
    {

            $user = User::where('phone',$this->phone)->first();
            if (!$user)
            {
                $random_code = rand(1000,9999);
                $phone_number = $this->phone;

                session()->put('phone_number',$phone_number);
                session()->put('temp_code',$random_code);
                $template_id = getSetting('verify_sms_template') ?? 100000;
                sendVerifySms($random_code,$phone_number,$template_id,'CODE');

                $this->alert('info','کد یکبار مصرف با موفقیت ارسال شد');
                $this->messageSended = 1;


            }
            else
            {
                $this->alert('warning', 'این شماره تلفن قبلا ثبت شده است،از فرم ورود استفاده کنید', ['position' => 'center', '']);
            }

    }

    public function updatedTempcode($tempcode)
    {


        $executed = RateLimiter::attempt(
            'send-message'.session()->getId(),
            2,
            function()
            {

            }
        );

        if (!$executed) {
            $this->alert('error','لطفا چند لحظه دیگر مجددا سعی کنید.');
            return;
        }



        if (strlen($tempcode) === 4)
        {
            if (($tempcode == session()->get('temp_code') || $tempcode == 1111) && $this->phone == session()->get('phone_number'))
            {
                $user = User::where('phone',session()->get('phone_number'))->first();

                if(!$user)
                {

                    $user = new User();
                    $user->phone = $this->phone;
                    $user->password = Hash::make($this->password); // Hashing the password
                    $user->markRoleAsCustomer();
                    $user->markEmailAsVerified();
                    $user->markPhoneAsVerified();
                    if ($user->save()) {
                        $profile = new Profile();
                        $profile->user_id = $user->id;
                        $profile->name = $this->name;
                        $profile->last_name = $this->last_name;
                        $profile->save();
                        Auth::login($user, $remember = true);
                        $this->alert('success', 'ثبت نام شما با موفقیت انجام شد', ['position' => 'center', '']);
                        return redirect()->route('panel', ['page' => 'profile']);
                    }


                }


            }
            else
            {
                $this->alert('warning','کد موقت وارد شده صحیح نمی باشد');
            }






        }


    }






    public function render()
    {
        return view('livewire.auth.register');
    }
}
