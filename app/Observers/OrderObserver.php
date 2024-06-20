<?php

namespace App\Observers;

use App\Models\Order;
use Cryptommer\Smsir\Objects\Parameters;
use Cryptommer\Smsir\Smsir;
use Illuminate\Support\Facades\Auth;
use Throwable;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {

    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if ($order->payment_status == 'paid' && $order->status == 'processing')
        {
            $phoneNumber = Auth::user()->phone;
            $template_id = getSetting('order_verify_template') ?? 100000;
            try
            {
                $send = Smsir::send();
                $parameterName1 = 'ORDER';
                $value1 = $order->id;
                $parameter1 = new Parameters($parameterName1, $value1);
                $parameterName2 = 'PAYMENT_ID';
                $value2 = $order->payment_transaction_id;
                $parameter2 = new Parameters($parameterName2, $value2);
                $parameters = array($parameter1, $parameter2);
                $response = $send->Verify( $phoneNumber, $template_id, $parameters);

            }
            catch (Throwable $e)
            {
                $errorMessage = $e->getMessage();
                setLog('Send-Sms', $errorMessage . ' | Source : ' . $e->getFile() . ' | Line : ' . $e->getLine(), 'danger');
            }


        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
