<?php

namespace App\Livewire\Front\Cart;

use App\Models\Order;
use App\Models\Transaction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class Callback extends Component
{
    use LivewireAlert;

    public $success;
    public $transaction;
    public $order;
    public $errorMessage;
    public function mount()
    {

        session()->regenerate();

        if (!auth()->check())
        {
            $this->alert('warning','خطایی رخ داده است،لطفا با پیشتیبان تماس بگیرید');
            setLog('Payment-Failed','تلاش برای پرداخت توسط کاربر احراز هویت نشده','danger');
            redirect()->route('home');
        }
        if (!session()->has('callbackToken') )
        {

            abort(403);
        }

        try
        {

            $authority = request()->query('Authority');
            $status = request()->query('Status');
            if (!is_string($authority) || !is_string($status))
            {
                abort(400, 'Bad Request');
            }
            $response = zarinpal()
                ->amount( 1000)  //$transaction->amount
                ->verification()
                ->authority($authority)
                ->send();

            if (!$response->success())
            {
                //False if Transaction not success
                $this->success = false;
                $this->errorMessage = $response->error()->message();
                session()->forget('callbackToken');

            }
            else
            {
                session()->regenerate();
                session()->regenerateToken();
                session()->forget('callbackToken');
                // True if success transaction
                $this->success = true;
                $this->transaction = Transaction::whereTransactionId($authority)->first();

                $this->transaction->status = 'paid';
                $this->transaction->card_hash = $response->cardHash();
                $this->transaction->card_pen = $response->cardPan();
                $this->transaction->reference_id = $response->referenceId();
                $this->transaction->save();

                $orderId = $this->transaction['order_id'];

                $this->order = Order::whereId($orderId)->first();
                $this->order->status = 'received';
                $this->order->payment_method = 'zarinpal';
                $this->order->payment_status = 'paid';
                $this->order->payment_transaction_id = $response->referenceId();
                $this->order->save();




            }

        }
        catch (Throwable $e)
        {
            setLog('ZarinpalPayment-Callback',$e->getMessage(),'warning');
            abort(403);
        }



    }




    public function render()
    {
        return view('livewire.front.cart.callback');
    }
}
