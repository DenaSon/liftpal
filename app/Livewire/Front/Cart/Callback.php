<?php

namespace App\Livewire\Front\Cart;

use App\Models\Cart;
use App\Models\History;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
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

            // abort(403);
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

                //Transfer data to user history
                $this->transferToHistory($this->order->id);




            }

        }
        catch (Throwable $e)
        {
            setLog('ZarinpalPayment-Callback',$e->getMessage(),'warning');
            abort(403);
        }



    }

    private function transferToHistory($order_id)
    {
        $user_id = auth()->id();

        // Eager load product and type relationships
        $carts = Cart::where('user_id', $user_id)->with(['product', 'type'])->get(['user_id', 'product_id', 'type_id', 'quantity']);

        if ($carts->isEmpty()) {
            \Log::info('No carts found for user_id: ' . $user_id);
            return;
        }

        $historyData = [];
        $now = Carbon::now();

        foreach ($carts as $cart) {
            if (!$cart->product || !$cart->type) {
                \Log::warning('Missing product or type for cart item: ' . $cart->id);
                continue; // Skip this cart item if relationships are missing
            }

            $historyData[] = [
                'order_id' => $order_id,
                'product_id' => $cart->product->id,
                'user_id' => $cart->user_id,
                'quantity' => $cart->quantity,
                'price' => $cart->type->price,
                'product_name' => $cart->product->name ?? '',
                'type_name' => $cart->type->name ?? '',
                'created_at' => $now,
            ];
        }

        if (empty($historyData)) {
            \Log::info('No valid cart data to insert into history for user_id: ' . $user_id);
            return;
        }

        \DB::transaction(function () use ($historyData, $user_id) {
            // Insert all records in one query for better performance
            History::insert($historyData);

            // Clear the user's cart
            Cart::where('user_id', $user_id)->delete();
        });

        \Log::info('Transferred ' . count($historyData) . ' cart items to history for user_id: ' . $user_id);
    }





    public function render()
    {
        return view('livewire.front.cart.callback');
    }
}
