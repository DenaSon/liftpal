<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="{{ route('dashboard')}}" class="dropdown-item">تعداد خرید</a>
                        <!-- item-->
                        <a href="{{ route('dashboard',['order' => 'sum']) }}" class="dropdown-item"> مبلغ سفارشات </a>
                        <!-- item-->


                    </div>
                </div>

                <h4 class="header-title mb-3">5 کاربر برتر</h4>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                        <thead class="table-light">
                        <tr>
                            <th>پروفایل</th>
                            <th>مشتری</th>
                            <th> تعداد سفارش </th>
                            <th>مبلغ سفارشات</th>
                            <th> آخرین سفارش </th>
                            <th>فعال</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bestCustomers->take(5) as $customer)
                        <tr>
                            <td style="width: 36px;">
                                <img src="{{ asset($customer->profile->avatar ?? "admin/assets/images/users/default.png") }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                            </td>

                            <td>
                                <h5 class="m-0 fw-normal">
                                    <a class="text-secondary" target="_blank" href="{{ route('customers.index',['filter'=>'id','search'=> $customer->id]) }}">
                                    @if(!empty($customer->profile->name)  )
                                        {{ $customer->profile->name }} {{ $customer->profile->last_name ?? ''}}
                                    @elseif(!empty($customer->phone))
                                         {{ $customer->phone ?? $customer->email}}
                                    @endif
                                    </a> </h5>
                                <p class="mb-0 text-muted"><small>عضو از {{  jdate($customer->created_at)->format('Y') }}</small></p>
                            </td>

                            <td>
                               {{  $customer->orders->where('payment_status','paid')->count('id') ?? 0 }}
                            </td>

                            <td>
                                {{  number_format($customer->orders->sum('total_price') ?? 0) }}
                            </td>

                            <td>
                                 {{ jdate($customer->orders->last()->created_at ?? 0)->ago()  }}

                            </td>

                            <td>
                                @if(jdate($customer->orders->last()->created_at ?? 0)->getDay() < 90)
                                <a href="javascript: void(0);" class="btn btn-xs btn-success"><i class="mdi mdi-account-check-outline"></i></a>
                                @else
                                    <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-account-off-outline"></i></a>
                                @endif
                            </td>
                        </tr>

                        @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="{{ route('dashboard',['bestProducts' => 'inorders']) }}" class="dropdown-item">تعداد سفارش </a>
                        <!-- item-->
                        <a href="{{ route('dashboard') }}" class="dropdown-item"> تعداد خرید </a>

                    </div>
                </div>

                <h4 class="header-title mb-3"> 5 محصول برتر</h4>

                <div class="table-responsive">
                    <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                        <thead class="table-light">
                        <tr>
                            <th>نام محصول</th>
                            <th> سفارش</th>
                            <th>  تعداد </th>
                            <th>آخرین فروش</th>
                            <th>نرخ تبدیل</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bestProducts->take(5) as $product)
                            @if($product->history->count()>0)
                            <tr>
                                <td>
                                    <h5 class="m-0 fw-normal">
                                        <a href="{{ route('products.index',['name' => $product->sku]) }}" target="_blank">    {{ $product->name }} </a>
                                    </h5>
                                </td>

                                <td>
                                    {{ \App\Models\History::select('order_id', 'product_id')
                                      ->where('product_id',$product->id) ->distinct()->get()->count() }}
                                </td>

                                <td>
                                    {{  $product->history->sum('quantity') }} <!-- نمایش تعداد فروش -->
                                </td>

                                <td title="">
                                    <span class="font-12"> {{ jdate($product->history()->latest('created_at')->first()->created_at ?? 0)->format('d M Y') }} </span>
                                </td>

                                <td>
                                    {{ ($product->views != 0) ? round((($product->history->sum('quantity') / $product->views) * 100),2) : 0 }} %

                                </td>
                            </tr>
                            @endif
                        @endforeach




                        </tbody>
                    </table>
                </div>
                <!-- end .table-responsive-->
            </div>
        </div>
        <!-- end card-->
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">


                <h4 class="header-title mb-3"> دیدگاه های جدید </h4>

        <div class="table-responsive">

            <ul class="list-group">
                <!-- Example comment item -->
                @foreach($new_comments->take(5) as $comment)
                    <li class="list-group-item  @if($comment?->status == 'published') border-success @else border-warning bg-soft-warning @endif shadow-sm " data-comment-id="{{ $comment?->id }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-1"> دیدگاه : {{ $comment?->username ?? '' }} برای محصول : <b> {{ $comment?->commentable->name ?? ''}}</b>  </h5>


                            @if($comment->status == 'published')
                                <small class="badge badge-outline-success status"> تایید شده </small>
                            @else
                                <small class="badge badge-outline-warning status">  در انتظار </small>
                            @endif

                        </div>
                        <p class="p-1 my-custom-comment-style font-12 overflow-auto">{{ \Illuminate\Support\Str::limit($comment?->text,110) }}</p>

                        <!-- Add reply form for each comment -->
                        <form class="mt-3">

                            <a href="{{ route('products.edit', ['product' => $comment?->commentable->id]) }}#comment-{{ $comment?->id }}" class="btn btn-outline-primary btn-sm me-2 btn-reply">مشاهده دیدگاه</a>

                            <small class="text-muted float-end">تاریخ: {{ jdate($comment?->created_at)->toFormattedDateString() }}</small>
                        </form>
                    </li>
                    <br/>
                @endforeach
                <!-- Repeat for other comments -->
            </ul>

                </div>
                <!-- end .table-responsive-->
            </div>
        </div>
        <!-- end card-->
    </div>











    <!-- end col -->
</div>
