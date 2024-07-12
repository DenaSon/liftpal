<div>
    @section('css')

        <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">

    @endsection

    @include('livewire.front.home-inc.header')


    <div class="container mt-5 mb-md-4 pt-5 mb-5">
        <nav class="mb-3 pt-md-3" aria-label="breadcrumb">

        </nav>
    </div>

    <section class="container mb-5 pb-2 pb-md-4 pb-lg-5">
        <div class="row  justify-content-center align-items-center gy-4">
            <div class="col-lg-4 col-md-6 ">

                <img class="d-flex mx-auto rotate-img pb-2 " src="{{ asset($success ? 'assets/img/real-estate/payment/payment-confirm.png' : 'assets/img/real-estate/illustrations/failed-pay.png') }}" alt="Illustration" height="150">

            </div>


            <div class="col-md-6 offset-lg-1">

                <!-- Basic table -->
                @if($success)

                    <ul class=" list-group">
                        <li class="bg-success border  text-white list-group-item d-flex justify-content-between align-items-center">
                            <span>وضعیت</span>
                            <span class="fw-bold fs-16 small fw-normal">پرداخت شده</span>
                        </li>
                        <li class="list-group-item border  d-flex justify-content-between align-items-center">
                            <span>مبلغ</span>
                            <span class="fw-bold fs-16">{{ number_format($transaction->amount) }}</span>
                        </li>
                        <li class="list-group-item border d-flex justify-content-between align-items-center">
                            <span>شماره سفارش</span>
                            <span class="fw-bold fs-16">{{ $order->order_number ?? 0 }}</span>
                        </li>
                        <li class="list-group-item border d-flex justify-content-between align-items-center">
                            <span>شماره تراکنش</span>
                            <span class="fw-bold fs-16">{{ $transaction->reference_id ?? 0 }}</span>
                        </li>
                        <li class="list-group-item border d-flex justify-content-between align-items-center">
                            <span dir="rtl" class="" style="direction:rtl">کارت پرداخت</span>
                            <span class="fw-bold fs-16">{{ $transaction->card_pen ?? 0 }}</span>
                        </li>

                        @if($transaction->payment_method == 'ZARINPAL')
                            <li class="list-group-item border d-flex justify-content-between align-items-center">
                                <span>درگاه پرداخت</span>
                                <span class="fw-bold fs-16">Zarinpal</span>
                            </li>
                    </ul>
                    <div class="container mt-4 me-md-5 d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-success w-75 mt-2 me-2">پیگیری سفارش</button>
                    </div>

                @endif

            </div>


            @else



                <div>
                    <ul class=" list-group container m-auto pt-4 mt-5 d-flex ">
                        <li class="list-group-item text-center bg-secondary shadow">وضعیت</li>
                        <li class="list-group-item text-center shadow"> {{ $errorMessage }} </li>
                    </ul>

                </div>


        @endif


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
        <script data-navigate-once src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
        <!-- Main theme script-->
        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->

    @endsection
</div>
