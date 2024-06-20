@extends('admin.panel.layouts.master')
@section('page-title',' مدیریت  مقالات')
@section('CustomCss')

<script src="{{ asset('vendor/ckstandard/ckeditor.js') }}"></script>


<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

<script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
<link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />

@include('admin.store.products.inc._errors')
@endsection
@section('content')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->


<script>

</script>



<div class="row">
<div class="col-12">
<div class="row">
<div class="col-lg-6 col-xl-3">
<div class="card bg-pattern">
<div class="card-body">
    <div class="row">
        <div class="col-6">
            <div class="avatar-md bg-blue rounded">
                <i class="icon icon-notebook avatar-title font-22 text-white"></i>
            </div>
        </div>
        <div class="col-6">
            <div class="text-end">
                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ \App\Models\Post::where('is_active',1)->count('id') }}</span></h3>
                <p class="text-muted mb-0 text-truncate">مقالات</p>
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->
</div> <!-- end col -->

<div class="col-lg-6 col-xl-3">
<div class="card bg-pattern">
<div class="card-body">
    <div class="row">
        <div class="col-6">
            <div class="avatar-md bg-success rounded">
                <i class="mdi mdi-notebook-plus-outline avatar-title font-22 text-white"></i>
            </div>
        </div>
        <div class="col-6">
            <div class="text-end">
                <h3 class="text-dark my-1"><span data-plugin="counterup">

{{\App\Models\Post::whereBetween('created_at', [now()->subWeek(), now()])->where('is_active',1)->count('id') }}

</span></h3>
                <p class="text-muted mb-0 text-truncate"> مقالات هفته </p>
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->
</div> <!-- end col -->
<div class="col-lg-6 col-xl-3">
<div class="card bg-pattern">
<div class="card-body">
    <div class="row">
        <div class="col-6">
            <div class="avatar-md bg-danger rounded">
                <i class="mdi mdi-calendar-month-outline  avatar-title font-22 text-white"></i>
            </div>
        </div>
        <div class="col-6">
            <div class="text-end">
                <h3 class="text-dark my-1"><span data-plugin="counterup">
{{\App\Models\Post::whereBetween('created_at', [ now()->subMonth(), now()])->where('is_active',1)->count('id') }}
</span></h3>
                <p class="text-muted mb-0 text-truncate">مقالات ماه</p>
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->
</div> <!-- end col -->
<div class="col-lg-6 col-xl-3">
<div class="card bg-pattern">
<div class="card-body">
    <div class="row">
        <div class="col-6">
            <div class="avatar-md bg-warning rounded">
                <i class="fe-eye avatar-title font-22 text-white"></i>
            </div>
        </div>
        <div class="col-6">
            <div class="text-end">
                <h3 class="text-dark my-1">
<span data-plugin="counterup">
{{\App\Models\Post::where('is_active',1)->sum('views')}}
</span> </h3>
                <p class="text-muted mb-0 text-truncate">  بازدیدها </p>
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->
</div> <!-- end col -->
</div>



<div class="card">
<div class="card-body">

<div class="responsive-table-plugin">

<div class="table-rep-plugin">

    <div class="table-responsive" data-pattern="priority-columns">

        <table id="tech-companies-1" class="table table-striped">

            <thead>
            <tr>

                <th data-priority="1">عنوان </th>
                <th data-priority="3">کاربر</th>
                <th data-priority="5"> لایک</th>
                <th data-priority="4"> بازدید</th>
                <th data-priority="2" style="width:65px"> اقدامات</th>
            </tr>
            </thead>
            <tbody>
@foreach($posts as $post)
@include('admin.blog.posts.inc._show')
    <tr>


        <th> {{ $post->title }} </th>
        <td> {{ $post->user->profile->name . ' ' .$post->user->profile->last_name  }}<br> <span class="text-muted"> {{ $post->user->phone ?? $post->user->email  }} </span> </td>
        <td> {{ $post->likes }} </td>
        <td> {{ $post->views }} </td>
        <td>

        <form id="postDeleteForm-{{ $post->id }}" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('DELETE')
        <div class="btn btn-group-sm">

            <button  type="button"  class="btn btn-outline-primary " data-bs-toggle="modal" data-bs-target="#bs-show-modal-lg-{{ $post->id }}"> <i class="fe-eye"></i> </button>

            <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-outline-secondary">
             <i class="fe-edit-2"></i>
            </a>
            <button class="deleteButton btn btn-outline-danger" data-user-id="{{ $post->id }}" type="button">
                <i class="fe-trash-2"></i>
            </button>

        </div>
        </form>

        </td>
    </tr>



@endforeach

            </tbody>
        </table>
    </div> <!-- end .table-responsive -->
    <div class="paginate">
        {{ $posts->links() }}
    </div>

</div> <!-- end .table-rep-plugin-->
</div> <!-- end .responsive-table-plugin-->
</div>

@include('admin.user.inc._create')


</div> <!-- end card -->
</div> <!-- end col -->




</div>
<!-- end row -->


<div class="col-12">
<div class="card">

<div class="card-body">
<div class="row justify-content-between">
<div class="col-auto">
<form action="{{ route('posts.index') }}"  class="d-flex flex-wrap align-items-center">


    <label for="filter" class="me-2 visually-hidden">مرتب سازی بر اساس</label>
    <div class="me-sm-3">
        <select class="form-select my-1 my-lg-0" id="filter" name = "filter">
            <option value="title"> عنوان </option>

        </select>
    </div>

    <label for="searchText" class="visually-hidden">جستجو</label>
    <div class="me-sm-5 me-3">
        <input type="search" class="form-control" id="searchText" placeholder="متن جستجو..." name="search">
    </div>


    <div class="me-sm-5 me-3">
        <button type="submit" class="btn btn-success waves-effect waves-light me-2"><i class="mdi mdi-account-search-outline"> جستجو </i></button>
    </div>

</div>
<div class="col-auto">
<div class="text-lg-end my-1 my-lg-0">

    <a href="{{ route('posts.index') }}" class="btn btn-light waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i>  نمایش همه </a>
</div>
</div><!-- end col-->

</div> <!-- end row -->

</div>
</form>
</div> <!-- end card -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

@endsection

@section('CustomJs')


<script src="{{ asset('admin/assets/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>

<!-- Init js -->
<script src="{{ asset('admin/assets/js/pages/responsive-table.init.js') }}"></script>


@include('admin.blog.posts.inc._scripts')

@endsection










