<?php

namespace App\Http\Controllers\Front\Store\Cart;

use App\Http\Controllers\Controller;
use App\Models\Address;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\History;

use App\Models\Order;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;


class CheckoutController extends Controller
{
    public function index()
    {


        if (auth()->check()) {


            $user_id = auth()->user()->id;


            $addresses = Address::where('user_id', $user_id)->get();

            Cart::where('user_id', $user_id)
                ->where('status', 'pending')
                ->whereQuantity(0)->delete();

            $items = Cart::where('user_id', $user_id)
                ->where('status', 'pending')
                ->get();

            if ($items->count() < 1)
            {
                toast()->info('هنوز محصولی به سبد خرید اضافه نکرده اید','')->position('center');
                return redirect()->route('home');

            }

            $unitPrice = [];
            $subtotal = 0; // Initialize the subtotal variable outside the loop

            foreach ($items->load(['product','type']) as $item) {

                   $discount = $item->product->discount ?? 0;
                   $price = $item->type->price ?? 0;

                   $finalPrice =  ($price * (1 - $discount / 100));

                   $subtotal += ($finalPrice * $item->quantity); // Accumulate the final price to the subtotal

                   $unitPrice[$item->id] = $finalPrice;


            }
            if ($subtotal == 0)
            {
                if (Session::has('price') && Session::has('discount'))
                {
                    session()->forget(['price','discount']);

                }
                return redirect()->route('home');
            }


            return view('front.shop.checkout.index', compact('items', 'unitPrice', 'addresses','subtotal'));
        }
        else
        {
            Alert::info('هیچ محصولی در سبد خرید ندارید','ثبت نام کنید');
            return redirect()->route('home');
        }

    }


    public function selectAddress(Request $request)
    {
        if ( auth()->check() )
        {

        $active_id = $request->input('data_id');
        $user_id = auth()->user()->id;

        Address::where('user_id', $user_id)->update(['is_default' => 0]);

        Address::where('user_id', $user_id)->where('id', $active_id)->update(['is_default' => 1]);

        return response()->json(['message' => $active_id],200);

            }
        }


        public function registerAddress(Request $request)
        {
            // Validate the request data
            $validatedData = $request->validate([
                // Add validation rules for each field
                'province' => 'required|string',
                'city' => 'required|string',
                'postal_address' => 'required|string',
                'postal_code' => 'string',
                'building_number' => 'string',
                'unit_number' => 'string',
                'recipient_name' => 'required|string',


            ]);
            $user_id = Auth::id();

            $address = new Address([
                'user_id' => $user_id,
                'province' => $validatedData['province'],
                'city' => $validatedData['city'],
                'postal_address' => $validatedData['postal_address'],
                'postal_code' => $validatedData['postal_code'],
                'building_number' => $validatedData['building_number'],
                'unit_number' => $validatedData['unit_number'],
                'recipient_name' => $validatedData['recipient_name'],
                'is_default' => 1

            ]);


            // Save the address to the database
            $address->save();

          $othder_address = Address::where('user_id',$user_id)->where('id','!=',$address->id)->get();
            foreach ($othder_address as $othder_address) {
                $othder_address->is_default = 0;
                $othder_address->save();

            }


            Alert::success('آدرس شما با موفقیت ثبت شد.');
            return redirect()->route('checkout/cart',['level' => 'shipping']);
        }


