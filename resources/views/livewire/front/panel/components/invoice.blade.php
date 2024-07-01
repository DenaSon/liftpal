<div>
    <div class="row">
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
                            <span class="">{{ jdate($order->created_at)->toDateString() }}

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
                            <span class="">10 محصول</span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                              ساعت ثبت
                            </span>
                            <span class="">9:25
                            <span class="text-muted fs-xs"> تومان</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
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
