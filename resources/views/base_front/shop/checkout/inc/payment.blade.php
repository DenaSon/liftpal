    <div class="chekout-coupon">
        <button class="coupon-btn">آیا کد تخفیف دارید؟</button>
        <form class="coupon-form" method="post" action="{{ route('couponValidator') }}">
            @csrf
            <input type="hidden" value="{{ $subtotal }}" name="subtotal">
            <input type="hidden" name="subtotal_enc" value="{{ encrypt($subtotal) }}">

            <label for="order_discount" class="visually-hidden"></label>
            <input id="order_discount" name="couponId" type="text" placeholder="کد تخفیف خود را وارد کنید">
            <button type="submit"><span>اعمال</span></button>
        </form>
    </div>


    <div class="checkout-charge">
        <ul>
            <li>
                <span>جمع </span>
                <span class="price">{{ number_format($subtotal) }}</span>
            </li>
            <li>
                <span>هزینه ارسال</span>
                <span>
                @if(getSetting('fixed_shipping_cost') == 0)
                    رایگان
                    @else
                    {{ number_format( getSetting('fixed_shipping_cost'))  }}
                @endif
                </span>
            </li>
            @if(getSetting('fixed_tax_rate') != 0)
            <li>

                <span> مالیات</span>
                <span>
                @if(getSetting('fixed_tax_rate') == 0)
                        0
                    @else
                        {{ number_format( getSetting('fixed_tax_rate'))  }}  %
                    @endif
                </span>
            </li>
            @endif


            <li>
                <span>تخفیف</span>
                <span> <b>
                    @if(session()->has('discount'))
                    {{ number_format(\Illuminate\Support\Facades\Session::get('discount',0)) }} تومان
                    @else
                   0
                    @endif
               </b> </span>
            </li>
            <li>
               <span> قیمت نهایی </span>
                @php
                if (session()->has('price'))
                    {
                        $price = \Illuminate\Support\Facades\Session::get('price',0);
                        $fixed_tax_rate =   getSetting('fixed_tax_rate');
                        $fixed_shipping_cost =   getSetting('fixed_shipping_cost');
                        $finalPrice = $price +  (($price * ($fixed_tax_rate/100)) + $fixed_shipping_cost);
                    }
                else
                    {
                        $price = $subtotal;
                        $fixed_tax_rate =   getSetting('fixed_tax_rate');
                        $fixed_shipping_cost =   getSetting('fixed_shipping_cost');
                        $finalPrice = $price +  (($price * ($fixed_tax_rate/100)) + $fixed_shipping_cost);
                    }

                 @endphp
                <span> <b>
                {{ number_format($finalPrice)  }} تومان
              </b>  </span>
            </li>
        </ul>
    </div>
    <form action="{{ route('orderPayment') }}" method="post">

        @csrf
    <button type="submit" class="mt-5 btn btn-outline order-register-button">     <span class="fas fa-money-check"> </span> &nbsp;    پرداخت </button>
    </form>
