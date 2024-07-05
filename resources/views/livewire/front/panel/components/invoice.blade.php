<div>

    <!-- Accordion basic -->
    <div class="accordion mt-3" id="accordionExample">

        <!-- Accordion item -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">اطلاعات سفارش</button>
            </h2>
            <div class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" id="collapseOne">
                <div class="accordion-body">

                    <div class="card ">
                        <div class="card-body ">

                            <ul class="list-group border-0">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                                شماره سفارش
                            </span>
                                    <span class="">{{ $order?->order_number }}</span>
                                </li>


                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                               مبلغ سفارش
                            </span>
                                    <span class="">{{ number_format($order->total_price) }}
                            <span class="text-muted fs-xs"> تومان</span>
                            </span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 ">
                            <span>

                             تاریخ
                            </span>
                                    <span class="">{{ jdate($order->created_at)->toFormattedDateString() }}

                            </span>
                                </li>

                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

    <div class="accordion mt-3" id="accordionExample1">

        <!-- Accordion item -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">جزئیات سفارش</button>
            </h2>
            <div class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample1" id="collapseOne">
                <div class="accordion-body">

                    <div class="card ">
                        <div class="card-header text-center text-primary">
                            <span class="fw-bold">جزئیات سفارش</span>
                        </div>
                        <div class="card-body ">

                            <ul class="list-group border-0">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                               تعداد
                            </span>
                                    <span class="">{{$orderCount}} محصول</span>
                                </li>


                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                              ساعت ثبت
                            </span>
                                    <span class="">9:25
                            <span class="text-muted fs-xs"> تومان</span>
                            </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 ">
                            <span>

                             زمان تحویل
                            </span>

                                    <span class="fs-xs">  1 خرداد تا 5 فروردین</span>

                                </li>


                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>






    <div class="row mt-4">
        <div class="col-sm-6">
            <div class="card shadow-lg">
                <div class="card-header text-center text-primary">
                    <span class="fw-bold">اطلاعات سفارش</span>
                </div>
                <div class="card-body border-2">

                    <ul class="list-group border-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                                شماره سفارش
                            </span>
                            <span class="">{{ $order?->order_number }}</span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                               مبلغ سفارش
                            </span>
                            <span class="">{{ number_format($order->total_price) }}
                            <span class="text-muted fs-xs"> تومان</span>
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 ">
                            <span>

                             تاریخ
                            </span>
                            <span class="">{{ jdate($order->created_at)->toFormattedDateString() }}

                            </span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>


        <div class="col-sm-6">
            <div class="card shadow-lg">
                <div class="card-header text-center text-primary">
                    <span class="fw-bold">جزئیات سفارش</span>
                </div>
                <div class="card-body border-2">

                    <ul class="list-group border-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                               تعداد
                            </span>
                            <span class="">{{$orderCount}} محصول</span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                              ساعت ثبت
                            </span>
                            <span class="">9:25
                            <span class="text-muted fs-xs"> تومان</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 ">
                            <span>

                             زمان تحویل
                            </span>

                            <span class="fs-xs">  1 خرداد تا 5 فروردین</span>

                        </li>


                    </ul>
                </div>
            </div>
        </div>

    </div>


    <div class="card shadow-lg mt-3">
        <div class="card-header text-center text-primary">
            <span class="fw-bold">اطلاعات ارسال</span>
        </div>
        <div class="card-body border-2">

            <ul class="list-group border-0">
                <li class="row list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span class="col">


                                آدرس پستی :
                            </span>
                    <div class="container mt-2"><p class="col d-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, dicta fuga fugiat fugit illo impedit itaque, magni minus molestiae molestias natus obcaecati perferendis quibusdam, quisquam similique sit tempore vero voluptate!</p></div>

                </li>


                <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                               مبلغ سفارش
                            </span>
                    <span class="">111111111111
                            <span class="text-muted fs-xs"> تومان</span>
                            </span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center border-0 ">
                            <span>

                             تاریخ
                            </span>
                    <span class="">{{ jdate($order->created_at)->toFormattedDateString() }}

                            </span>
                </li>

            </ul>
        </div>
    </div>
    </div>
