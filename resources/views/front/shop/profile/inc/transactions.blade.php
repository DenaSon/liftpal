<div class="col-lg-9">
    <div class="account-card">



        <section class="inner-section">

            @if($transactions->count() ==0)
                <h2> تراکنشی ثبت نشده است </h2>
            @else

        <h3> لیست تراکنش ها </h3>
            <br>

            <div class="table-responsive">
                <table class="table table-hover">

                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">وضعیت</th>
                        <th scope="col">کد پیگیری</th>
                        <th scope="col">شماره سفارش</th>
                        <th scope="col">زمان</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $index => $transaction)
                    <tr>
                        <th>{{ $index+1}}</th>
                        <td>
                                @if($transaction->status == 'paid') <span class="badge text-success"> پرداخت شده </span> @endif
                                @if($transaction->status == 'pending') <span class="badge text-warning">  در انتظار </span> @endif
                                @if($transaction->status == 'canceled') <span class="badge text-danger">  لغو شده </span> @endif
                        </td>
                        <td>@if($transaction->reference_id != null) {{$transaction->reference_id}}@else - @endif</td>
                        <td>@if($transaction->reference_id != null)
                             <a target="_blank" href="{{ route('invoice',['order'=> $transaction->order_id]) }}"> <u> {{ $transaction->order_id }}</u> </a>
                            @else - @endif</td>

                        <td style="direction: rtl" title=" {{jdate($transaction->created_at)->format('H:i:s')}}">
                            <span class="badge text-muted"> {{ jdate($transaction->created_at)->toFormattedDateString() }}  </span></td>
                    </tr>
                    @endforeach
                    </tbody>


                </table>
            </div>
            @endif



            <div class="row">


            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="pagination">

                        {{ $transactions->links() }}

                    </ul>
                </div>
            </div>

        </section>










    </div>
</div>