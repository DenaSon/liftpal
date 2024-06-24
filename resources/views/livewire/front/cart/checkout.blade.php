<div>
@section('css')

<link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">

@endsection

@include('livewire.front.home-inc.header')


<div class="container mt-5 mb-md-4 pt-5">
<nav class="mb-3 pt-md-3" aria-label="breadcrumb">

</nav>
</div>


<!-- ============================ Contact Detail ================================== -->

<section class="container mb-5 pb-2 pb-md-4 pb-lg-5">
<div class="row align-items-md-start align-items-center gy-4">
    <div class="col-lg-3 col-md-3">
        <div class="mx-md-0 mx-auto mb-md-5 mb-4 pb-md-4 text-md-start text-center" style="max-width: 416px;">


        </div>
        <img class="d-block mx-auto rotate-img"
             src="{{ asset('assets/img/real-estate/illustrations/checkout.png') }}" alt="Illustration"
             height="200">
    </div>
    <div class="col-md-8 offset-lg-1">
        <div class="card border-0 bg-white p-sm-3 p-2">
            <div class="card-body m-1">

                <ul class="list-group">
                    <li class="bg-warning text-white list-group-item d-flex justify-content-between align-items-center">
                        <span>
                         شماره سفارش
                        </span>
                        <span class="fw-bold fs-16 small fw-normal">{{ $orderNumber  }}</span>
                    </li>


                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            مجموع خرید
                        </span>
                        <span class="fw-bold fs-16">{{ number_format($order->grand_total) }}</span>
                        </li>

                        @if($order->discount_amount > 0)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                           تخفیف
                        </span>
                            <span class="fw-bold fs-16">{{ number_format($order->discount_amount) }}</span>
                        </li>
                        @endif
                    @if($order->shipping_cost > 0)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                           هزینه ارسال
                        </span>
                            <span class="fw-bold fs-16">{{ number_format($order->shipping_cost) }}</span>
                        </li>
                    @endif

                    @if($order->tax > 0)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                           مالیات
                        </span>
                            <span class="fw-bold fs-16">%{{ number_format($order->tax) }}</span>
                        </li>
                    @endif

                    <li class="list-group-item d-flex justify-content-between align-items-center border border-1 border-primary ">
                        <span>
                          مجموع قیمت
                        </span>
                        <span class="fw-bold fs-20">{{ number_format($order->total_price) }} <span class="small fw-normal">تومان</span> </span>
                    </li>

                </ul>

                <div class="d-flex justify-content-center align-items-center ">
                    <button wire:offline.attr="disabled" wire:loading.attr="disabled" wire:click.debounce.150ms="startPayment" type="button" class="btn btn-primary w-25 mt-4">پرداخت </button>
                    <hr>

                </div>

                <!-- Light alert -->
                <div  wire:loading class="w-100">
                <div class="alert alert-warning d-flex mt-3" role="alert">
                    <i class="fi-clock me-2 me-sm-3 lead"></i>
                    <div> لطفا صبر کنید | درحال انتقال به صفحه پرداخت </div>

                </div>
                </div>

                <div class="alert alert-danger  justify-content-center align-items-center mt-4 fw-bold" wire:offline>  اتصال به اینترنت خود را بررسی کنید </div>

            </div>
        </div>
    </div>
</div>
</section>


<div class="clearfix"></div>
<!-- ============================ map End ================================== -->


@include('livewire.front.home-inc.footer')


@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts/>
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script data-navigate-once
        src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script data-navigate-once src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
<script data-navigate-once
        src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
<script data-navigate-once src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
<!-- Main theme script-->
<script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>

@endsection
</div>
