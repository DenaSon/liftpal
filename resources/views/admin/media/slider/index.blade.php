@extends('admin.panel.layouts.master')
@section('page-title','لیست اسلایدرها ')
@section('CustomCss')

<link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>



@include('admin.store.products.inc._errors')
@endsection
@section('content')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
@include('admin.media.slider.inc._create')
<div class="row">
<div class="col-sm-12">
<div class="card">
    <div class="card-body">
        <div class="table-responsive">


            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width:50px">شماره</th>
                    <th>عنوان</th>
                    <th>کد دسترسی</th>
                    <th>وضعیت</th>
                    <th>اقدامات</th>

                </tr>
                </thead>

                <tbody>





                @foreach($sliders as $slider)

                    <tr>
                        <td> {{ $slider->id }} </td>
                        <td> {{ $slider->caption }} </td>
                        <td> {{ $slider->name }} </td>
                        <td> @if($slider->status == 'active') فعال @endif @if($slider->status == 'inactive') غیرفعال @endif </td>
                        <td>
                            <form class="form-inline" method="post" action="{{ route('slider.destroy', ['slider' => $slider->id]) }}" id="deleteform-{{ $slider->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $slider->id }})" type="button">
                                    <span class="fe-trash-2"></span>
                                </button>
                                <a id="btn-delete-{{ $slider->id }}" class="btn btn-outline-primary btn-sm" href="{{ route('slider.edit', ['slider' => $slider->id]) }}">
                                    <span class="fe-folder-plus"></span>
                                </a>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </table>


        </div>


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            ایجاد اسلایدر جدید
        </button>


        <div class="paginate">


            {{ $sliders->links() }}


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

@include('admin.media.slider.inc._scripts')


@endsection

