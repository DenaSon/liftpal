@extends('admin.panel.layouts.master')
@section('page-title','مدیریت کوپن ها')
@section('CustomCss')


    <script src="{{ asset('admin/assets/js/jalalidatepicker.min.js') }}"></script>

    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

    <script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
    <link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('admin/assets/css/jalalidatepicker.min.css') }}" rel="stylesheet" type="text/css"/>
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
                    <div class="d-flex justify-content-center">
                        <form class="w-25" method="post" action="{{ route('coupons.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="discountCode" class="form-label"># کد تخفیف</label>
                                <input type="text" class="form-control" id="discountCode" name="discountCode" required>
                            </div>

                            <div class="mb-3">
                                <label for="discountType" class="form-label">نوع</label>
                                <select class="form-select" id="discountType" name="discountType" required>
                                    <option value="percentage">درصدی</option>
                                    <option value="fixed_amount">ثابت</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="discountAmount" class="form-label">مقدار تخفیف</label>
                                <input type="number" class="form-control" id="discountAmount" name="discountAmount" required>
                            </div>

                            <div class="mb-3">
                                <label for="expirationDate" class="form-label">زمان انقضاء</label>
                                <input readonly data-jdp type="text" class="form-control" id="expirationDate" name="expirationDate" required>
                            </div>

                            <button type="submit" class="btn btn-primary">ثبت کوپن</button>
                        </form>
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



    <script>

        var options = {
            time: true,
            hasSecond: false,
            separatorChars: {
                date: '-',
                time: ':',
                dateTime: ' ',

            }


        };
        jalaliDatepicker.startWatch(options);

    </script>

    @include('admin.store.suppliers.inc._scripts')


@endsection










