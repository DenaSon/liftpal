@extends('admin.panel.layouts.master')
@section('page-title','تنظیمات ')
@section('CustomCss')

<script src="{{ asset('vendor/ckstandard/ckeditor.js') }}"></script>

<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

@include('admin.inc.printStyle')

@include('admin.store.products.inc._errors')
@endsection
@section('content')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">

<div class="row">
<div class="col-sm-2">
<div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <a class="nav-link show mb-1 active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-shop" role="tab" aria-controls="v-pills-shop" aria-selected="true">
        فروشگاه </a>
    <a class="nav-link mb-1" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-profile" aria-selected="false">
        سراسری</a>

    <a class="nav-link mb-1" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-seo" role="tab" aria-controls="v-pills-seo" aria-selected="false">سئو</a>



</div>
    </div>
            <!-- end col-->
            <div class="col-sm-10">
                <form action="{{ route('setting-update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                <div class="tab-content pt-0">

                    <div class="tab-pane fade active show" id="v-pills-shop" role="tabpanel" aria-labelledby="v-pills-shop-tab">

                        @include('admin.setting.inc._shop')

                    </div>


                    <div class="tab-pane fade" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                        @include('admin.setting.inc._general')
                    </div>


                    <div class="tab-pane fade" id="v-pills-seo" role="tabpanel" aria-labelledby="v-pills-seo-tab">
                        @include('admin.setting.inc._seo')
                    </div>


                </div>

                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-outline-primary" type="submit">
                        <span class="mdi mdi-content-save-outline"></span>
                    ذخیره تنظیمات
                    </button>
                </div>
                </form>
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->
    </div>
</div>
<!-- end card-->
</div>
<!-- end col -->


<!-- end col -->
</div>






<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

@endsection




@section('CustomJs')

@include('admin.log.inc.scripts')


@endsection










