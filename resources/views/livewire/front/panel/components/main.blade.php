<div>


    @can('manager')
        <div class="row mt-2">

            <div class="col-md-6 mb-2">
                <div class="card shadow-sm">
                    <div class="card-body px-0">
                        <div class="row p-0">
                            <div class="col-6 d-flex align-items-center justify-content-center px-0 mx-0">
                                <div class="icon-box text-center ">
                                    <div class="icon-box-media bg-faded-success text-success rounded-circle mx-auto ">
                                        <i class="fi-apartment"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-3">
                                    <p class="mb-3 text-center"> ساختمان</p>
                                    <h6 class="text-dark mt-1 text-center text-waiting"><span>{{ auth()->user()->buildings()->count() }}</span></h6>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-6 mb-2">
                <div class="widget-rounded-circle card">
                    <div class="card-body shadow-sm">
                        <div class="row p-0">
                            <div class="col-6 d-flex align-items-center justify-content-center px-0 mx-0">
                                <div class="icon-box text-center ">
                                    <div class="icon-box-media bg-faded-success text-success rounded-circle mx-auto">
                                        <i class="fi-sidebar-left"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mt-3">
                                    <p class="mb-3 text-center"> آسانسور</p>
                                    <h6 class="text-dark mt-1 text-center text-waiting"><span>{{ auth()->user()->elevators()->count() }}</span></h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6 mb-2">
                <div class="widget-rounded-circle card">
                    <div class="card-body shadow-sm">
                        <div class="row p-0">
                            <div class="col-6 d-flex align-items-center justify-content-center px-0 mx-0">
                                <div class="icon-box text-center">
                                    <div class="icon-box-media bg-faded-success text-success rounded-circle mx-auto">
                                        <i class="fi-friends"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class=" mt-3">
                                    <p class="mb-3 text-center">اعضای ساختمان</p>
                                    <h6 class="text-dark mt-1 text-center text-waiting"><span>{{ auth()->user()->members()->count() }}</span></h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6 mb-2">
                <div class="widget-rounded-circle card">
                    <div class="card-body shadow-sm">
                        <div class="row p-0">
                            <div class="col-6 d-flex align-items-center justify-content-center px-0 mx-0">
                                <div class="icon-box text-center ">
                                    <div class="icon-box-media bg-faded-success text-success rounded-circle mx-auto">
                                        <i class="fi-user"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="text-end mt-3">
                                    <p class=" mb-3 text-center"> درخواست‌ها</p>
                                    <h6 class="text-dark mt-1 text-center text-waiting"><span>{{ auth()->user()->activeRequests()->count() }}</span></h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @endcan



    @if(!$orders->isEmpty())
    <div id="paginated-orders" class="container m-auto text-center row border border-secondary border-5 shadow-sm d-flex rounded p-3 p-auto mt-5 mb-2  justify-content-center align-items-center">


        <div class="col-sm-12 col-md-4 col-flex justify-content-between align-items-center ">
            <button class="btn btn-outline-info px-0 mb-3 w-50" wire:click.debounce.500ms="getSended">
                <i class="fi fi-truck me-2"></i>
                <span>ارسال شده</span>
            </button>
        </div>
        <div class="col-sm-12 col-md-4 col-flex justify-content-between align-items-center">

            <button wire:click.debounce.500ms="getDelivered" class="btn btn-outline-success px-0 mb-3 w-50">
                <i class="fi fi-check-circle p-0"></i>
                 دریافت شده</button>
        </div>
        <div class="col-sm-12 col-md-4 col-flex justify-content-between align-items-center ">
            <button class="btn btn-outline-warning px-0 mb-3 w-50" wire:click.debounce.500ms="getReturn">
                <i class="fi-login  me-2 "></i>
                مرجوعی
            </button>
        </div>



    </div>
    @endif

    <div class="table-responsive">
        <table class="container table mt-4  @if(!$orders->isEmpty()) table-hover  @endif">
            @if($orders->isEmpty())
                <tr>
                    <td class="text-center" colspan="100%">
                        <span class="fw-bold fs-lg mb-5">هنوز سفارشی ثبت نشده است</span>
                        <div class="clearfix"></div>
                        <a wire:navigate class="btn btn-outline-primary btn-lg w-50 mt-5" href="{{ route('shop') }}"><i class="fi-cart me-2"></i> خرید  </a>
                    </td>

                </tr>
            @else
            <thead class="fw-bold" style="border-bottom: 2px solid #807878">
            <tr>
                <th colspan="3">شماره سفارش</th>
                <th colspan="1" class="text-center">وضعیت</th>
                <th colspan="1" class="text-center">مبلغ
                    <span class="fs-xs muted fw-normal">(تومان)</span>
                <th colspan="1" class="text-center">زمان</th>

            </tr>
            </thead>
            <tbody class="table-group-divider fw-bold bold-divider">

            @foreach($orders as $order)

                <tr>

                    <td colspan="3">
                        <a class="text-dark text-decoration-none" wire:navigate href="{{ route('panel', ['page' => 'invoice', 'order' => $order->order_number]) }}">
                            {{ $order->order_number }}
                        </a>

                    </td>
                    <td colspan="1" class="text-center">
                        @switch($order->status)
                            @case('received')
                                <span class="badge text-bg-secondary text-black">بررسی</span>
                                @break
                            @case('process')
                                <span class="badge text-bg-primary text-white">پردازش</span>
                                @break
                            @case('shipped')
                                <span class="badge text-bg-info text-white">ارسال شده</span>
                                @break
                            @case('delivered')
                                <span class="badge text-bg-success text-white">دریافت شده</span>
                                @break
                            @case('return')
                                <span class="badge text-bg-warning text-white"> مرجوعی</span>
                                @break

                        @endswitch


                    </td>
                    <td colspan="1" class="text-center">{{ number_format($order->total_price ) }}</td>

                    <td colspan="1" class="text-center fw-normal fs-xs">{{ jdate($order->created_at)->format('d M Y')  }}</td>

                </tr>

            @endforeach
            <div class="mt-4 text-center">
            <span wire:loading.delay class="text-info fw-bold fs-sm">
            درحال دریافت...
            </span>
            </div>
            </tbody>
                @endif
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">

        {{ $orders->links(data: ['scrollTo' => '#paginated-orders']) }}


    </div>






</div>
