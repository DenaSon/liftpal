@extends('admin.panel.layouts.master')
@section('page-title','افزودن صفحه ')
@section('CustomCss')

    <script src="//cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script>


    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

@endsection
@section('content')
    @include('admin.store.products.inc._errors')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3"> اطلاعات صفحه </h5>

                    <form method="post" enctype="multipart/form-data" id="myForm"
                          action="{{ route('page.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="post-title" class="form-label">عنوان  <span
                                    class="text-danger">*</span></label>
                            <input value="{{ old('title') }}" name="title" type="text" id="post-title"
                                   class="form-control" placeholder="عنوان صفحه">
                        </div>

                        <div class="mb-3">
                            <label for="post-description" class="form-label">توضیحات <span
                                    class="text-danger">*</span></label>

                            <textarea required name="details" id="editor1" rows="10"
                                      cols="80"> {{ old('details','') }} </textarea>

                            <!-- end Snow-editor-->
                        </div>



                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-lg-4">

            <div class="card">



            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2"> وضعیت </h5>


                    <div class="mb-3">
                        <label class="mb-2 visually-hidden"> <span class="text-danger visually-hidden">*</span></label>
                        <br/>
                        <div class="radio form-check-inline form-check mb-2 form-check-success">
                            <input type="radio" id="publish" value="published" name="status"
                                   class="form-check-input" {{ old('status') == 'published' ? 'checked' : '' }} checked>
                            <label for="publish" class="form-check-label"> انتشار </label>
                        </div>
                        <div class="radio form-check-inline form-check mb-2 form-check-warning">
                            <input type="radio" id="draft" value="draft" name="status"
                                   class="form-check-input" {{ old('status') == 'draft' ? 'checked' : '' }}>
                            <label for="draft" class="form-check-label"> پیش نویس </label>
                        </div>

                    <hr>
                        <div class="radio form-check-inline form-check mb-2 form-check-info">
                            <input type="checkbox" id="footer_page"  name="footer_page"
                                   class="form-check-input" {{ old('footer_page') == '1' ? 'checked' : '' }}>
                            <label for="footer_page" class="form-check-label">
                            صفحه فوتر
                            </label>
                        </div>


                    </div>


                </div>


            </div>


        </div>


    </div>

    <!-- end col-->
    </div>


    <div class="row">
        <div class="col-12">
            <div class="text-right mb-3">

                <button id="validator" type="button" class="btn w-25 btn-info waves-effect waves-light"> بررسی ورودی
                    ها
                </button>
                <button id="submit" type="submit" class="btn w-25 btn-success waves-effect waves-light">ثبت مقاله

                </button>
                <button id='resetButton' type="reset" class="btn w-sm btn-danger waves-effect waves-light">بازنویسی
                </button>

            </div>
        </div>
        <!-- end col -->
    </div>

    </form>


    </div>

@endsection

@section('CustomJs')


    @include('admin.page.inc._scripts2')

@endsection










