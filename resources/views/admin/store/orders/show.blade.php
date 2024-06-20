@extends('admin.panel.layouts.master')
@section('page-title','سفارش : ' . $order->order_number)
@section('CustomCss')

<link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>
<script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
<link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />

@include('admin.store.products.inc._errors')
@endsection
@section('content')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="row">

<div class="@if($order->transactions->count() > 0) col-lg-9 @else col-lg-12 @endif">
<div class="card">
<div class="card-body">

<h4 class="header-title mb-3 text-start">  سفارش {{ $order->order_number }} ثبت شده در
<span class="ms-1"> {{ jdate($order->created_at)->toDateString() }} </span> ساعت
<span class="ms-1"> {{ jdate($order->created_at)->toTimeString() }} </span>
</h4>


<div class="table-responsive">
<table class="table table-bordered table-centered mb-0 table-hover" style="overflow:hidden">
<thead class="table-light">
<tr>
<th> نام کالا </th>
<th>تعداد</th>
<th>قیمت واحد</th>
<th>مبلغ کل</th>

</tr>
</thead>
<tbody>
@foreach($order->history as $index => $detail)

<tr>
<th scope="row">

    <a class="text-dark" target="_blank" href="{{ route('products.index',['name' => $detail->product_name]) }}"> {{$detail->product_name}} {{ $detail->type_name  }}

     <span class="font-13"></span>
    </a>


      @if($order->payment_status == 'paid')
        <a target="_blank" href="" class=" btn-xs btn-outline-secondary ms-2">
        <span class="mdi mdi-stocking"></span>
        </a>
      @endif



</th>
<td> {{ $detail->quantity }} </td>
<td>
<span class="text-end">    {{ number_format( $detail->price)  }} </span>
</td>

<td>{{ number_format($detail->price * $detail->quantity)  }}</td>


</tr>
@endforeach




<tr class="border-dark border-1 bg-soft-blue">
<th scope="row" colspan="1" class="text-start font-12">

<span class="font-14">   هزینه ارسال  {{ number_format( $order->shipping_cost ) }} </span> تومان
</th>
<th scope="row" colspan="1" class="text-start">
    <span class="font-14">   مالیات  {{ number_format( $order->tax ) }} % </span>

</th>
    <th scope="row" colspan="1" class="text-start">
        <span class="font-14">   تخفیف  {{ number_format( $order->discount_amount ) }}  </span> تومان

    </th>


<th scope="row" colspan="1" class="text-center ">
   {{ number_format($totalPrice) }}
</th>

</tr>



<tr class="border-dark border-2">
    <th scope="row" colspan="3" class="text-start font-12">
        <span class="font-12">
        مبلغ پرداخت شده  :  {{ $word_price }}

        </span>

    </th>

    <th scope="row" colspan="1" class="text-center font-15">
        {{ number_format($grand_total) }} <span class="font-11">تومان</span>

    </th>



</tr>





</tbody>
</table>

</div>




</div>
</div>
</div>

@if($order->transactions->count() > 0)

<div class="col-lg-3">
<div class="card">
<div class="card-body" @if($order->transactions->count() > 4) style="overflow-y: scroll;height:330px" @endif>

<div class="track-order-list">
<ul class="list-unstyled">
    @foreach($order->transactions as $transaction)
        <li class="@if($transaction->status == 'paid') completed @endif">
            @if($transaction->status == 'paid') <span class="dot active-dot"></span> @endif
            @if($transaction->status == 'paid')
                <h5 class="mt-0 mb-1 text-success">  تراکنش موفق </h5>
            @else
                <h5 class="mt-0 mb-1 text-secondary">  تراکنش ناموفق </h5>
            @endif

            <p class="text-muted"> {{ jdate($transaction->created_at)->toDateTimeString() }} (<small class="text-muted">{{ jdate($transaction->created_at)->ago() }}</small>) </p>
        </li>
    @endforeach
</ul>
<div class="text-center mt-4">
    <a href="#" class="btn btn-primary btn-xs">نمایش جزئیات</a>
</div>
</div>

</div>
</div>
</div>


@endif


</div>




<div class="row">
<div class="col-lg-4">
<div class="card">
<div class="card-body border-1 border-warning">
<h4 class="header-title mb-3">اطلاعات حمل و نقل</h4>


    <p class="mb-2"><span class="fw-semibold me-2">  شماره کاربری:</span>
       <a target="_blank" href="{{ route('customers.index',['filter'=>'phone','search' => $order->user->phone]) }}"> {{ $order->user->phone ?? '' }} </a>
    </p>
    <p class="mb-2"><span class="fw-semibold me-2">  نام کاربری :</span>
        {{ $order->profile->name ?? '' }}  {{ $order->profile->last_name ?? '' }}
    </p>
    <hr class="">

    <p class="mb-2"><span class="fw-semibold me-2"> آدرس کامل: </span>
        {{ $order->shipping_address }}
    </p>


</div>
</div>
</div> <!-- end col -->

<div class="col-lg-4">
<div class="card @if($order->payment_status == 'paid') border-success border-1 bg-pattern @else border-pink border-1 @endif">
<div class="card-body">
<h4 class="header-title mb-3">
اطلاعات صورت حساب
@if($order->payment_status == 'paid')  <span class="badge badge-soft-success font-13 ms-2"> پرداخت شده </span>
@else
<span class="badge badge-soft-danger font-13 ms-2"> پرداخت نشده </span>
@endif
</h4>
<ul class="list-unstyled mb-0">
<li>

<p class="mb-2"><span class="fw-semibold me-2">  مبلغ واریزی  :</span> <span class=""><!--reference_id  --> {{  number_format($order->transactions->where('status','paid')->first()->amount ?? 0) }} تومان </span> </p>
<p class="mb-2"><span class="fw-semibold me-2"> کارت واریزی :</span> <span dir="ltr" class="font-15"> {{ $order->transactions->where('status','paid')->first()->card_pen ?? '' }}</span> </p>
<p class="mb-2"><span class="fw-semibold me-2">کد پیگیری بانک :</span> <span class=""><!--reference_id  --> {{  $order->payment_transaction_id ?? '' }} </span> </p>
<p class="mb-2"><span class="fw-semibold me-2">درگاه پرداخت:</span>   <span class="badge badge-outline-warning font-13">{{ \Illuminate\Support\Str::upper($order->payment_method) ?? '' }}</span> </p>


</li>
</ul>

</div>
</div>
</div> <!-- end col -->


<div class="col-lg-4">
<div class="card">
<div class="card-body">
<h4 class="header-title mb-3">اطلاعات تحویل</h4>

<div class="text-center">
<i class="mdi mdi-truck-fast h2 text-muted"></i>
<h5><b>
ارسال      @if($order->shipping_method == 'post') پست @endif
</b></h5>
<p class="mb-1"><span class="fw-semibold"> هزینه ارسال :</span> {{ $order->shipping_cost }} </p>
<p class="mb-0"><span class="fw-semibold">  کد پیگیری :</span> -- </p>
</div>
</div>
</div>
</div> <!-- end col -->

</div>






<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

@endsection

@section('CustomJs')


<script src="{{ asset('admin/assets/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>






@endsection










