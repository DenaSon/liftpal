@extends('admin.panel.layouts.master')
@section('page-title',' مدیریت کارشناسان فنی ها')
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


<div class="row">
<div class="col-12">
<div class="row">
<div class="col-lg-6 col-xl-3">
<div class="card bg-pattern">
<div class="card-body">
<div class="row">
    <div class="col-6">
        <div class="avatar-md bg-blue rounded">
            <i class="fe-users avatar-title font-22 text-white"></i>
        </div>
    </div>
    <div class="col-6">
        <div class="text-end">
            <h3 class="text-dark my-1"><span data-plugin="counterup">{{ \App\Models\User::where('role','technician')->count('id') }}</span></h3>
            <p class="text-muted mb-0 text-truncate">کارشناس فنی</p>
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
            <i class="fe-user avatar-title font-22 text-white"></i>
        </div>
    </div>
    <div class="col-6">
        <div class="text-end">
            <h3 class="text-dark my-1"><span data-plugin="counterup">

                     {{\App\Models\User::whereBetween('created_at', [now()->subDay(), now()])->where('role','technician')->count('id') }}

                </span></h3>
            <p class="text-muted mb-0 text-truncate">ثبت نام امروز</p>
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
            <i class="fe-user-plus avatar-title font-22 text-white"></i>
        </div>
    </div>
    <div class="col-6">
        <div class="text-end">
            <h3 class="text-dark my-1"><span data-plugin="counterup">
               {{\App\Models\User::whereBetween('created_at', [now()->subWeek(), now()])->where('role','technician')->count('id') }}
                </span></h3>
            <p class="text-muted mb-0 text-truncate">ثبت نام هفته</p>
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
            <i class="fe-user-check avatar-title font-22 text-white"></i>
        </div>
    </div>
    <div class="col-6">
        <div class="text-end">
            <h3 class="text-dark my-1">
                <span data-plugin="counterup">
                    {{\App\Models\User::whereBetween('created_at', [now()->subMonth(), now()])->where('role','technician')->count('id') }}
                </span> </h3>
            <p class="text-muted mb-0 text-truncate">  ثبت نام ماه </p>
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
        <th>کاربر</th>
        <th data-priority="1"> نام</th>
        <th data-priority="1">  نام خانوادگی</th>
        <th data-priority="4">تخصص </th>
        <th data-priority="6">وضعیت</th>
        <th data-priority="6">ثبت نام</th>
        <th data-priority="2" style="width:65px"> اقدامات</th>

    </tr>

    </thead>
    <tbody>
    @foreach($users as $user)

        <tr>

        <th> {{ $user->phone ?? $user->email ?? '' }} </th>
        <td> {{ $user->profile->name ?? 'ثبت نشده' }} </td>
        <td>{{ $user->profile->last_name ?? 'ثبت نشده' }}</td>
        <td title="{{$user->profile->expertise ?? '' }}">{{   ($user->profile->expertise) ?? 'ثبت نشده' }}</td>
        <td>
            @if($user->status == 'banned')
                <span class="alert alert-danger"> مسدود </span>
            @else
                <span class="alert"> فعال </span>
            @endif

        </td>
        <th title="{{ jdate($user->created_at)->ago() }}"> {{ jdate($user->created_at)->toFormattedDateString() }} </th>
        <td>
        <form id="userDeleteForm-{{ $user->id }}" action="{{ route('customers.destroy', ['customer' => $user->id]) }}" method="post">
            @csrf
            @method('DELETE')
        <div class="btn btn-group-sm ">

            <button  type="button"  class="btn btn-xs btn-outline-primary "data-bs-toggle="modal" data-bs-target="#bs-show-modal-sm-{{ $user->id }}"> <i class="fe-eye"></i> </button>
            <button type="button" class="btn btn-xs btn-outline-info " data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$user->id}}">
                <i class="fe-mail"></i>
            </button>
            <button  type="button"  class="btn btn-xs btn-outline-secondary "data-bs-toggle="modal" data-bs-target="#bs-edit-modal-sm-{{ $user->id }}"> <i class="fe-edit-2"></i> </button>


            <button class="deleteButton btn btn-outline-danger"data-user-id="{{ $user->id }}" type="button">
                <i class="fe-trash-2"></i>
            </button>

        </div>
        </form>
        </td>

        </tr>

@include('admin.user.inc._show')
@include('admin.user.inc._edit')
@include('admin.user.inc._sendMessage')

    @endforeach

    </tbody>
</table>
</div> <!-- end .table-responsive -->
<div class="paginate">
{{ $users->links() }}
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
            <form action="{{ route('customers.index') }}"  class="d-flex flex-wrap align-items-center">


                <label for="filter" class="me-2 visually-hidden">مرتب سازی بر اساس</label>
                <div class="me-sm-3">
                    <select class="form-select my-1 my-lg-0" id="filter" name = "filter">
                        <option value="phone"> شماره تلفن </option>
                        <option value="email">  ایمیل </option>
                        <option value="name"> نام </option>
                        <option value="last_name"> نام خانوادگی </option>
                        <option value="expertise"> تخصص </option>
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

                <a href="{{ route('customers.index') }}" class="btn btn-light waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i>  نمایش همه </a>
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


@include('admin.user.inc._scripts')

@endsection










