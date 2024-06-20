<?php
namespace App\Http\Controllers\Front\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Phpml\Dataset\ArrayDataset;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;
use function PHPUnit\Framework\isEmpty;
class PaymentController extends Controller
{
    public function PaymentValidate($order_number,Request $request)
    {


        // Validate input data
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'order_number' => 'required|numeric|exists:orders,order_number',
            'payment_method' => 'required|string'
        ]);

        // Extract validated data
        $amount = $validatedData['amount'];
        $encryptedOrderNumber = $request->input('enc_order_number');
        $orderNumber = $validatedData['order_number'];
        $payment_method = $request->input('payment_method');

        try {
            // Decrypt the encrypted order number and check if it matches the provided order number
            $decryptedOrderNumber = Crypt::decrypt($encryptedOrderNumber);
            if ($decryptedOrderNumber != $orderNumber || $decryptedOrderNumber != $order_number ) {
                // Handle the case where data is tampered with or invalid
                setLog('Fake_PaymentAmount', 'دستکاری امنیتی', 'danger');
                Alert::error('دستکاری امنیتی', 'اطلاعات شما جهت بررسی ثبت شد');
                return redirect()->back();
            }
        }
        catch (Throwable $e)
        {
            // Handle any exceptions that may occur
            setLog('Fake_PaymentAmount', 'دستکاری امنیتی ' . $e->getMessage(), 'danger');
            Alert::error('دستکاری امنیتی', 'اطلاعات شما جهت بررسی ثبت شد');
            return redirect()->back();
        }



            // Retrieve the order from the database and check if it belongs to the authenticated user
            $order = Order::where('order_number', $orderNumber)->firstOrFail();
            if ($order->user_id !== auth()->user()->id) {
                Alert::warning('سفارش مطعلق به کاربر نیست');
                return redirect()->back();
            }

            if ($amount != $order->grand_total)
            {
                // Handle the case where data is tampered with or invalid
                setLog('Fake_PaymentAmount', 'دستکاری امنیتی', 'danger');
                Alert::error('دستکاری امنیتی', 'اطلاعات شما جهت بررسی ثبت شد');
                return redirect()->back();
            }
            else
            {
                $description = ' پرداخت سفارش  ' . ' : '. $order->order_number;
                $callbackUrl = \route('zarinpal-payment-callback');
                $mobile = $order->user->phone ?? '';
                $email = $order->user->email ?? '';
                $orderId = $order->id;

                //Send Payment Method Based on User Select
               if ($payment_method == 'zarinpal')
               {
                   return $this->ZarinpalPay($orderId,$amount,$description,$callbackUrl,$mobile,$email);
               }
               elseif ($payment_method == 'melat')
               {
                   return false;
               }
               else
               {
                   return  false;
               }


            }


    }

    private function ZarinpalPay( $orderId , $amount, $description , $callback , $mobile , $email)
    {
        $transaction = new Transaction();
        $transaction->order_id = $orderId;
        $transaction->user_id = auth()->user()->id ?? 0;
        $transaction->amount = $amount;
        $transaction->payment_method = 'zarinpal';
        $transaction->transaction_id = null;
        $transaction->status = 'pending';
        $transaction->save();

        $response = zarinpal()
            ->amount($amount)
            ->request()
            ->description($description)
            ->callbackUrl($callback)
            ->mobile($mobile)
            ->email($email)
            ->send();

        if (!$response->success()) {
            $transaction->status = 'canceled';
            $transaction->save();
            Alert::warning($response->error()->message());
            return redirect()->route('order.show',['order_number' => $orderId]);
        }

        $transaction->transaction_id = $response->authority();
        $transaction->save();


      if ($this->DeductInventory( $orderId ) === 'bank')
      {
        return  $response->redirect();
      }
      elseif($this->DeductInventory($orderId) !=='bank' || is_array($this->DeductInventory($orderId)))
      {
          Alert::warning('کمبود موجودی | اصلاح سفارش',  $this->DeductInventory($orderId));
          $transaction->delete();
          return redirect()->back();
      }
      else
      {
          setLog('InventoryDeduct_Payment','خطا در توابع مدیریت موجودی و پرداخت سفارش' . $orderId ,'danger');
          return redirect()->route('log-system');
      }


    }


    public function ZarinpalCallback(Request $request)
    {
        $authority = request()->query('Authority');
        $status = request()->query('Status');
        if (!is_string($authority) || !is_string($status)) {
            abort(400, 'Bad Request');
        }
        $transaction = Transaction::where('transaction_id',$authority)->firstOrFail();

        $response = zarinpal()
            ->amount($transaction->amount)
            ->verification()
            ->authority($authority)
            ->send();

        if (!$response->success()) {
            Alert::warning($response->error()->message());
            $transaction->status = 'canceled';
            $transaction->amount = 0;
            $transaction->save();
            return redirect()->route('dashboard');
        }

        $transaction->reference_id = $response->referenceId();
        $transaction->status = 'paid';
        $transaction->card_hash = $response->cardHash();
        $transaction->card_pen = $response->cardPan();
        $transaction->save();

        $order = Order::whereId($transaction->order_id)->firstOrFail();
        $order->payment_method = 'zarinpal';
        $order->payment_transaction_id = $response->referenceId();
        $order->payment_status = 'paid';
        $order->status ='processing';
        $order->save();
        $orderId = $order->id;

        if ($this->DeductInventory($orderId,true) === 'bank')
        {
            return $response->referenceId();
        }
        elseif($this->DeductInventory($orderId,true) !=='bank' || is_array($this->DeductInventory($orderId)))
        {

            $description = 'خطای همزمانی: پرداخت موفق برای سفارش ناموجود شماره ' .' '.$orderId . 'برای کاربر شماره ' .' '. $order->user_id .' ' .'رخ داده است';
            setLog('Concurrency-Error',$description,'warning');
        }
        else
        {
            setLog('InventoryDeduct_Payment','خطا در توابع مدیریت موجودی و پرداخت سفارش' . $orderId ,'danger');
            return redirect()->route('log-system');
        }




    }



    private function DeductInventory($orderId,$deduct = false)
    {
        // یافتن سفارش با استفاده از شماره سفارش (orderId)
        $order = Order::with('products.batches')->find($orderId);
        if (!$order)
        {
            $result = false;
        }

        // یک آرایه برای نگهداری دسته‌های انتخاب شده برای هر محصول ایجاد می‌شود
        $selectedBatches = [];

        // بررسی موجودی هر محصول در سفارش و انتخاب بهترین دسته برای هر محصول
        foreach ($order->products as $product)
        {
            foreach ($product->batches as $batch)
            {
                // تعداد کالاهایی که کاربر در سفارش داده است
                $decreaseQuantityInOrder = $product->pivot->quantity;
                $sales_number = $batch->sales_number;
                $requestQty = $decreaseQuantityInOrder + $sales_number;

                // اگر شرایط مطابقت دارند، دسته بهترین برای این محصول انتخاب می‌شود
                if (!isset($selectedBatches[$product->id]) || ($batch->expire_date < $selectedBatches[$product->id]->expire_date && $batch->quantity >= $requestQty))
                {
                    // اگر شرایط مطابقت نداشته باشند و موجودی دسته کافی نباشد، به دسته بعدی بروید
                    while ($batch->quantity < $requestQty)
                    {
                        // انتخاب دسته بعدی
                        $nextBatch = $product->batches->where('expire_date', '>', $batch->expire_date)
                            ->where('quantity', '>=', $requestQty)
                            ->sortBy('expire_date')
                            ->first();

                        // اگر دسته بعدی پیدا نشود، خروج از حلقه
                        if (!$nextBatch)
                        {
                            break;
                        }

                        // انتخاب دسته بعدی به عنوان دسته فعلی و تغییر متغیر batch
                        $batch = $nextBatch;
                    }

                    $selectedBatches[$product->id] = $batch;
                }
            }
        }

        // نتیجه کلی عملیات کسر از انبار؛ به ابتدا نتیجه مثبت فرض می‌شود
        $result = true;
        $productsWithLowInventory = [];
        // بررسی تعداد کالاها و انجام عملیات کسر از انبار
        foreach ($selectedBatches as $productId => $selectedBatch)
        {
            $decreaseQuantityInOrder = $order->products->find($productId)->pivot->quantity;
            $selectedBatchQty = $selectedBatch->quantity - $selectedBatch->sales_number;

            // اگر تعداد کالاهای درخواستی بیشتر از تعداد موجود در دسته‌ای باشد، نتیجه به صورت منفی تنظیم می‌شود
            if ($selectedBatchQty < $decreaseQuantityInOrder)
            {
                $productsWithLowInventory[] = $selectedBatch->product->name ;
                $result = false;
                //break;
            }
        }

        // اگر نتیجه مثبت باقی بماند، عملیات کسر از انبار انجام می‌شود
        if ($result)
        {
            foreach ($selectedBatches as $productId => $selectedBatch)
            {
                //Check the method usage is for deduct or check before payment only
                if ($deduct)
                {
                    $decreaseQuantityInOrder = $order->products->find($productId)->pivot->quantity;
                    //Increase Sales - so Deduct Inventory
                    $selectedBatch->increaseSale($decreaseQuantityInOrder);
                }
                else
                {
                    break;
                }
            }
        }

        // نتیجه نهایی  برگشت داده می‌شود

              if(empty($productsWithLowInventory) || count($productsWithLowInventory) == 0)
              {
                  return 'bank';
              }
              else
              {
                  return $productsWithLowInventory;
              }

    }











}
