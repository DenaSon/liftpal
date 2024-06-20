@extends('admin.panel.layouts.master')
@section('page-title','بارکدساز')
@section('CustomCss')

    <script src="{{ asset('vendor/ckstandard/ckeditor.js') }}"></script>


    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>



    <script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
    <link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    @include('admin.store.barcodes.inc._printStyle')
    @include('admin.store.products.inc._errors')
@endsection
@section('content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->


    <div class="d-flex justify-content-center align-items-center">
        <div class="card" style="width:550px">

            <div class="card-header bg-soft-primary">
                <span class="mdi mdi-barcode-scan font-20"></span> &nbsp; ایجاد بارکد
            </div>
            <div class="card-body">
                <form action="{{ route('barcode') }}" method="get" class="barcode-form">

                <div class="mb-3">
                    <label class="form-label" for="type"> نوع بارکد </label>
                    <select name="type" class="form-select" id="type">
                        <option value="QRCODE">QRCODE</option>
                        <option value="DATAMATRIX">DATAMATRIX</option>
                        <option value="PDF417">PDF417</option>

                    </select>

                </div>

                <div class="mb-3">
                    <label class="form-label" for="link"> لینک </label>
                    <input value="{{request()->query('link')}}" type="url" required name="link" id="link" class="form-control" placeholder="https://">

                </div>

                    <div class="mb-3">

                        <button type="submit" class="btn btn-primary">  تولید بارکد </button>
                    </div>

                </form>
                @if(request()->query('link'))
                <div class="text-center align-content-center">

                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(request()->query('link'),request()->query('type'),8,8) }}"
                         alt="QR Code" style="max-height: 200px;min-width: 200px" class="img-barcode  p-2 mb-2" />
                            <br/>


            <div class="clearfix"></div>

                 

                    <button onclick="window.print()" class="btn btn-outline-primary"> <span class="fe-printer"></span> </button>

                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

@endsection

@section('CustomJs')




@endsection

