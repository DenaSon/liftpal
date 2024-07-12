<?php

namespace App\Livewire\Front\Cart;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class Checkout extends Component
{
    use LivewireAlert;

    #[Locked]
    public $id;
    #[Locked]
    public $orderNumber;
    public $order;
    public $carts = [];
    public $totalPrice = 0;
    #[Validate('string')]
    public $cartDiscount;
    public $itemTotal;
    public $cartDiscountAmount = 0;
    public $total = 0;
    public $fixed_tax_rate;
    public $fixed_shipping_cost;
    public $priceWithDiscount;
    public $finalPrice;
    public $paymentPrice = 0;



    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function mount()
    {

        //check authenticate
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        else
        {
            $authId = auth()->user()->id;

            //Check for customer address
            if(!userAddressExist($authId))
            {
                $this->flash('warning','آدرس محل ارسال را انتخاب کنید');
                $this->redirectRoute('blogIndex');
            }




       if (session()->has('orderNumber'))
       {
           session()->regenerate();
           $this->orderNumber = session()->get('orderNumber');
           $this->order = Order::whereOrderNumber($this->orderNumber)->firstOrFail();

       }
       else
       {
           abort(404,'انقضاء سفارش');
       }


        }

    }

    public function startPayment()
    {
        try {

            $paymentPrice = $this->order['total_price'];
            $description = 'پرداخت سفارش';
            $callBackUrl = route('zarinpal-callback');
            $phone = auth()->user()->phone ?? '09999999999';
            $email = auth()->user()->email ?? 'info@test.com';
            session()->put('paymentPrice', $paymentPrice);

            $response = zarinpal()
                ->amount(1000) // مبلغ تراکنش$finalPrice
                ->request()
                ->description($description) // توضیحات تراکنش
                ->callbackUrl($callBackUrl)
                ->mobile($phone)
                ->email($email)
                ->send();
            if (!$response->success())
            {

                $errorMessage = $response->error()->message();
                $this->alert('warning',$errorMessage);
                setLog('Zarinpal-PaymentError',$errorMessage . ' شماره سفارش: '. $this->order['id'] ,'warning');
                return;

            }


            //create transaction
            $transaction = new Transaction();
            $transaction->order_id = $this->order['id'];
            $transaction->user_id = auth()->user()->id ?? 0;
            $transaction->amount = $this->order['total_price'];
            $transaction->payment_method = 'ZARINPAL';
            $transaction->status = 'pending';
            $transaction->transaction_id = $response->authority();
            $transaction->save();

            $callbackToken = Str::random(8);
            session()->put('callbackToken',$callbackToken);

            $paymentUrl = 'https://www.zarinpal.com/pg/StartPay/'.$response->authority();

           $this->redirect($paymentUrl);


        }
        catch (\Throwable $exception) {
            $this->alert('warning', $response->error()->message(), ['position' => 'center']);
            setLog('Payment-Error', $exception->getMessage(). '-'.$exception->getLine(), 'danger');
        }

    }


    public function render()
    {

        return view('livewire.front.cart.checkout');
    }
}
