@extends('admin.panel.layouts.master')
@section('page-title','لیست محصولات')
@section('CustomCss')

    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

    <script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
    <link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
          type="text/css"/>
    @include('admin.store.products.inc._errors')
@endsection
@section('content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->


    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-primary">
                                <i class="fe-star-on font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $productCount }}</span></h3>
                                <p class="text-muted mb-1 text-truncate"> محصولات فعال</p>
                            </div>
                        </div>
                    </div>
                    <!-- end row-->
                </div>
            </div>
            <!-- end widget-rounded-circle-->
        </div>
        <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-success">
                                <i class="fe-eye font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $totalViews }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">بازدید کننده </p>
                            </div>
                        </div>
                    </div>
                    <!-- end row-->
                </div>
            </div>
            <!-- end widget-rounded-circle-->
        </div>
        <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-warning">
                                <i class="fe-file-text font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $commentCount }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">دیدگاه جدید </p>
                            </div>
                        </div>
                    </div>
                    <!-- end row-->
                </div>
            </div>
            <!-- end widget-rounded-circle-->
        </div>
        <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-danger">
                                <i class="fe-plus font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $categoryCount }}</span>
                                </h3>
                                <p class="text-muted mb-1 text-truncate">دسته های محصولات</p>
                            </div>
                        </div>
                    </div>
                    <!-- end row-->
                </div>
            </div>
            <!-- end widget-rounded-circle-->
        </div>
        <!-- end col-->
    </div>
    <!-- end row -->





    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('products.create') }}"
                       class="btn btn-sm btn-blue waves-effect waves-light float-end ms-1">
                        <i class="mdi mdi-plus-circle"></i> افزودن محصول
                    </a>

                    <a href="{{ route('products.index') }}"
                       class="btn btn-sm btn-success waves-effect waves-light float-end ms-1">
                        <i class="mdi mdi-shower"></i> نمایش همه
                    </a>

                    <div class="header-title mb-4">
                        <form method="get" action="{{ request()->fullUrl() }}">
                            <label for="search" class="visually-hidden"> </label>
                            <input id="search" value="{{ request()->query('name') ?? "" }}" name="name"
                                   class="form-control w-25" type="search" placeholder="عنوان یا کد محصول + Enter">

                        </form>
                    </div>
                    <hr/>


                    <div class="table-responsive">
                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100"
                               id="product-table">
                            <thead>
                            <tr>

                                <th>کد محصول</th>
                                <th>عنوان</th>
                                <th>دسته</th>
                                <th> تعداد نوع</th>

                                <th>

                                    @if($views == 'asc')
                                        <a class="text-color-black" href="?views=desc"> بازدید </a>

                                        <i class="mdi mdi-chevron-up"></i>
                                    @elseif($views == 'desc')

                                        <a class="text-color-black" href="?views=asc"> بازدید </a>
                                        <i class="mdi mdi-chevron-down"></i>
                                    @else
                                        <a class="text-color-black" href="?views=asc"> بازدید </a>
                                        <i class="mdi mdi-chevron-down"></i>
                                    @endif

                                </th>
                                <th> تاریخ ایجاد</th>
                                <th> موجودی</th>
                                <th class="hidden-sm">اقدامات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($products as  $product)
                                <tr id="row-{{ $product->id }}"
                                    @if($product->is_active == 0) class="bg-soft-warning" @endif>
                                    <td><b>{{$product->sku}}</b></td>
                                    <td>
                                        {{ $product->name }}
                                    </td>

                                    <td>
                                        <a class="text-color-link"
                                           href="{{ request()->fullUrlWithQuery(['category' => $product->categories->first()->id ?? 0]) }}">
                                            {{ $product->categories->first()->name ?? 'بدون دسته'}}
                                        </a>
                                    </td>


                                    <td title=" قیمت {{ $product->price }} با تخفیف  {{ $product->discount }} درصد">
                                        {{ $product->types->count() }}
                                    </td>

                                    <td>
                                        {{ $product->views }}
                                    </td>

                                    <td>
                                        {{ jdate($product->created_at)->toFormattedDateString() }}
                                    </td>

                                    <td>
                                        @if($product->batches->count() == 0)
                                            <span class="badge badge-outline-danger blinking-badge"> ثبت نشده </span>

                                        @else
                                            {{ $product->batches->sum('quantity') - $product->batches->sum('sales_number')   ?? 0 }} {{ $product->unit }}
                                        @endif

                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($product->is_active == 1)
                                                <a target="_blank" href="
                 " title="مشاهده محصول" class="btn btn-xs waves-effect waves-light btn-outline-primary">
                                                    <span class="mdi mdi-eye-outline "></span>
                                                </a>
                                            @else
                                                <a href="#" title="مشاهده محصول"
                                                   class="btn disabled btn-xs waves-effect waves-light btn-outline-primary">
                                                    <span class="mdi mdi-eye-outline "></span>
                                                </a>
                                            @endif

                                            <a target="_blank"
                                               href="{{ route('batch.index',['product_id'=> $product->id]) }}"
                                               title="انبار"
                                               class="btn btn-xs btn-outline-primary m-1">
                                                <i class="mdi mdi-stocking"></i>
                                            </a>


                                            <a title="ویرایش" href="{{ route('products.edit',$product->id) }}"
                                               class="btn btn-xs btn-outline-blue  m-1">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>

                                            <!-- فرم حذف -->
                                            <form action="{{ route('products.destroy', $product->id) }}"
                                                  class="inline-form delete-form"
                                                  data-id="{{ $product->id }}">
                                                @csrf
                                                @method('Delete')
                                                <button title="حذف" id="delete-btn-{{$product->id}}" type="button"
                                                        class="btn btn-xs btn-outline-danger delete-btn m-1">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                                @include('admin.store.products.inc._show')
                            @endforeach

                            </tbody>
                        </table>


                    </div>

                    <div class="paginate">

                        {{ $products->links() }}

                    </div>


                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->





    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

@endsection

@section('CustomJs')

    @include('admin.store.products.inc._index_script')
    <script src="{{ asset('admin/assets/libs/tippy.js/tippy.all.min.js') }}"></script>

@endsection










