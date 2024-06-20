@extends('admin.panel.layouts.master')
@section('page-title','افزودن محصول ')
@section('CustomCss')

    <script src="{{ asset('vendor/ckstandard/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jalalidatepicker.min.js') }}"></script>

    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>


    <link href="{{ asset('admin/assets/css/jalalidatepicker.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    @include('admin.store.products.inc._errors')
    <form method="post" enctype="multipart/form-data" id="myForm"
          action="{{ route('products.store') }}">
        @csrf

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3"> اطلاعات محصول </h5>



                        <div class="mb-3">
                            <label for="product-name" class="form-label">نام محصول <span
                                    class="text-danger">*</span></label>
                            <input value="{{ old('name') }}" name="name" type="text" id="product-name"
                                   class="form-control" placeholder="نام محصول و مدل">
                        </div>

                        <div class="mb-3">
                            <label for="product-description" class="form-label">توضیحات <span
                                    class="text-danger">*</span></label>
                            <label class="visually-hidden" for="editor1"></label>

                            <textarea required name="details" id="editor1" rows="10"
                                      cols="80"> {{ old('details','') }} </textarea>


                            <!-- end Snow-editor-->
                        </div>

                        <div class="mb-3">
                            <label for="product-summary" class="form-label"> خلاصه معرفی محصول </label>
                            <textarea maxlength="155"  name="description"
                                      class="form-control" id="product-summary"
                                      rows="2" placeholder="توصیف جذابی که محتوای مهم را انتقال دهد">{{ old('description','') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="product-brand" class="form-label"> برند محصول <span class="text-danger">*</span></label>
                            <select id="product-brand" class="js-example-basic-single form-control select2"
                                    name="brand">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="product-tags" class="form-label"> برچسب ها <span
                                    class="text-danger">*</span></label>
                            <select id="product-tags" class="js-example-basic-multiple-tags form-control select2"
                                    name="tags[]" multiple="multiple">
                                @foreach($tags as $tag)
                                    <option
                                        value="{{ $tag->name }}" {{ in_array($tag->name, old('tags', [])) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>



                    <div class="row">

                        <div class="col-md-5">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2"> دسته بندی  </h5>
                                    <div class="mb-3">
                                        <label class="visually-hidden" for="product-category"></label>
                                        <select id="product-category" class="js-example-basic-multiple" name="categories[]"
                                                multiple="multiple">
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <div class="" style="height: auto;overflow-y: scroll;scrollbar-face-color: #0a58ca">
                                            <ul class="list-group" id="product-subcategory">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-md-7">

                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2"> ویژگی های محصول  </h5>
                                    <div class="mb-3">


                                        <div id="attributeContainer" class="d-flex align-content-center">
                                            <button type="button" id="addAttributeButton"
                                                    class="waves-effect waves-light btn btn-outline-info w-100 btn-sm">افزودن
                                                ویژگی
                                            </button>

                                            <br/>
                                            <div class="attribute-row">
                                                <div class="form-group">

                                                    <input type="hidden" id="attributeCounter" name="attributeCounter"
                                                           value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div id="newfeatur" class="" style="height: auto;overflow-y: scroll;scrollbar-face-color: #0a58c0">

                                        <div class="" id = 'newfeatures'>

                                        </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">اطلاعات قیمت</h5>



                    <div class="mb-3">

                        <label class="form-label" for="product-discount"> تخفیف </label>

                        <input name="discount" type="number" step="0.01" min="0" max="100" class="form-control"
                               id="product-discount" placeholder="درصد تخفیف قیمت %"
                               value="{{ old('discount') }}">
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="product-unit"> واحد <span class="text-danger">*</span></label>
                        <input name="unit" type="text" class="form-control" id="product-unit"
                               placeholder="گرم | تعداد | عدد | بسته ..." value="{{ old('unit') }}">
                    </div>



                    <div class="mb-3 text-center">
                        <label class="text-danger" id="EndPrice"> <!--Show Final Price    --> </label>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">تصاویر محصول</h5>


                    <div class="custom-file">
                        <div class="input-group">

                            <input type="file" class="dropzone" id="myDropzone" name="images[]" multiple
                                   accept="image/*" style="width: inherit !important; ">

                        </div>

                    </div>
                </div>


            </div>

            <div class="col-md-12">

                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2"> گزینه های محصول  </h5>
                        <div class="mb-3">


                            <div id="optionContainer" class="d-flex align-content-center">
                                <button type="button" id="addOptionsButton"
                                        class="waves-effect waves-light btn btn-outline-primary w-100 btn-sm">افزودن
                                    گزینه
                                </button>

                                <br/>
                                <div class="option-row">
                                    <div class="form-group">

                                        <input type="hidden" id="optionCounter" name="optionCounter" value="0">

                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div id="newoption" class="" style="height: auto;overflow-y: scroll;scrollbar-face-color: #0a58c0">

                                <div class="" id = 'newoptions'>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2"> وضعیت </h5>


                    <div class="mb-3">

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
                    </div>

                    <hr>

                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="customSwitch1" name="is_featured" value="1">
                        <label class="form-check-label" for="customSwitch1"> محصول ویژه </label>
                    </div>


                </div>


            </div>


        </div>


    </div>

    <!-- end col-->



    <div class="row">
        <div class="col-12">
            <div class="text-right mb-3">

                <button id="validator" type="button" class="btn w-25 btn-primary waves-effect waves-light"> بررسی ورودی
                    ها
                </button>
                <button id="submit" type="submit" class="btn w-25 btn-success waves-effect waves-light">ثبت محصول
                </button>
                <button id='resetButton' type="reset" class="btn w-sm btn-danger waves-effect waves-light">بازنویسی
                </button>

            </div>
        </div>
        <!-- end col -->
    </div>

    </form>




@endsection

@section('CustomJs')

    @include('admin.store.products.inc._scripts')



@endsection










