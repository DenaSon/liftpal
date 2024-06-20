@extends('admin.panel.layouts.master')
@section('page-title','لیست برندها ')
@section('CustomCss')

<link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

@include('admin.store.products.inc._errors')
@endsection
@section('content')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
@include('admin.store.brands.inc._create')
<div class="row">
<div class="col-sm-12">
<div class="card">
    <div class="card-body">
        <div class="table-responsive">


        <table class="table table-striped">
           <thead>
           <tr>
           <th style="width:50px">#</th>
           <th>نام</th>
           <th>توضیحات</th>
           <th>تصویر</th>
           <th>زمان ایجاد</th>
           <th>اقدامات</th>

           </tr>
           </thead>

        <tbody>

        @foreach( $brands as $brand )

            @include('admin.store.brands.inc.edit')
        <tr>
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->name }}</td>
            <td>{{ \Illuminate\Support\Str::limit($brand->description,95,'...') }}</td>
            <td>
              <a href="{{ asset($brand->images->first()->file_path ?? '') }}" target="_blank">
                  <img src="{{ asset($brand->images->first()->file_path ?? '') }}" style="width:45px;height:45px;border-radius:10px" alt="logo"> </a>
            </td>
            <td>  {{ jdate($brand->created_at)->toFormattedDateTimeString() }}</td>
            <td>  <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editmodal-{{ $brand->id }}">
                    <span class="fe-edit-1"></span>
                </button>

            </td>

        </tr>

            @endforeach
    </table>




        </div>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
               ایجاد برند جدید
            </button>


          <div class="paginate">


            {{ $brands->links() }}


</div>
<hr/>

</div>


</div>
<!-- end card-->
</div>
<!-- end col-->
</div>




<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

@endsection




@section('CustomJs')

@include('admin.store.brands.inc._scripts')


@endsection










