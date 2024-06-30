<div>

    <div class="container mx-auto text-center row border d-flex rounded-bottom p-3  mt-5 mb-2 ps-2 justify-content-center align-items-center" style="border:1px solid rgba(251,86,49,0.42)
    !important;">

        <div class="col flex-col justify-content-between "><span class=" mb-5 ">&nbsp;&nbsp;سفارش</span><img class="mt-2" src="{{ asset('assets/img/client-panel/status-delivered.svg') }}" alt=""></div>
        <div class="col"><span class="me-2">سفارش جاری</span ><img class="mt-2" src="{{ asset('assets/img/client-panel/status-processing.svg') }}" alt=""></div>
        <div class="col"><span> سفارش مرجوعی</span><img class="mt-2" src="{{ asset('assets/img/client-panel/status-returned.svg') }}" alt=""></div>


    </div>


    <div class="table-responsive">
        <table class="container table mt-4 table-hover">
        <thead class="fw-bold" style="border-bottom: 2px solid #807878">
        <tr>
            <th colspan="3">شماره سفارش</th>
            <th colspan="1" class="text-center">وضعیت</th>
            <th colspan="1" class="text-center">مبلغ
                <span class="fs-xs muted fw-normal">(تومان)</span>
            <th colspan="1" class="text-center">زمان</th>
            </th>
        </tr>
        </thead>
        <tbody class="table-group-divider fw-bold bold-divider">
        @foreach($orders as $order)


        <tr>
            <td colspan="3">{{ $order->order_number }}</td>
            <td colspan="1" class="text-center">
                @switch($order->status)
                    @case('received')
                        <span class="badge text-bg-secondary text-black">بررسی</span>
                        @break
                    @case('process')
                        <span class="badge text-bg-warning text-white">پردازش</span>
                        @break
                    @case('shipped')
                        <span class="badge text-bg-info text-white">ارسال شده</span>
                        @break
                    @case('delivered')
                        <span class="badge text-bg-success text-white">دریافت شده</span>
                        @break

                @endswitch


            </td>
            <td colspan="1" class="text-center">{{ number_format($order->total_price ) }}</td>

            <td colspan="1" class="text-center fw-normal fs-xs">{{ jdate($order->created_at)->format('d M Y')  }}</td>
        </tr>

        @endforeach
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>



</div>
