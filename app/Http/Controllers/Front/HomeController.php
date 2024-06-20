<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {

      $posts = Post::with(['images', 'user.profile'])
        ->where('is_active', true)
        ->take(6)
        ->get();

      $slider = Slider::with('images')
        ->whereCaption('main')
        ->first() ?? [];

        $banner = Slider::with('images')
            ->whereCaption('banner')
            ->first() ?? [];


        return view('front.home.index',compact('posts','slider','banner'));

    }



    public function storeNewsletter(Request $request)
    {
        $request->validate([
            'email'=> 'required|string|email|max:100|min:3'
        ]);

        $exists = Newsletter::where('email',$request->input('email'))->first();
        if ($exists)
        {
            Alert::warning('ایمیل شما از قبل در خبرنامه ثبت شده است','جدید ترین اخبار و تخفیفات برای شما ارسال میشود')->autoclose(6000);
            return redirect()->route('home');
        }
        else
        {
            $newsletter  = new Newsletter();
            $newsletter->email = $request->input('email');
            $newsletter->save();
            Alert::success('ایمیل شما با موفقیت ثبت شد','جدید ترین اخبار و تخفیفات برای شما ارسال میشود')->autoclose(6000);
            return redirect()->route('home');
        }


    }
}
