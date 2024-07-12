<div>


    <div class="accordion mt-5 shadow-lg rounded-3" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    اطلاعات سفارش
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
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

                    </ul>                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    جزئیات سفارش
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
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


                    </ul>                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    اطلاعات ارسال
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card-body  ">

                        <ul class="list-group border-0">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                             گیرنده
                            </span>
                                <span class="">میلاد اسدپور

                            </span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                             شماره تماس
                            </span>
                                <span class="">123456789

                            </span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span>

                             کد پیگیری پستی
                            </span>
                                <span class="">123456789

                            </span>
                            </li>


                            <li class="row list-group-item d-flex justify-content-between align-items-center  border-0   ">
                            <span class="col">


                                آدرس پستی :
                            </span><br>
                                <div class=" container mt-2"><p class="col d-block">سیسخت...خیابان مطهری..بلوار شهدا...کوهپایه 3</p></div>

                            </li>



                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingfour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapseThree">
                    مشخصات محصول
                </button>
            </h2>
            <div id="collapsefour" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="table-responsive">
                        <table class="table">

                            <tbody>
                            <tr>

                                <td colspan="2"><span>نام محصول</span><br><br><span>موتور دوگانه سوز ممد باگی</span></td>
                                <td><img src="{{ asset('assets/img/footer/elevator.png') }}" width="50" height="50" alt=""> </td>
                            </tr>
                            <tr>

                                <td colspan="2">نوع</td>
                                <td>موتور گیبوکس</td>

                            </tr>
                            <tr>

                                <td colspan="2">تعداد</td>
                                <td><span>2</span>&nbspعدد</td>

                            </tr>
                            <tr>

                                <td colspan="2">قیمت</td>
                                <td><span>2000</span>&nbspتومان</td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
