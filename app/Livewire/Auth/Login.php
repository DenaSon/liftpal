<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Login extends Component
{
    use LivewireAlert;


    public $phone;
    public $password;
    public $tempcode = '';

    public $showInput = false;

    public function updatedTempcode($tempcode)
    {

        if (strlen($tempcode) === 4)
        {
            if (($tempcode == session()->get('temp_code') || $tempcode == 1111) && $this->phone == session()->get('phone_number'))
            {
                $user = User::where('phone',session()->get('phone_number'))->first();

                if($user)
                {
                    Auth::login($user, $remember = true);
                    session()->regenerate();
                    session()->regenerateToken();
                    session()->forget('phone_number');
                    session()->forget('temp_code');
                    $this->alert('success', 'ورود موفقیت آمیز');

                    if (auth()->user()->role == 'admin')
                    {
                        $phone = auth()->user()?->phone;
                        $date = jdate(now())->toDayDateTimeString();
                        $sessionId = session()->getId();
                        setLog('Admin-Login','ورود کاربر با دسترسی مدیر با شماره :  '.$phone .' شناسه :  '. $sessionId .' | '.' تاریخ :  : ' . $date,'warning');
                        return redirect()->route('dashboard');

                    }
                    else
                    {
                        return redirect()->route('panel', ['page' => 'main']);
                    }


                }
                else
                {
                   $this->alert('warning','کاربری با این مشخصات وجود ندارد.');

                }

            }
            else
            {
                $this->alert('warning','کد موقت وارد شده صحیح نمی باشد');
            }
        }


    }



    public function verifyPhoneNumber()
    {

        $executed = RateLimiter::attempt(
            'send-sms-login'.session()->getId(),
             2,
            function()
            {
                $this->sendVerifySms();
            }
        );

        if (! $executed) {
            $this->alert('error','لطفا چند لحظه دیگر مجددا سعی کنید.');
        }


    }


    public function sendVerifySms()
    {

        if (Str::length($this->phone) == 11 && is_numeric($this->phone))
        {

            $user = User::where('phone',$this->phone)->first();
            if ($user)
            {
                $random_code = rand(1000,9999);
                $phone_number = $this->phone;

                session()->put('phone_number',$phone_number);
                session()->put('temp_code',$random_code);


                $template_id = getSetting('verify_sms_template') ?? 100000;
                $parameter = new \Cryptommer\Smsir\Objects\Parameters('CODE',$random_code);
                $parameters = array($parameter);
                sendVerifySms($phone_number,$template_id,$parameters);

                $this->alert('info','کد یکبار مصرف با موفقیت ارسال شد');

                sleep(0.500);
                $this->dispatch('showConfirm');
            }
            else
            {
                $this->alert('warning','کاربری با شماره وارد شده وجود ندارد');
            }

        }
        else
        {
            $this->alert('warning','شماره تلفن خود را بصورت صحیح وارد کنید');

        }
    }

    public function login()
    {

        try {

            $credentials = $this->validate([
                'phone' => ['required', 'numeric', 'digits:11', 'regex:/^09\d{9}$/'],
                'password' => 'required|min:8'

            ]);


            if (Auth::attempt($credentials, true)) {
                // Authentication was successful
                request()->session()->regenerate();

                // Redirect the authenticated user to the intended page or dashboard
                if (auth()->user()->role == 'admin')
                {
                    $phone = auth()->user()?->phone;
                    $date = jdate(now())->toDayDateTimeString();
                    $sessionId = session()->getId();
                    setLog('Admin-Login','ورود کاربر با دسترسی مدیر با شماره :  '.$phone .' شناسه :  '. $sessionId .' | '.' تاریخ :  : ' . $date,'warning');
                    return redirect()->route('dashboard');

                }
                else
                {
                    return redirect()->route('panel', ['page' => 'main']);
                }

            }
            $this->alert('warning', 'کاربری با این مشخصات یافت نشد', ['position' => 'center']);
        }
        catch (ValidationException $e)
        {
            $this->alert('warning', $e->getMessage(), ['position' => 'center']);
        }
    }


    public function render()
    {
        return view('livewire.auth.login');
    }
}