    public function payment(Request $request)
    {


        //Get Real Total Price For Payment Order From Sessions
        if (Session::has('price') && Session::has('discount'))
        {
            $price = Session::get('price');
            $fixed_tax_rate =   getSetting('fixed_tax_rate');
            $fixed_shipping_cost =   getSetting('fixed_shipping_cost');
            $grand_total = $price +  (($price * ($fixed_tax_rate/100)) + $fixed_shipping_cost);
             $finalPrice = round($grand_total);

        }
        else
        {
            $user_id = auth()->id();
            $items = Cart::where('user_id', $user_id)
                ->where('status', 'pending')
                ->get();

            $subtotal = 0; // Initialize the subtotal variable outside the loop
            //Get Real Total Price For Payment Order
            foreach ($items->load(['product','type']) as $item) {
                $discount = $item->product->discount;
                $price = $item->type->price;
                $finalPrice =  ($price * (1 - $discount / 100));
                $subtotal += ($finalPrice * $item->quantity); // Accumulate the final price to the subtotal

            }
            $price = $subtotal;
            $fixed_tax_rate =   getSetting('fixed_tax_rate');
            $fixed_shipping_cost =   getSetting('fixed_shipping_cost');
            $grand_total = $price +  (($price * ($fixed_tax_rate/100)) + $fixed_shipping_cost);
            $finalPrice = round($grand_total);



        }
        //get discount value
        $discountValue = Session::get('discount') ?? 0;

        // Create an Order
        $default_address = Address::where('is_default',1)->first() ?? 0;
        $order = new Order();

        $order->order_number = $this->OrderNumber();
        $order->address_id = $default_address->id;
        $order->user_id = Auth::id();
        $order->status = 'waiting';
        $order->total_price = $finalPrice;
        $order->payment_status = 'pending';
        $order->payment_method = 'ZARINPAL';

        //Get Default Address for user;
        if ($default_address->recipient_phone != null)
        {
            $phone = $default_address->recipient_phone;
        }
        else
        {
            $phone = Auth::user()->phone;
        }
        $fullAddress =  $default_address->province. '  ' . $default_address->city . '  ' . $default_address->postal_address.
            ' پلاک  ' . $default_address->building_number . ' ' . 'واحد  ' . $default_address->unit_number . '  کد پستی ' . $default_address->postal_code .
            '  گیرنده :  '. $default_address->recipient_name . ' شماره تماس : ' . $phone;
        $order->shipping_address = $fullAddress;
        $order->shipping_method = 'post';
        $order->shipping_cost = getSetting('fixed_shipping_cost') ?? 0;
        $order->tax = getSetting('fixed_tax_rate') ?? 0;
        $order->discount_amount = $discountValue;
        $order->subtotal = $finalPrice;
        $order->grand_total = $finalPrice;
        $order->currency = 'IRT';
        $order->payment_due_date = now();
        $order->save();


        //End Create Order

        if ($finalPrice > 1000000000 || $finalPrice < 10000)
        {
            Order::where('id', $order->id)->delete();
            Alert::warning('خطا در مبلغ سفارش','مبلغ سفارش شما قابل پردازش نیست');
            return   redirect()->route('checkout/cart');

        }



if(!$this->canReduce())
       {
           Order::where('id',$order->id)->where('status','waiting')->delete();
           Alert::warning('کمبود موجودی انبار','موجودی سبد خرید شما بیش از موجودی انبار است ، لطفا سبد خرید را بازبینی کنید.');
           return   redirect()->route('checkout/cart',['level'=>'payment']);
       }
       else
       {


           //Send user to Payment
           $email = '';
           $mobile  = Auth::user()->phone;
           $amount = $finalPrice;
           $description = 'پرداخت برای محصول';

           //create transaction
           $transaction = new Transaction();
           $transaction->order_id = $order->id;
           $transaction->user_id = auth()->user()->id ?? 0;
           $transaction->amount = $amount;
           $transaction->payment_method = 'ZARINPAL';
           $transaction->transaction_id = null;
           $transaction->status = 'pending';
           $transaction->save();

           $response = zarinpal()
               ->amount($finalPrice) // مبلغ تراکنش$finalPrice
               ->request()
               ->description($description) // توضیحات تراکنش
               ->callbackUrl(route('zarinpal-payment-callback'))
               ->mobile($mobile)
               ->email($email)
               ->send();

           if (!$response->success())
           {

               $message = $response->error()->message();
               Alert::error('خطا در پرداخت',$message);
               setLog('Zarinpal-Payment-Error',$message . $order->id ,'warning');
               return redirect()->back();
           }
           $transaction->transaction_id = $response->authority();
           $transaction->save();



           return $response->redirect();

       }

    }


    private function OrderNumber()
    {
        $characters = '123456789';
        $code = '';

        for ($i = 0; $i < 8; $i++)
        {
            $randomIndex =  mt_rand(0, strlen($characters) - 1);
            $code .= $characters[$randomIndex];
        }

        return $code;
    }


    public function CouponValidate( Request $request )
    {
        // Validate input data
        $validatedData = $request->validate([
            'couponId' => 'required|string|exists:coupons,code',
            'subtotal' => 'required',
            'subtotal_enc' => 'required',

        ]);

        // Extract validated data
        $couponId = $validatedData['couponId'];
        $subtotal = $validatedData['subtotal'];
        $subtotal_enc = $validatedData['subtotal_enc'];
        if($subtotal != decrypt($subtotal_enc))
        {
            Alert::error('خطای امنیتی');
            setLog('Coupon_Store','Data Manipulation From Front In Order Coupon','danger');
            return redirect()->back();
        }


            // Check if the coupon code exists in the database
            $coupon = Coupon::whereCode($couponId)->first();
            if (!$coupon) {
                Alert::warning('کد تخفیف نادرست است');
                return redirect()->back();
            }

            // Check if the coupon has not expired
            $currentDate = Carbon::now();
            $endDate = Carbon::parse($coupon->end_date);
            if ($currentDate->greaterThanOrEqualTo($endDate)) {

                Alert::warning('کد تخفیف منقضی شده است');
                return redirect()->back();
            }
            //clear old sessions
            if (Session::has('price') && Session::has('discount'))
            {
                session()->forget(['price','discount']);

            }

        if ($coupon)
        {
            $value = $coupon->value;
            if ($coupon->type == 'percentage')
            {

                $discount = $subtotal * ($value / 100); // Calculate the discount amount
                $price = $subtotal - $discount; // Subtract the discount from the subtotal
            }
            else
            {
                $price = $subtotal - ($value);
                $discount = $coupon->value;

            }

            Session::put('price',$price);
            Session::put('discount',$discount);


        }



        return redirect()->back();


    }



//recheck quantity of carts items into batches
    private function canReduce()
    {

        // Check Available before send to payment
        return true;

    }







