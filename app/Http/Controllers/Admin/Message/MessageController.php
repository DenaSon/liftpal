<?php

namespace App\Http\Controllers\Admin\Message;

use App\Http\Controllers\Controller;
use App\Mail\AdminMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class MessageController extends Controller
{
    public function channelSend(Request $request)
    {

        try {


        $receiver_id = $request->input('receiver_id');
        $channel = $request->input('channel');
        $subject = $request->input('subject');
        $content = $request->input('message');
        $receiver_email = $request->input('receiver_email') ?? '';
        if ($channel == 'email')
        {

            $data = [
                'subject' => $subject,
                'content' => $content
              ];

            Mail::to($receiver_email)->send( new AdminMessage($data));
            Alert::success('ایمیل ارسال شد');

        }
        elseif($channel == 'panel')
        {
            $message = new Message();
            $message->receiver_id = $receiver_id;
            $message->sender_id = auth()->id() ?? 0;
            $message->title = $subject;
            $message->content = $content;
            $message->save();
            Alert::success('پیغام ارسال شد');




        }
        elseif($channel == 'panel_email')
        {

            $message = new Message();
            $message->receiver_id = $receiver_id;
            $message->sender_id = auth()->id() ?? 0;
            $message->title = $subject;
            $message->content = $content;
            $message->save();

            $data = [
                'subject' => $subject,
                'content' => $content
            ];

            Mail::to($receiver_email)->send( new AdminMessage($data));
            Alert::success('پیغام ارسال شد');



        }


        return redirect()->back();

        }
        catch (Throwable $e)
        {
            setLog('Admin-SendMessage',$e->getMessage().' ' . $e->getFile() );

        }
    }
}
