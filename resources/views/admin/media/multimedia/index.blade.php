@extends('admin.panel.layouts.master')
@section('page-title','مدیریت فایل')
@section('CustomCss')
<link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>
@include('admin.store.products.inc._errors')
@endsection
@section('content')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="card">
<div class="card-body">
<!-- Left sidebar -->
<div class="inbox-leftbar">
<div class="btn-group d-block mb-2">
<form id="uploadForm" method="post" enctype="multipart/form-data" action="{{ route('multimedia.store') }}">
@csrf

<!-- Hidden file input element -->
<input name="image" type="file" id="fileInput" style="display: none;" />

<!-- Button to trigger file input -->
<label for="fileInput" class="btn btn-success w-100 waves-effect waves-light">
    <i class="mdi mdi-plus"></i> آپلود فایل
</label>
</form>
</div>
<div class="mail-list mt-3">
<a href="{{ route('multimedia.index') }}" class="list-group-item border-0 font-14"><i class="fe-file font-18 align-middle me-2"></i>نمایش همه</a>
<a href="?filter=product" class="list-group-item border-0 font-14"><i class="fe-shopping-bag font-18 align-middle me-2"></i> محصولات</a>
<a href="?filter=blog" class="list-group-item border-0 font-14"><i class="icon icon-note font-18 align-middle me-2"></i> مقالات</a>
<a href="?filter=logo" class="list-group-item border-0 font-14"><i class="mdi mdi-simple-icons font-18 align-middle me-2"></i> لوگو</a>
<a href="?filter=slider" class="list-group-item border-0 font-14"><i class="fe-sliders font-18 align-middle me-2"></i>اسلایدها</a>
<a href="?filter=user" class="list-group-item border-0 font-14"><i class="fe-users font-18 align-middle me-2"></i>کاربران</a>
<a href="?filter=png" class="list-group-item border-0 font-14"><i class="fe-users font-18 align-middle me-2"></i>تصاویر PNG</a>
<a href="?filter=jpeg" class="list-group-item border-0 font-14"><i class="fe-users font-18 align-middle me-2"></i>تصاویر JPEG</a>
<a href="?filter=file" class="list-group-item border-0 font-14"><i class="fe-users font-18 align-middle me-2"></i> فایل ها </a>

</div>



<div class="mt-5 pt-lg-5">
<h6 class="text-uppercase mt-3">حافظه ذخیره سازی</h6>
<div class="progress my-2 progress-sm">
<div class="progress-bar progress-lg bg-danger" role="progressbar" style="width: {{ $data['usedSpacePercentage']  }}%" aria-valuenow="{{ $data['usedSpacePercentage'] }}" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted font-12 mb-0">

{{ $data['freeSpace'] }} مگابایت
از حافظه کل
{{ $data['totalSpace'] }}
آزاد می باشد و
{{ $data['usedSpacePercentage'] }}%
استفاده شده است.

</p>
</div>

</div>
<!-- End Left sidebar -->

<div class="inbox-rightbar">



<div class="mt-1">


<div class="table-responsive">
<table class="table table-centered table-nowrap mb-0">
    <thead class="table-light">
    <tr>
        <th class="border-0">#</th>
        <th class="border-0">نام</th>


        <th class="border-0">نوع</th>
        <th class="border-0">سایز</th>
        <th class="border-0">نمایش</th>
        <th class="border-0">ایجاد</th>
        <th class="border-0" style="width: 80px;">اقدامات</th>
    </tr>
    </thead>
    <tbody>


    @foreach($images as $image)

    <tr>

        @if(file_exists($image->file_path))
            <td> {{ $image->id }} </td>
        <td>
            <span class="ms-2 fw-medium"><a href="javascript: void(0);" class="text-reset">{{ $image->file_name }}</a></span>
        </td>
        <td>
            {{  mime_content_type($image->file_path) }}
        </td>

        <td>

         {{ round(filesize($image->file_path) / 1024) }} کیلوبایت


        </td>
        <td>
            @if(Str::contains(mime_content_type($image->file_path), 'image'))
            <a href="{{ asset($image->file_path) }}" target="_blank">
            <img src="{{ asset( $image->file_path)  }}" class="img-thumbnail" style="height:40px;width:40px;" alt="preview">
            </a>
            @else
                <a href="{{ asset($image->file_path) }}" target="_blank"> فایل </a>
            @endif

        </td>



        <td id="tooltips-container1">
        {{ jdate($image->created_at)->toFormattedDateString() }}
        </td>
        <td>
            <div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-end">

                    <a target="_blank"  class="dropdown-item" href="{{ asset($image->file_path) }}">
                        <i class="mdi mdi-eye me-2 text-muted vertical-middle"></i>مشاهده</a>

                    <a class="dropdown-item" href="{{ asset($image->file_path) }}" download="{{ asset($image->file_path) }}">
                        <i class="mdi mdi-download me-2 text-muted vertical-middle"></i>دانلود
                    </a>
                    <a onclick="deleteImage('{{ $image->id }}')" class="dropdown-item" href="#"><i class="mdi mdi-delete me-2 text-muted vertical-middle"></i>حذف</a>


                </div>
            </div>
        </td>
    </tr>

    @endif
    @endforeach



</tbody>
</table>



</div>
<div class="paginate">
{{ $images->links() }}
</div>

</div> <!-- end .mt-3-->

</div>
<!-- end inbox-rightbar-->

<div class="clearfix"></div>
</div>
</div>






<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

@endsection




@section('CustomJs')

@include('admin.media.multimedia.inc.scripts')





@endsection










