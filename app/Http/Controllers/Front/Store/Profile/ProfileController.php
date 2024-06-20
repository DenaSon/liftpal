<?php

namespace App\Http\Controllers\Front\Store\Profile;

use App\Http\Controllers\Controller;
use App\Models\Financial;
use App\Models\Order;
use App\Models\Profile;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {


        $profile = Profile::where('user_id',auth()->id())->first();

        $auth_user = auth()->id();
        $orders = Order::where('user_id',$auth_user)
            ->where('payment_status','paid')
            ->orderByDesc('created_at')->paginate(5)->appends(request()->query());

        $transactions = Transaction::orderByDesc('created_at')->where('user_id',$auth_user)->paginate(15)->appends(request()->query());
        $bank_accounts = Financial::orderByDesc('created_at')->where('user_id',$auth_user)->take(3)->get();



        return view('front.shop.profile.index',compact(['profile','orders','transactions','bank_accounts']));
    }


    public function updateProfile(Request $request)
    {

        $request->validate([
            'name'=>'nullable|string|max:50',
            'last_name'=>'nullable|string|max:50',
            'email' => 'nullable|email|max:90',
            'expertise' => 'nullable|string'

            ]


        );

        $auth_id = auth()->id();
        $profile = Profile::where('user_id',$auth_id)->firstOrFail();
        $user = User::where('id',$auth_id)->firstOrFail();

        $profile->name = $request->input('name');
        $profile->last_name = $request->input('last_name');
        $profile->expertise = $request->input('expertise');
        $profile->save();
        $user->email = $request->input('email');
        $user->save();
        toast()->success('اطلاعات پروفایل شما با موفقیت ویرایش شد')->position('center');
        return redirect()->route('customerProfile',['action'=>'edit_profile']);

    }


}
