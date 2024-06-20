@extends('admin.panel.layouts.master')
@section('page-title','تنظیمات اسلایدر')
@section('CustomCss')

    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>



    @include('admin.store.products.inc._errors')
@endsection
@section('content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <div class="row">

        <div class="col-4">
            <div class="card">
                <h5 class="card-header"> ویرایش اسلایدر
                <span class="text-muted"> {{ $slider->caption }} </span>   <small class="text-muted"> {{ $slider->name }} </small>
                </h5>
                <div class="card-body">

                    <form  enctype="multipart/form-data" class="" method="post" action="{{ route('slider.update',['slider' =>$slider->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile01"></label>
                            <input type="file" class="form-control" id="inputGroupFile01" name="slider">
                        </div>


                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGrouplink">لینک</label>
                            <input dir="ltr" maxlength="190" type="url" class="form-control" id="inputGrouplink" name="link">
                        </div>






<div class="mb-3">

            <div class="container overflow-hidden">
                <h5 class="title"> تنظیمات اسلایدر </h5>
                <hr/>
        <div class="row gx-12">
            <div class="col">

                <div class="form-check form-switch mb-2">
                    <input value="active" class="form-check-input" type="checkbox" role="switch" id="statusx" @if($slider->status =='active') checked @endif name="statusx">
                    <label class="form-check-label" for="statusx">فعال سازی اسلایدر</label>
                </div>

                <div class="form-check form-switch mb-2">
                    <input value="1" class="form-check-input" type="checkbox" role="switch" id="cycle"     @if($slider->cycle == 'true') checked @endif name="cycle">
                    <label class="form-check-label" for="cycle">چرخش خودکار به ابتدا</label>
                </div>

                <div class="form-check form-switch mb-2">
                    <input value="1" class="form-check-input" type="checkbox" role="switch" id="autoplay"  @if($slider->autoplay =='carousel') checked @endif name="autoplay">
                    <label class="form-check-label" for="autoplay">چرخش خودکار اسلایدر</label>
                </div>

                <div class="form-check form-switch mb-2">
                    <input value="1" class="form-check-input" type="checkbox" role="switch" id="touch"  @if($slider->touch == 'true') checked @endif name="touch">
                    <label class="form-check-label" for="touch">نمایشگر لمسی</label>
                </div>

                <div class="form-check form-switch mb-2">
                    <input value="1" class="form-check-input" type="checkbox" role="switch" id="hover" @if($slider->hover == 1) checked @endif name="hover">
                    <label class="form-check-label" for="hover">توقف با رویداد Mouse Hover</label>
                </div>

                <div class="form-check form-switch mb-2">
                    <input value="1" class="form-check-input" type="checkbox" role="switch" id="indicators" @if($slider->indicators == 1) checked @endif name="indicator">
                    <label class="form-check-label" for="indicators"> نمایش کنترل کننده ها </label>
                </div>

                <div class="mb-2">
                    <label class="form-label" for="interval"> بازه زمانی تغییر اسلاید </label>
                    <input value="{{ $slider->autoplay_interval }}" class="form-control form-control-sm w-25" type="number"  id="interval" checked name="interval" title="میلی ثانیه">

                </div>



            </div>

                    </div>
                </div>


        </div>

                        <div class="input-group mb-3 text-left">

                            <button type="submit" class="btn btn-soft-primary w-100"> ذخیره  </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>





        <div class="col-7">
            <div class="card">
                <h5 class="card-header"> پیش نمایش </h5>
                <div class="card-body">


                    @include('admin.media.slider.inc._preview')


                </div>
            </div>


                @if($slider->images->count() > 1 )
            <div class="card">
                <div class="card-body">


    <div class="row row-cols-1 row-cols-md-5 g-2 mt-1 row-cols-sm-2">
        @foreach( $slider->images as $index => $image )
        <div class="col position-relative">
            <div class="border p-0 custom-image-container">


                <img src="{{ asset($image->file_path) }}" alt="Thumbnail" class="img-thumbnail custom-image-thumb" id="{{ $image->id }}">

                <div class="custom-image-caption">
                      اسلاید شماره   {{ $index + 1 }}<!-- Display the caption here -->
                </div>
                <button type="button" class="btn btn-danger btn-remove" data-image-id="{{ $image->id }}">
                    <i class="fas fa-trash"></i>
                </button>


            </div>
        </div>

        @endforeach
     </div>



                </div>
            </div>

            @endif





        </div> <!-- end col -->


    </div>


    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

@endsection




@section('CustomJs')

@include('admin.media.slider.inc._scripts')


@endsection
