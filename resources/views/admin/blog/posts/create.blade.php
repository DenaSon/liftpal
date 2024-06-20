@extends('admin.panel.layouts.master')
@section('page-title','افزودن مقاله ')
@section('CustomCss')

    <script src="{{ asset('vendor/ckstandard/ckeditor.js') }}"></script>


    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

@endsection
@section('content')
    @include('admin.store.products.inc._errors')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3"> اطلاعات مقاله </h5>

                    <form method="post" enctype="multipart/form-data" id="myForm"
                          action="{{ route('posts.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="post-title" class="form-label">عنوان <span
                                    class="text-danger">*</span></label>
                            <input value="{{ old('title') }}" name="title" type="text" id="post-title"
                                   class="form-control" placeholder="عنوان مقاله">
                        </div>

                        <div class="mb-3">
                            <label for="post-description" class="form-label">توضیحات <span
                                    class="text-danger">*</span></label>

                            <textarea required name="details" id="editor1" rows="10"
                                      cols="80"> {{ old('details','') }} </textarea>

                            <!-- end Snow-editor-->
                        </div>

                        <div class="mb-3">
                            <label for="post-summary" class="form-label"> خلاصه معرفی مقاله </label>
                            <textarea maxlength="155"  name="description"
                                      class="form-control" id="post-summary"
                                      rows="2" placeholder="توصیف جذابی که محتوای مهم را انتقال دهد">{{ old('description','') }}</textarea>
                        </div>


                        <div class="mb-3">
                            <label for="post-category" class="form-label">دسته <span
                                    class="text-danger">*</span></label>
                            <select id="post-category" class="js-example-basic-multiple" name="categories[]"
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
                            <label for="post-tags" class="form-label"> برچسب ها <span
                                    class="text-danger">*</span></label>
                            <select id="post-tags" class="js-example-basic-multiple-tags form-control select2"
                                    name="tags[]" multiple="multiple">
                                @foreach($tags as $tag)
                                    <option
                                        value="{{ $tag->name }}" {{ in_array($tag->name, old('tags', [])) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>


                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-lg-4">

            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2"> تصویر شاخص </h5>


                    <div class="custom-file">
                        <div class="input-group">

                            <input type="file" class="dropzone" id="myDropzone" name="image"
                                   accept="image/*" style="width: inherit !important; ">

                        </div>

                    </div>
                </div>


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
                    </div>

                    <hr>


                    <div class="mb-3">
                        <label class="mb-2">یادداشت <span class="text-warning">+</span></label>
                        <div class="form-floating">

                    <textarea name="note" class="form-control" placeholder="یادداشت "
                              id="floatingTextarea2" style="height: 100px;">{{ old('note','') }}</textarea>

                            <label for="floatingTextarea2">یادداشت مقاله</label>
                        </div>
                    </div>


                    <div class="form-check float-start">
                        <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1">
                        <label class="form-check-label" for="featured">
                           مقاله ویژه
                        </label>
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


    @include('admin.blog.posts.inc._scripts2')

@endsection










