<!-- Info Alert Modal -->
<div id="info-alert-modal-{{$batch->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-body pt-2 pb-1">
<div class="text-center">
    <i class="dripicons-information h1 text-info"></i>
    <h4 class="mt-2 font-15"> دسته شماره {{ $index+1 }} </h4>

</div>

    <ul class="list-group co">




        <li class="list-group-item">
            <strong class="fw-bold me-1 ">  ارزش دسته
                <span class="font-11">  (خرید) </span>
                :</strong>
            <span  class="font-12">{{ number_format($batch->cost_price * $batch->quantity) }}</span>
        </li>

        <li class="list-group-item">
            <strong class="fw-bold me-1 ">  ارزش دسته
                <span class="font-11"> (فروش)  </span>
                :</strong>
            <span  class="font-12">{{ number_format($batch->sale_price * $batch->quantity) }}</span>
        </li>

        <li class="list-group-item">
            <strong class="fw-bold me-1 ">  سود
                <span class="font-11"> ناخالص کلی  </span>
                :</strong>
            <span  class="font-12">{{ number_format(  ($batch->sale_price * $batch->quantity) - ($batch->cost_price * $batch->quantity)  ) }}</span>
        </li>
        <span class="mt-2"> </span>
        <li class="list-group-item">
            <strong class="fw-bold me-1 ">فروش
                <span class="font-11">  کلی تاکنون  </span>
                :</strong>
            <span  class="font-12">{{ number_format(  round(($batch->sale_price * $batch->sales_number) )  ) }}</span>
        </li>



        <li class="list-group-item">
            <strong class="fw-bold me-1 ">سود
                <span class="font-11">  از فروش  </span>
                :</strong>
            <span  class="font-12">{{ number_format(  round(($batch->sale_price * $batch->sales_number) - ($batch->cost_price * $batch->quantity)  )  ) }} &nbsp;
          ({{ $batch->sales_number }} فروش) </span>
        </li>







        <li class="list-group-item" title= "">
            <strong class="fw-bold me-1 ">
                <span class="font-11">بازگشت سرمایه تاکنون</span>
                :</strong>
            <span  class="font-12 @if(round($returned_profit[$index],1) < 0) badge badge-outline-danger @else badge badge-outline-success @endif ">
                {{ round($returned_profit[$index],1) }} %

            </span>
            @if(\Carbon\Carbon::parse($batch->entry_date)->diffInDays(now())  < 60)
                <span class="font-12">  در {{  \Carbon\Carbon::parse($batch->entry_date)->diffInDays(now()) }} روز </span>
            @else
                <span class="font-12">  در {{ \Carbon\Carbon::parse($batch->entry_date)->diffInMonths(now()) }} ماه </span>
            @endif

        </li>



    </ul>

  <div class="text-center"> <button type="button" class="btn btn-info my-2 btn-xs" data-bs-dismiss="modal">بستن</button></div>

</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
