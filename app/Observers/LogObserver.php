<?php

namespace App\Observers;
use App\Mail\LogMail;
use App\Models\Log;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Throwable;

class LogObserver
{
public function creating(Log $log)
{
// Logic before creating a new post
}

public function created(Log $log)
{
// Logic after creating a new Log


if( getSetting('log_on_off') == 'on' && getSetting('system_debugger_email') != null )
{
 $twoSecondsAgo = Carbon::now()->subSeconds(2);

 $lastError = Log::where('severity', 'danger')
     ->where('created_at', '>', $twoSecondsAgo)
     ->orderBy('created_at', 'desc')
     ->first()->description  ?? null;

 if($lastError)
 {


     $emailContent = ['description' => $lastError];
     $system_debugger = getSetting('system_debugger_email');

     // Send Admin Notification Panel
     $notification = new Notification();
     $notification->subject = 'ثبت خطا در گزارشات';
     $notification->content = 'ثبت خظای مهلک در گزارشات';
     $notification->channel = 'panel';
     $notification->save();

    try
    {
        if (getSetting('system_debugger_phone') != null && getSetting('notify_sms_template') != null) {

            $error_message = 'رخداد خطای مهم در ' . request()->getHost();
            sendVerifySms($error_message, getSetting('system_debugger_phone'),getSetting('notify_sms_template'),'CODE');
        }
        else
        {
            \Illuminate\Support\Facades\Log::error('Debugger phone &  Template is Invalid Or Not Set');
        }


     if ( getSetting('system_debugger_email') != null )
     {

     Mail::to(getSetting('system_debugger_email'))->send( new LogMail( $emailContent ));

     }
     else
     {
         \Illuminate\Support\Facades\Log::error('Debugger Email Is Invalid Or Not Set');
     }
    }
    catch (Throwable $e)
    {


     \Illuminate\Support\Facades\Log::error($e->getMessage());
     return false;

    }



 }


}

}


}
