<div class="col-lg-9">
    <div class="account-card">

                <section class="inner-section orderlist-part">

                                <div class="orderlist-filter">
                                    <h5> کل سفارش‌ها <span>- ({{ auth()->user()->orders->where('payment_status','paid')->count() }})</span></h5>
                                    <div class="filter-short">

                                        <select class="form-select">
                                            <option value="all" selected="">همه سفارشات</option>
                                            <option value="recieved">سفارشات دریافت شده</option>
                                            <option value="processed">سفارشات پردازش شده</option>
                                            <option value="shipped">سفارش ارسال شده</option>
                                            <option value="delivered">سفارش تحویل داده شده</option>
                                        </select>
                                    </div>
                                </div>


                        <div class="row">


                            @foreach($orders as $order)
                            <div class="col-lg-12">
                                <div class="orderlist">
                                    <div class="orderlist-head">
                                        <h6 style="font-size: 13px">سفارش {{ $order->id }}   </h6>
                                        @if($order->status == 'processing')
                                            <span class="badge bg-warning text-dark">درحال پردازش</span>



                                        </span>
                                        @endif
                                        @if($order->status == 'send')
                                        <span class="badge badge-info text-info">
                                            ارسال شده

                                        </span>
                                        @endif
                                        @if($order->status == 'delivered')
                                            <span class="badge badge-info text-success">
                                          تحویل شده

                                        </span>
                                        @endif
                                            <a  href="{{ route('invoice',['order'=>$order->id]) }}" class="btn btn-outline btn-sm"> مشاهده  </a>

                                    </div>

                                </div>







                            </div>
                            @endforeach


                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="pagination">

                                    {{ $orders->links() }}

                                </ul>
                            </div>
                        </div>

                </section>









    </div>
</div>