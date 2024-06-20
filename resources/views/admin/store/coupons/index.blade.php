@extends('admin.panel.layouts.master')
@section('page-title','مدیریت کوپن ها')
@section('CustomCss')

    <script src="{{ asset('vendor/ckstandard/ckeditor.js') }}"></script>


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
    @include('admin.store.suppliers.inc._create')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('coupons.create') }}"
                       class="btn btn-sm btn-warning waves-effect waves-light float-end">
                        <i class="mdi mdi-plus-circle"></i> افزودن  کوپن
                    </a>




                    <div class="table-responsive">
                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100"
                               id="product-table">
                            <thead>
                            <tr>

                                <th>#</th>
                                <th>کد تخفیف</th>
                                <th>نوع</th>
                                <th>مقدار تخفیف</th>
                                <th> زمان انقضاء  </th>
                                <th class="hidden-sm">اقدامات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($coupons as $index => $coupon)
                                <tr id="row-{{ $coupon->id }}">
                                    <td><b>{{ $index }}</b></td>
                                    <td class="">
                                        <span class="badge badge-outline-danger font-14 bolder p-1">   {{ $coupon->code }} </span>
                                    </td>

                                    <td>
                                        @if($coupon->type == 'percentage') درصدی @endif
                                        @if($coupon->type == 'fixed_amount') ثابت @endif
                                    </td>

                                    <td><b>
                                        {{ round($coupon->value) }}
                                        @if($coupon->type == 'percentage') درصد @endif
                                        @if($coupon->type == 'fixed_amount') تومان @endif
                                        </b>   </td>

                                    <td>
                                        {{ jdate($coupon->end_date)->toDateString() }}
                                    </td>


                                    <td>
                                        <div class="d-flex align-items-center">


                                                <form method="post" action="{{ route('coupons.destroy', $coupon->id) }}"
                                                  class="inline-form delete-form"
                                                  data-id="{{ $coupon->id}}">
                                                    @method('DELETE')
                                                @csrf

                                                <button title="حذف" id="delete-btn-{{$coupon->id}}" type="submit"
                                                        class="btn btn-xs btn-outline-danger delete-btn m-1">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>


                            @endforeach

                            </tbody>
                        </table>



                    </div>

                    <div class="paginate">

                        {{ $coupons->links() }}

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

    @include('admin.store.suppliers.inc._scripts')

@endsection










