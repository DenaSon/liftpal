<div>
    @section('css')

        <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">

    @endsection

    @include('livewire.front.home-inc.header')


    <div class="container mt-5 mb-md-4 pt-5">
        <nav class="mb-3 pt-md-3" aria-label="breadcrumb">

        </nav>
    </div>

    <section class="container mb-5 pb-2 pb-md-4 pb-lg-5">
        <div class="row align-items-md-start justify-content-center align-items-center gy-4">


            <div class="col-lg-4 col-md-6 ">
                <div class="mx-md-0 mx-auto mb-md-5 mb-4 pb-md-3 text-md-start text-center" style="max-width: 416px;">


                </div>

                <img class="d-block mx-auto rotate-img" src="{{ asset($success ? 'assets/img/real-estate/payment/payment-confirm.png' : 'assets/img/real-estate/illustrations/failed-pay.png') }}" alt="Illustration" height="200">

            </div>


            <div class="col-md-6 offset-lg-1">
                <div class="card border-0 bg-white p-sm-3 p-2">
                    <div class="card-body m-1">


                        <!-- Basic table -->
                        @if($success)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>

                                    <th>وضعیت</th>
                                    <th>مبلغ</th>
                                    <th>شماره سفارش</th>


                                </tr>
                                </thead>
                                <tbody>


                                <tr class="">
                                    <td class="">پرداخت شده</td>
                                    <td class="fw-bold">{{ number_format($transaction->amount) }}</td>
                                    <td>{{ $order->order_number ?? 0 }}</td>

                                </tr>

                                </tbody>
                            </table>
                        </div>

                            <div class="table-responsive mt-3">
                                <table class="table">
                                    <thead>
                                    <tr>

                                        <th>شماره تراکنش</th>
                                        <th>کارت پرداخت</th>
                                        <th> درگاه پرداخت </th>


                                    </tr>
                                    </thead>
                                    <tbody>


                                    <tr class="">

                                        <td>{{ $transaction->reference_id ?? 0 }}</td>
                                        <td>{{ $transaction->card_pen ?? 0 }}</td>

                                        @if($transaction->payment_method == 'ZARINPAL')
                                            <td>Zarinpal</td>
                                        @endif




                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        @else



                            <div >
                                <ul class=" list-group container m-auto pt-4 mt-5 d-flex ">
                                    <li class="list-group-item text-center bg-secondary shadow">وضعیت</li>
                                    <li class="list-group-item text-center shadow"> {{ $errorMessage }} </li>
                                </ul>
                            </div>




                        @endif



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
