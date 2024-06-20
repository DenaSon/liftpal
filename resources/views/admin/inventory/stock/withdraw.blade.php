@extends('admin.panel.layouts.master')
@section('page-title', 'برداشت محصول')
@section('CustomCss')

    <script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jalalidatepicker.min.js') }}"></script>

    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('admin/assets/css/jalalidatepicker.min.css') }}" rel="stylesheet" type="text/css"/>
    @include('admin.store.products.inc._errors')
@endsection
@section('content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="row align-content-center">
        <div class="col-md-8 mx-auto">


            <div class="card">
                <div class="card-body">


                    <div class="card shadow-lg">
                        <div class="card-body">


                                <form action="{{ route('stock.store') }}" method="post">
                                    <div class="mb-3">
                                        <label for="product" class="mb-2"> انتخاب محصول </label>
                                        <select class="js-example-basic-single" name="state">
                                            <option value="AL">Alabama</option>
                                            ...
                                            <option value="WY">Wyoming</option>
                                        </select>

                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>







                </div> <!-- end card-body -->
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

    @include('admin.inventory.stock.inc._scripts')



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


    <script>
        $("select").select2({
            tags: "true",
            placeholder: "Select an option",
            allowClear: true
        });


        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });


    </script>

@endsection










