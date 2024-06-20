@extends('admin.panel.layouts.master')
@section('page-title','برچسب های مقالات')
@section('CustomCss')

    <script src="{{ asset('vendor/ckstandard/ckeditor.js') }}"></script>


    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>


    <script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
    <link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

    @include('admin.store.products.inc._errors')
@endsection
@section('content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">

    <div class="row">

        <div class="col-md-5">


            <form method="POST" action="{{ route('blogTags.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">نام برچسب :</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>


                <div class="d-grid">
                    <button type="submit" class="btn btn-soft-primary mb-1">ثبت برچسب</button>
                </div>
            </form>


        </div> <!-- end col -->

        <div class="col-7">
        <h5> برچسب های محبوب </h5>


            <div class="">
                @foreach( $mostViewedTags as $tagItem )
               <span class="btn btn-soft-info btn-sm m-1"> {{ $tagItem->name }}  </span>

                @endforeach
            </div>

 </div> <!-- end col -->


    </div>

<hr>

<div class="row">

    <div class="col-md-12">
      @if(count( $tags ) > 1)
            <h4 class="header-title">لیست برچسب ها</h4>
      @endif

        <table class="table table-responsive table-hover">

            <thead>
            <tr>
                <th>#</th>
                <th>نام</th>
                <th>
                    <a class="text-dark" href="?views=desc"> بازدید </a>

                </th>
                <th>زمان ایجاد</th>
                <th>اقدامات</th>
            </tr>
            </thead>

            <tbody>
            @foreach( $tags as $tag )
            <tr>
            <td> {{ $tag->id }} </td>
            <td>
            <span class="badge  badge-outline-info"> {{ $tag->name }} </span>
            </td>
            <td> {{ $tag->views }} </td>
            <td> {{ jdate($tag->created_at)->ago() }} </td>
            <td>
            <div class="btn btn-group-sm ">

                <button  type="button"  class="btn btn-outline-primary " data-bs-toggle="modal" data-bs-target="#bs-edit-modal-sm-{{$tag->id}}"> <i class="fe-edit-1"></i> </button>


            </div>

            </td>
        </tr>
                @include('admin.store.tags.inc._edit')
            @endforeach
            </tbody>
        </table>

    <div class="paginate">
    {{ $tags->links() }}
    </div>


    </div><!-- end col -->


</div> <!-- end row -->
</div>
</div> <!-- end card -->
</div> <!-- end col -->
</div>


    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

@endsection
@section('CustomJs')
@endsection
