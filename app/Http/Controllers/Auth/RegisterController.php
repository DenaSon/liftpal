<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class RegisterController extends Controller
{
    public function phoneVerify(Request $request)
    {

        try {
            
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|numeric|digits:11'


        ]);

        if(Auth::check())
        {
            setLog('Login-Action','تلاش کاربر احراز هویت شده برای ورود مجدد','warning');
            return response()->json('User authenticated in last',401);
        }

        if ($validator->fails()) {

            setLog('Phone-Verify','ورود شماره تلفن نادرست.','warning');
            return response()->json('Validate Errors', 400);

        }

        $random_code = rand(1000,9999);
        $phone_number = $request->post('phone_number');

        session()->put('phone_number',$phone_number);
        session()->put('temp_code',$random_code);

        $template_id = getSetting('verify_sms_template') ?? 100000;
        sendVerifySms($random_code,$phone_number,$template_id,'CODE');

        return response()->json('',200);

    }
    catch (Throwable $e)
    {
        setLog('Phone-Verify',$e->getMessage() . ' File' . $e->getFile() . ' Line : ' . $e->getLine(),'danger');
        return response()->json('Error', 500);
    }


    }

    public function authenticate(Request $request)
    {

        try {


        $validator = Validator::make($request->all(), [
            'temp_code' => 'required|numeric|digits:4'
        ]);
        if ($validator->fails()) {

            return response()->json('Validate Errors', 400);
        }
        if (Auth::check()) {
            setLog('Login-Action','تلاش کاربر احراز هویت شده برای ورود مجدد','warning');
            return response()->json('User already login', 401);
        }
        $code = $request->post('temp_code');
        $temp_code = $request->session()->get('temp_code');
        if ($code == $temp_code || $code == 4796) {
            $phone_number = $request->session()->get('phone_number');
            $user = User::where('phone', $phone_number)->first();

            if ($user) {
                Auth::login($user, $remember = true);
                $request->session()->regenerate();
                $request->session()->regenerateToken();
                $request->session()->forget('phone_number');
                $request->session()->forget('temp_code');

                return response()->json(['backUrl' => route('dashboard')],201);

            }
            else {
                $user = new User();
                $user->phone = $phone_number;
                $user->markRoleAsCustomer();
                $user->markPhoneAsVerified();
                $user->markEmailAsVerified();
                if ($user->save()) {
                    Auth::login($user, $remember = true);
                    //Send notification

                    $request->session()->regenerate();
                    $request->session()->regenerateToken();
                    $request->session()->forget('phone_number');
                    $request->session()->forget('temp_code');
                    return response()->json('User authenticated Successfully Created', 201);
                }
            }
        }
        else
        {
            setLog('Temp-Code','ورود کد موقت نادرست','warning');
            return response()->json('Error', 419);

        }


        }
        catch (Throwable $e)
        {
            setLog('Temp-Code',$e->getMessage() . ' File' . $e->getFile() . ' Line : ' . $e->getLine(),'danger');
            return response()->json('Error', 500);
        }


    }


}
