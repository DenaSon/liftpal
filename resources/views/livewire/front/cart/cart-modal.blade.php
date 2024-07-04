<div>
    <button class="btn btn-icon btn-light rounded-circle shadow position-fixed top-50 start-0 translate-middle-y ms-3"
            type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="سبد خرید" style="z-index: 1035;"
            data-target="#demo-switcher">
          <span class="position-absolute top-0 start-10 translate-middle badge rounded-pill bg-danger">
         {{ count($carts) }}

  </span>
        <div
            class="d-flex align-items-center justify-content-center position-absolute top-0 start-0 w-100 h-100 rounded-circle"
            data-bs-toggle="offcanvas" data-bs-target="#demo-switcher"><i class="fi-cart"></i></div>

    </button>

    <div wire:ignore.self class="offcanvas offcanvas-end" id="demo-switcher" data-bs-toggle="" data-bs-scroll="true">
        <div class="offcanvas-header d-block border-bottom">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="h5 mb-0 mx-auto">سبد خرید </h3>
                <button class="btn btn-outline-secondary btn-xs" type="button" data-bs-dismiss="offcanvas">بستن</button>

            </div>
        </div>

        <div class="offcanvas-body">


            @if(count($carts) == 0)
                <div class="d-flex align-items-center h-100 justify-content-center">
                    <h5 class="mx-auto align-self-center text-primary small"> محصولی در سبد خرید شما وجود ندارد</h5>
                </div>
            @endif

            @php
                $total = 0;
            @endphp
            @foreach($carts as $cart)
                <div wire:key="{{ $cart->id }}" class="">
                    <div class="row">
                        <div class="col-md-5">
                            <img class="img-thumbnail h-100" src="{{ asset($cart->product->images?->first()->file_path ?? '') }}"
                                 alt="{{ $cart->product->name }}">
                        </div>
                        <div class="col-md-7 shadow-sm">
                            <span class="small p-0">{{ $cart->product->name }} - {{ $cart->type->name }}</span>
                            <hr>
                            <div class="m-3">
                                @php
                                    $first_qty = $cart->batches->first()->quantity ?? 0;
                                    $sales = $cart->batches->first()->sales_number ?? 0;
                                    $remaining = $first_qty - $sales ?? 0;
                                @endphp

                            </div>

                            <div class="cart d-flex flex-wrap align-items-center rounded">
                                <button id="btn-{{$cart->id}}" wire:loading.attr="disabled"
                                        wire:click.debounce.500ms="increaseItem({{ $cart->id }})"
                                        class="btn btn-sm btn-outline-primary mx-auto"
                                        wire:loading.attr="disabled">+

                                </button>

                                <b class="p-2 mx-auto">{{ $cart->quantity }}</b>
                                <button wire:loading.attr="disabled" wire:loading.attr="disabled"
                                        wire:click.debounce.500ms="decreaseItem({{ $cart->id  }})"
                                        class="btn btn-sm btn-outline-primary  mx-auto">
                                    @if( $cart->quantity == 1 )
                                        <i class="fi-trash"></i>
                                    @else
                                        -
                                    @endif
                                </button>

                            </div>

                            <div class="d-block mt-2 p-1 text-center">
                                <span style="font-size:15px" class="mx-auto text-info">
                                    {{ number_format($cart->type->price * $cart->quantity) }}
                                </span>

                            </div>

                        </div>


                    </div>
                </div>
                <br/>

            @endforeach
        </div>

        <div class="offcanvas-footer border-top">


            @if(count($carts) != 0)
                <div class="cart-sum  text-center">
                <span class="text-sum fs-15 text-info">
                      جمع قیمت :
                </span>

                    <span class="text-sum fs-20 fw-bolder cart-sum-number text-info">
                   {{ number_format($totalPrice) }}
                تومان </span>

                    @if($cartDiscountAmount > 0)
                        <br/><br/>
                        <span class="text-sum fs-20 fw-bold small text-danger mb-3">
                            تخفیف :    {{ number_format($cartDiscountAmount) }}  تومان </span>
                        <br/>
                    @endif


                </div>
                <hr/>

                @if(!$cartDiscountAmount)
                    <div class="cart-discount">
                <span class="text-sum fs-15 text-info">

                <div x-data="{ showInput: false }" class="input-group align-items-center">
                    <a id="coupon" href="javascript:void(0)"
                       class="fw-bold mx-auto text-primary text-decoration-none"
                       @click="showInput = true; $refs.couponInput.classList.remove('d-none'); $el.classList.add('d-none')">
                        کد تخفیف دارید ؟
                    </a>
                    <input id="couponInput" wire:model.live.debounce.550ms="cartDiscount" type="text"
                           x-ref="couponInput"
                           class="form-control border-primary shadow-lg d-none"
                           placeholder="وارد کردن کد تخفیف">
                </div>

                    <div class="" wire:dirty wire:target="cartDiscount">درحال بررسی...</div>
                </span>
                    </div>
                @endif

            @endif

            <a wire:click.debounce.500ms="orderRegister"
               style="border-radius:0"
               class="btn btn-lg w-100 {{ count($carts) < 1 ? 'btn-secondary' : 'btn-primary' }}">

                <i class="fi-cart fs-lg me-2"></i>
                <span> ثبت نهایی سفارش </span>

            </a>


        </div>
    </div>


    <style>
        .cart {
            display: flex;
            align-items: center;
        }

        button {
            margin: 4px;
        }

        #counter {
            font-size: 0.9rem;
            padding: 0 10px;
        }

        .cart-sum {
            padding: 25px 10px 2px 2px;

        }

        .cart-discount {
            padding: 20px;
        }

        .cart-sum-number {
            text-align: center;
        }


    </style>

    @include('livewire.front.cart.inc.get-address-modal')

</div>


@script
<script>


    $wire.on('getAddressModal', () => {

        var offcanvasElement = document.getElementById('demo-switcher');

        var offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);

        offcanvasInstance.hide();
        // Show the modal
        var modalElement = new bootstrap.Modal(document.getElementById('get-address-modal'));
        modalElement.show();

    });
</script>

@endscript