    private function deductInventory()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();

        foreach ($cartItems as $cart) {
            // Sort batches based on expire_date in descending order
            $sortedBatches = $cart->batches->sortBy('expire_date');

            foreach ($sortedBatches as $batch) {
                // Check if the batch has enough quantity
                while ($cart->quantity > 0 && $batch->quantity > $batch->sales_number) {
                    // Calculate the remaining quantity that can be sold from this batch
                    $remainingQuantity = $batch->quantity - $batch->sales_number;

                    // Calculate the quantity to be sold from this batch
                    $quantityToSell = min($remainingQuantity, $cart->quantity);

                    // Update the batch sales_number and save
                    $batch->sales_number += $quantityToSell;
                    $batch->save();

                    // Update the remaining quantity in the cart
                    $cart->quantity -= $quantityToSell;
                }
            }
        }
    }





    public function ZarinpalCallback(Request $request)
    {
        if (!auth()->check())
        {
            Alert::warning('خطا','خطایی رخ داده است،لطفا با پیشتیبان تماس بگیرید');
            setLog('Payment-Failed','پرداخت توسط کاربر احراز هویت نشده','danger');
            return redirect()->route('home');
        }

        $authority = request()->query('Authority');
        $status = request()->query('Status');
        if (!is_string($authority) || !is_string($status)) {
            abort(400, 'Bad Request');
        }
        $transaction = Transaction::where('transaction_id',$authority)->firstOrFail();

        $response = zarinpal()
            ->amount( $transaction->amount)  //$transaction->amount
            ->verification()
            ->authority($authority)
            ->send();



        if (!$response->success()) {
            $transaction->status = 'canceled';
            $transaction->amount = 0;
            $transaction->save();
            // Delete the order directly based on the condition
            Order::where('id', $transaction->order_id)->delete();
            $this->resetPriceDiscountSession();
            setLog('Zarinpal-Payment-Error',$response->error()->message() . ' تراکنش  :  ' . $transaction->id,'warning');
            Alert::warning($response->error()->message(),'مجددا اقدام به پرداخت و ثبت نهایی سفارش کنید');
            return redirect()->route('checkout/cart',['level'=>'payment']);

        }
        $order = Order::whereId($transaction->order_id)->firstOrFail();
        $transaction->reference_id = $response->referenceId();
        $transaction->status = 'paid';
        $transaction->card_hash = $response->cardHash();
        $transaction->card_pen = $response->cardPan();
        $transaction->save();


        $order->payment_method = 'zarinpal';
        $order->payment_transaction_id = $response->referenceId();
        $order->payment_status = 'paid';
        $order->status ='processing';
        $order->save();
        $orderId = $order->id;

        // Reduce Inventory quantity
        $this->deductInventory();

        //Transfer User Carts to histories and Clean Cart
        $this->transferCartToHistory($order->id);
        $this->resetPriceDiscountSession();
        return redirect()->route('invoice',['order'=>$order,'type' => 'invoice']);


    }


    private function transferCartToHistory($order_id)
{
    $user_id = Auth::id();
    //Transfer data to order_details table
    $carts = Cart::where('user_id',$user_id)->get(['user_id','product_id','type_id','quantity']);
    foreach ($carts as $cart)
    {
        $discount = $cart->product->discount;
        $model               = new History();
        $model->user_id      = $cart->user_id;
        $model->order_id     = $order_id;
        $model->product_id   = $cart->product->id;
        $model->quantity     = $cart->quantity;
        $model->price        = $cart->type->price - ( $cart->type->price * $discount / 100 );
        $model->product_name = $cart->product->name ?? '';
        $model->type_name    = $cart->type->name ?? '';
        $model->created_at   = Carbon::now();
        $model->save();

    }
    Cart::where('user_id', $user_id)->delete();

}



    private function resetPriceDiscountSession() : void

{
    if (Session::has('price') && Session::has('discount'))
    {
         session()->forget(['price','discount']);
    }
    }



    public function invoice( $order )
    {
        if (Auth::check())
        {
            if (is_numeric($order))
            {

                $order =  Order::with(['history','transactions'])->where('id',$order)->firstOrFail();

                if ($order->user_id == Auth::id())
                {

                    return view('front.shop.checkout.invoice',compact('order'));
                }
                else
                {
                    abort(404);
                }


            }
            else
            {
                abort(404);
            }


        }
        else

        {
            return redirect()->route('login');
        }


    }


}

