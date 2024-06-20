<?php

namespace App\Http\Controllers\Front\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function index()
    {

        return view('front.contact.index');

    }

    public function send(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|email|string|max:100',
            'subject' =>'required|string',
            'messagetext' => 'required|min:5|max:500|string'
        ]);
        $receiver = getSetting('support_manager_email') ?? 'test@mail.com';

        Mail::to($receiver)->send(new ContactMail(
            $request->username,
            $request->email,
            $request->subject,
            $request->messagetext
        ));

        Alert::success('پیام  ارسال شد','پیام شمارا دریافت کردیم و بزودی با شما تماس خواهیم گرفت');
        return redirect()->back();
    }
}
