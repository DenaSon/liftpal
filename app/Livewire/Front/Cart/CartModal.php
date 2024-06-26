<?php

namespace App\Livewire\Front\Cart;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class CartModal extends Component
{
    use LivewireAlert;

    #[Locked]
    public $id;
    public $carts = [];
    public $totalPrice = 0;
    #[Validate('string')]
    public $cartDiscount;
    public $itemTotal;
    public $cartDiscountAmount = 0;
    public $total = 0;
    public $fixed_tax_rate;
    public $fixed_shipping_cost;

    public $finalPrice;


    // Get address fields
    public $province;
    public $country;
    public $city;
    public $postalAddress;
    public $postalCode;
    public $buildingNumber;
    public $unitNumber;

    public function mount()
    {
        $this->updateCart();
        $this->calculateTotal();

        $this->fixed_shipping_cost = getSetting('fixed_shipping_cost') ?? 0;
        $this->fixed_tax_rate = getSetting('fixed_tax_rate') ?? 0;


    }

    public function updateCart()
    {
        $this->carts = Cart::whereUserId(auth()->id())->get();
        $this->calculateTotal();
        $this->cartDiscountAmount = 0;

    }

    public function calculateTotal()
    {
        $price = 0;
        foreach ($this->carts as $cart) {
            $price += $cart->type->price * $cart->quantity;
        }
        $this->totalPrice = $price;

    }

    public function increaseItem($id)
    {
        $this->updateItemQuantity($id, 1);
        if(session()->has('cartDiscountAmount'))
        {
            session()->put('cartDiscountAmount',0);
        }

    }

    protected function updateItemQuantity($id, $amount)
    {
        DB::transaction(function () use ($id, $amount) {
            $cart = Cart::find($id);
            $cart->increment('quantity', $amount);

            if ($cart->quantity <= 0) {
                $cart->delete();
            }
            else
            {
                $cart->save();
            }

            $this->reset('cartDiscount');
            $this->updateCart();
        });
    }

    public function decreaseItem($id)
    {
        $this->updateItemQuantity($id, -1);
        if(session()->has('cartDiscountAmount'))
        {
            session()->put('cartDiscountAmount',0);
        }

    }

    public function updatedCartDiscount($value)
    {
        if (strlen($value) >= 5) {
            $this->checkDiscount($value);
        }
    }

    public function checkDiscount($value)
    {
        if ($coupon = Coupon::whereCode($value)->first()) {
            $value = $coupon->value;
            if ($coupon->type == 'fixed_amount')
            {
                $priceWithDiscount = $this->totalPrice - $value;
                $this->cartDiscountAmount = $coupon->value;
                session()->put('priceWithDiscount',$priceWithDiscount);
                session()->put('cartDiscountAmount',$this->cartDiscountAmount);
            }
            else
            {
                $priceWithDiscount = $this->totalPrice - ($this->totalPrice * $value / 100);
                $this->cartDiscountAmount = $this->totalPrice - $priceWithDiscount;
                session()->put('priceWithDiscount',$priceWithDiscount);
                session()->put('cartDiscountAmount',$this->cartDiscountAmount);
            }
            $this->totalPrice = $priceWithDiscount;
            session()->put('priceWithDiscount',$priceWithDiscount);
        }
        else
        {
            $this->cartDiscountAmount = 0;
            $this->alert('warning', 'کد تخفیف صحیح نیست', ['position' => 'center']);
        }
    }




    private function OrderNumber()
    {
        $characters = '123456789';
        $code = '';

        for ($i = 0; $i < 8; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $code .= $characters[$randomIndex];
        }

        return $code;
    }

    /**
     */
    public function orderRegister()
    {
        $authId = auth()->id();

        if (!userAddressExist($authId))
        {

            $this->dispatch('getAddressModal');


        }

        else
        {
            $carts = Cart::whereUserId($authId)->get();
            if (!$carts->isEmpty())
            {
                $default_address = Address::where('is_default', 1)
                    ->whereUserId($authId)
                    ->first() ?? 0;

                $order = new Order();

                $order->order_number = $this->OrderNumber();
                $order->address_id = $default_address->id ?? null;
                $order->user_id = $authId;
                $order->status = 'waiting';
                $priceWithDiscount = $this->totalPrice - $this->cartDiscountAmount;
                $order->total_price = (($priceWithDiscount) * $this->fixed_tax_rate / 100) + (($this->fixed_shipping_cost) + $priceWithDiscount);
                $order->payment_status = 'pending';
                $order->payment_method = 'ZARINPAL';

                //Get Default Address for user;
                if ($default_address->recipient_phone != null) {
                    $phone = $default_address->recipient_phone;
                }
                else {
                    $phone = Auth::user()->phone;
                }
                $fullAddress = $default_address->province . '  ' . $default_address->city . '  ' . $default_address->postal_address .
                    ' پلاک  ' . $default_address->building_number . ' ' . 'واحد  ' . $default_address->unit_number . '  کد پستی ' . $default_address->postal_code .
                    '  گیرنده :  ' . $default_address->recipient_name . ' شماره تماس : ' . $phone;
                $order->shipping_address = $fullAddress;
                $order->shipping_method = 'post';
                $order->shipping_cost = $this->fixed_shipping_cost;
                $order->tax = $this->fixed_tax_rate;
                $order->discount_amount = $this->cartDiscountAmount;

                $order->subtotal =
                $order->grand_total = $this->totalPrice;
                $order->currency = 'IRT';
                $order->payment_due_date = now();
                $order->save();

                session()->put('orderNumber',$order->order_number);

                Cart::whereUserId(auth()->id())->delete();
                $this->redirectRoute('checkout',['status'=>'beforePay'],true,true);
            }
            else
            {
                $this->alert('info','محصولی در سبد خرید وجود ندارد',['position'=>'center']);
            }
        }
    }

    public function saveAddress()
    {
        // Validate the fields
        $validatedData = $this->validate([
            'province' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postalAddress' => 'required|string|max:255',
            'postalCode' => 'required|string|max:20',
            'buildingNumber' => 'required|string|max:10',
            'unitNumber' => 'nullable|string|max:10',
        ]);
        $validatedData['is_default'] = 1;

        // Save the validated data to the Addresses table
        Address::create($validatedData);

        // Optionally, you can reset the form fields or show a success message
        $this->reset(['province', 'country', 'city', 'postalAddress', 'postalCode', 'buildingNumber', 'unitNumber']);


    }


    public function render()
    {
        return view('livewire.front.cart.cart-modal', [
            'carts' => $this->carts,
            'cartDiscountAmount' => $this->cartDiscountAmount,
        ]);
    }
}
