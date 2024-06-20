@extends('admin.panel.layouts.master')
@section('page-title','  مدیریت  سفارشات')
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-lg-8">
                        <form class="d-flex flex-wrap align-items-center" action="{{ route('orders.index') }}" method="get">

                            <label for="inputPassword2" class="visually-hidden">جستجو شماره سفارش</label>
                            <div class="me-3">
                                <input title="جستجو با شماره سفارش ، شماره همراه،نام خانوادگی" name="search" type="search" class="form-control my-1 my-lg-0" id="inputPassword2" placeholder="جستجو">
                            </div>

                        </form>




                    </div>

                    <div class="col-lg-4">
                        <div class="text-lg-end">
                            @if(request()->has('search'))
                            <a href="{{ route('orders.index') }}" class="btn btn-info waves-effect waves-light mb-2 me-2"><i class="mdi mdi-view-list-outline me-1"></i>   مشاهده همه </a>
                            @else
                                <a href="#" class="btn btn-success waves-effect waves-light mb-2 me-2"><i class="mdi mdi-basket me-1"></i>   ایجاد سفارش   </a>
                            @endif
                        </div>
                    </div><!-- end col-->


                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                        <tr>

                            <th>شماره </th>
                            <th> مشتری </th>
                            <th>تعداد</th>
                            <th>تاریخ</th>
                            <th>وضعیت پرداخت</th>
                            <th>جمع</th>

                            <th>وضعیت سفارش</th>
                            <th style="width: 125px;">اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $index => $order)
                        <tr id="row-{{ $order->id }}" class="@if($order->payment_status == 'paid') border-success @endif">

                                <td><a href="{{ route('orders.show',$order->order_number) }}" class="text-body fw-bold"> {{ $order->order_number }} </a> </td>
                                <td><a href="{{ route('customers.index',['filter'=>'phone','search'=>$order->user->phone]) }}" class="text-body fw-bold">
                                    {{ $order->profile->name ?? '' }}  {{ $order->profile->last_name ?? '' }}
                                        <br>
                                        <span class="text-muted font-12"> {{ $order->user->phone ?? $order->user->id ?? '' }} </span>
                                    </a> </td>
                                <td>
                                    {{ $order->history->count() ?? null}}
                                </td>
                                <td>
                                {{ jdate($order->created_at)->toDateTimeString() }}       <small class="text-muted">(  {{ jdate($order->created_at)->ago() }} )</small>
                                </td>
                                <td>
                                    <h5>
                                          @if($order->payment_status == 'paid')
                                                <span class="badge badge-soft-success"> پرداخت شده </span>
                                            @elseif($order->payment_status == 'pending')
                                                <span class="badge badge-warning"> در حال پرداخت </span>
                                            @elseif($order->payment_status == 'canceled')
                                                <span class="badge badge-soft-warning">  لغو شده  </span>
                                            @endif
                                       </h5>
                                </td>
                                <td>
                                  {{ number_format($order->grand_total) }}
                                </td>
                                <td>
                                    <h5>
                                        @if($order->status == 'processing')
                                            <span class="badge badge-outline-danger"> در حال پردازاش </span>
                                            @elseif($order->status == 'packaged')
                                                <span class="badge badge-outline-warning"> آماده ارسال </span>
                                        @elseif($order->status == 'send')
                                            <span class="badge badge-outline-info"> ارسال شده  </span>

                                        @elseif($order->status == 'delivered')
                                            <span class="badge badge-outline-success">  تحویل شده  </span>
                                        @elseif($order->status == 'returned')
                                            <span class="badge badge-outline-secondary">   مرجوع شده  </span>

                                        @endif

                                    </h5>
                                </td>

                                <td>


                                    <form action="{{ route('orders.destroy', $order->id) }}" class="inline-form delete-form"
                                          data-id="{{ $order->id }}">
                                        @csrf
                                        @method('Delete')

                                        <a href="{{ route('orders.show',['order'=> $order->order_number]) }}"
                                                class="btn btn-xs btn-outline-info  m-1">
                                            <i class="mdi mdi-eye-plus-outline"></i>
                                        </a>
                                        <button title="حذف" id="delete-btn-{{$order->id}}" type="button"
                                                class="btn btn-xs btn-outline-danger delete-btn m-1">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>

                                        <a href="javascript:void(0);" class="btn btn-outline-secondary btn-xs"> <i class="mdi mdi-square-edit-outline"></i></a>

                                    </form>
                                </td>

                        </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>

                <ul class="pagination pagination-rounded justify-content-end my-2">

                    {{ $orders->links() }}

                </ul>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>









<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

@endsection

@section('CustomJs')


<script src="{{ asset('admin/assets/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>

<!-- Init js -->
<script src="{{ asset('admin/assets/js/pages/responsive-table.init.js') }}"></script>


@include('admin.store.orders.inc._indexScripts')

@endsection










