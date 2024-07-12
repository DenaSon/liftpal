@extends('front.layouts.master')


@section('title',getSetting('website_title'). '-'.'جزئیات سفارش')

@section('customCss')
    <link rel="stylesheet" href="{{ asset('front/assets/css/invoice.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/invoice-customize.css') }}">


@endsection



@section('content')



    <section class="inner-section checkout-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <br/>
                    <div class="alert-info">
                       @if( request()->query('type') == 'invoice' )
                            <span class="fas fa-check"></span>
                           متشکریم! ما سفارش شما را دریافت کردیم.

                        @else
                           جزئیات سفارش
                        @endif

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="account-card">
                        <div class="account-title">
                            <h4>اطلاعات سفارش</h4>
                        </div>
                        <div class="account-content">
                            <div class="invoice-recieved">
                                <h6>شماره سفارش <span>{{ $order->id }}</span></h6>
                                <h6>تاریخ سفارش <span>{{ jdate($order->updated_at)->format('d F Y') }}</span></h6>
                                <h6>مبلغ کل <span>{{ number_format($order->grand_total) }}  تومان </span></h6>
                                <h6>                                  شماره پیگیری

                                    <span>
                                       {{ $order->payment_transaction_id }}
                                    </span>

                                </h6>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="account-card">
                        <div class="account-title">
                            <h4>جزئیات سفارش</h4>
                        </div>
                        <div class="account-content">
                            <ul class="invoice-details">
                                <li>
                                    <h6>تعداد کل</h6>
                                    <p>{{ $order->history->sum('quantity') }}  محصول </p>
                                </li>
                                <li>
                                    <h6>زمان سفارش</h6>
                                    <p>{{ jdate($order->updated_at)->format('d F Y - H:m') }}</p>
                                </li>
                                <li>
                                    <h6>زمان تقریبی تحویل</h6>
                                    @if( jdate($order->updated_at )->isEndOfWeek())
                                    <p> {{ jdate($order->updated_at ) ->addDays(4)->format('d F') }} تا  {{ jdate($order->updated_at ) ->addDays(6)->format('d F')}}   </p>
                                        @else
                                        <p> {{ jdate($order->updated_at ) ->addDays(3)->format('d F') }} تا  {{ jdate($order->updated_at ) ->addDays(5)->format('d F')}}   </p>
                                    @endif

                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="account-card">
                        <div class="account-title">
                            <h4>جزئیات پرداخت</h4>
                        </div>
                        <div class="account-content">
                            <ul class="invoice-details">


                                <li>
                                    <h6>مالیات<small></small></h6>
                                    <p> {{ round($order->tax)  }}  <span class="price-unit"> درصد </span> </p>
                                </li>


                                <li>
                                    <h6>هزینه ارسال</h6>
                                    <p> @if($order->shipping_cost > 0 ) {{ number_format($order->shipping_cost) }} @else رایگان @endif </p>
                                </li>

                                <li>
                                    <h6>تخفیف</h6>
                                    <p> {{ number_format(round($order->discount_amount)) }} </p>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>

                <br/>
                <div class="account-card">
                    <div class="account-title">
                        <h6> آدرس دریافت مرسوله </h6>
                    </div>
                    <div class="account-content">

                    <span>
                        {{ $order->shipping_address }}
                    </span>
                    </div>
                </div>




            </div>

            <div class="table-scroll">
                <table class="table-list">
                    <thead>
                    <tr>

                        <th scope="col">محصول</th>
                        <th scope="col">قیمت واحد</th>
                        <th scope="col">تعداد</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->history as $orderItem)
                    <tr>

                        <td class="product-td-name">
                            <a dir="rtl" href="{{ route('indexBySearch',['q'=>$orderItem->product_name]) }}">
                                <b> {{ $orderItem->product_name }} </b>

                               ({{ $orderItem->type_name }})

                            </a>
                        </td>
                        <td class="table-vendor"><a href="#">{{ number_format($orderItem->price) }}</a></td>
                        <td class="table-vendor"><a href="#">{{ $orderItem->quantity }}</a></td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


            </div>

    </section>




    @include('front.layouts.intro')

@endsection


@section('customJs')






    @include('front.layouts.inc._validationErrors')

@endsection

