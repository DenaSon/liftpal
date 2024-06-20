<div class="tab-pane active" id="batch">
    <div class="row align-content-center">


        <div class="col-xl-12">
            <div class="card shadow-lg">

                <div class="card-body">


                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>دسته ها</th>
                                <th>اقلام باقیمانده</th>
                                <th>مجموع فروش</th>
                                <th>سرمایه اولیه</th>
                                <th>ارزش فروش</th>
                                <th> مقدار فروش </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{ $batches->count()  }} دسته </th>
                                <td>{{ $product->batches->sum('quantity') - $product->batches->sum('sales_number')  ?? 0 }}</td>
                                <td>{{ $product->batches->sum('sales_number')  }}</td>
                                <td>{{ number_format($totalCostValue)  }}</td>
                                <td>{{ number_format($totalSaleValue) }}</td>
                                <td title=" میانگین بازگشت سرمایه {{ round($total / $batches->count()) }}%">{{ number_format($totalSalesValue) }}</td>

                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

            </div> <!-- end card-->
        </div>




        @foreach( $batches->sortBy('expire_date') as $index => $batch )
            <div class="col-lg-5 col-md-6 col-sm-12 col-12 shadow-lg mx-auto mb-2 batch-{{$batch->id}} ">

                <div class="card bg-pattern">
                    <span class="text-center font-14 mt-1 badge  badge-outline-blue"> دسته شماره {{ $index +1 }}

                    </span>
                    <div class="card-body">








                        <ul class="list-group co shadow-lg">
                       <span class="badge badge-soft-danger"> گزینه : {{ $batch->type->name ?? '* مشخص نشده *' }} </span>
                            <li class="list-group-item">
                                <strong class="fw-bold me-2 "> موجودی  :</strong>


                                @if($batch->sales_number >= $batch->quantity)
                                    <span class="badge badge-soft-danger"> اتمام موجودی </span>
                                    <span class="font-13"> (  {{ $batch->sales_number ?? 0 }} فروش)</span>
                                @else
                                    <span class="">{{ $batch->quantity - $batch->sales_number . ' ' . $batch->product->unit }}    باقیمانده از {{ $batch->quantity .' '. $batch->unit }} اولیه </span>
                                    <span class="font-13"> (  {{ $batch->sales_number ?? 0 }} فروش)</span>
                                @endif

                            </li>


                            <li class="list-group-item">
                                <strong class="fw-bold me-2 "> قیمت خرید :</strong>
                                <span class="">{{ number_format($batch->cost_price) }}</span> تومان
                            </li>

                            <li class="list-group-item">
                                <strong class="fw-bold me-2 "> قیمت فروش :</strong>
                                <span class="">{{ number_format($batch->sale_price) }}</span> تومان
                            </li>


                            <li class="list-group-item ">
                                <strong class="fw-bold me-2 "> انقضاء :</strong>

                                {{ jdate($batch->expire_date)->toDateString() }}
                                &nbsp;
                                @if(\Carbon\Carbon::now()->diffInDays($batch->expire_date) < 30)
                                    <span class="badge badge-outline-warning">{{ \Carbon\Carbon::now()->diffInDays($batch->expire_date)  }} روز  </span>

                                @elseif(\Carbon\Carbon::now()->diffInDays($batch->expire_date) > 365  )
                                    <span class="badge badge-outline-success">{{ \Carbon\Carbon::now()->diffInYears($batch->expire_date)  }}  سال  </span>
                                @elseif(jdate($batch->expire_date)->isPast() )
                                    <span class="badge badge-soft-danger"> منقضی </span>
                                @else

                                    <span class="badge badge-outline-info">{{ \Carbon\Carbon::now()->diffInMonths($batch->expire_date)  }}  ماه  </span>
                                @endif
                            </li>

                            <li class="list-group-item">
                                <strong class="fw-bold me-2 ">  تاریخ ورود:</strong>
                                <span class="font-13">{{ jdate($batch->entry_date)->toFormattedDateTimeString() }}</span> &nbsp;
                                <span class="font-13">({{ jdate($batch->entry_date)->ago() }})</span>
                            </li>



                            <li class="list-group-item">
                                <strong class="fw-bold me-2 "> آخرین برداشت :</strong>
                                <span class="font-13">{{ jdate($batch->exit_date)->toFormattedDateTimeString() }}</span>&nbsp;
                                <span class="font-13">({{ jdate($batch->exit_date)->ago() }})</span>
                            </li>

                            <li class="list-group-item">
                                <strong class="fw-bold me-2 "> کد موقعیت :</strong>
                                <u class="font-16">{{ $batch->location_code  }}</u>
                                (<span
                                    class="font-11"> {{ $batch->location . '-' . $batch->section .'-'. $batch->shelf  }} </span>
                                )
                            </li>

                        </ul>

                        <div class="align-content-center d-flex">
                            <div class="mx-auto mt-2">

                                <button type="button" class="btn btn-outline-primary btn-xs" data-bs-toggle="modal"
                                        data-bs-target="#info-alert-modal-{{ $batch->id }}">   اطلاعات
                                </button>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-primary btn-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$batch->id}}">
                                    اقدامات
                                </button>

                                @include('admin.inventory.batch.inc._actions')




                                <button  type="button" class="btn btn-outline-danger btn-xs btn-removBatch" id="delete-batch-button" data-batch-id="{{$batch->id}}">حذف</button>






                            </div>


                        </div>







                    </div>
                </div>



            </div>
            @include('admin.inventory.batch.inc._show')
        @endforeach


    </div> <!-- end col -->




</div> <!-- end row -->

