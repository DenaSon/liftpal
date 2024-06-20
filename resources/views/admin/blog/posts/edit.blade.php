@extends('admin.panel.layouts.master')
@section('page-title','ویرایش مقاله ')
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
                          action="{{ route('posts.update',$post->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="post-title" class="form-label">عنوان <span
                                    class="text-danger">*</span></label>
                            <input value="{{ old('title',$post->title) }}" name="title" type="text" id="post-title"
                                   class="form-control" placeholder="عنوان مقاله">
                        </div>

                        <div class="mb-3">
                            <label for="post-description" class="form-label">توضیحات <span
                                    class="text-danger">*</span></label>

                            <textarea required name="details" id="editor1" rows="10"
                                      cols="80"> {{ old('details',$post->content) }} </textarea>

                            <!-- end Snow-editor-->
                        </div>

                        <div class="mb-3">
                            <label for="post-summary" class="form-label"> خلاصه معرفی مقاله </label>
                            <textarea maxlength="155"  name="description"
                                      class="form-control" id="post-summary"
                                      rows="2" placeholder="توصیف جذابی که محتوای مهم را انتقال دهد">{{ old('description',$post->description) }}</textarea>
                        </div>


                        <div class="mb-3">
                            <label for="product-category" class="form-label">دسته <span
                                    class="text-danger">*</span></label>
                            <select id="product-category" class="js-example-basic-multiple" name="categories[]"
                                    multiple="multiple">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $post->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="product-tags" class="form-label"> برچسب ها <span
                                    class="text-danger">*</span></label>
                            <select id="product-tags" class="js-example-basic-multiple-tags form-control select2" name="tags[]" multiple="multiple">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->name }}" {{ in_array($tag->name, old('tags', $post->tags->pluck('name')->toArray())) ? 'selected' : '' }}>
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


                    <div class="d-flex justify-content-center">
                        <div class="row row-cols-1 row-cols-md-3 g-2 mt-1 row-cols-sm-2">
                            @foreach($post->images as $index => $image)
                                <div class="col position-relative">
                                    <div class="border p-0 custom-image-container">
                                        <img src="{{ asset($image->file_path) }}" alt="Thumbnail" class="img-fluid custom-image-thumb" id="{{ $image->id }}">
                                        <div class="custom-image-caption">
                                            نمایش تصویر {{ $index+1 }} <!-- Display the caption here -->
                                        </div>
                                        <button type="button" class="btn btn-danger btn-remove" data-image-id="{{ $image->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="imageModalLabel">  نمایش تصویر : </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                                    <hr/>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="" id="modalImage" class="img-fluid">
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
                        <label class="mb-2">وضعیت <span class="text-danger">*</span></label>
                        <br/>
                        <div class="radio form-check-inline form-check mb-2 form-check-success">
                            <input type="radio" id="publish" value="published" name="status"
                                   class="form-check-input" {{ $post->is_active == 1 ? 'checked' : '' }} checked>
                            <label for="publish" class="form-check-label"> انتشار </label>
                        </div>
                        <div class="radio form-check-inline form-check mb-2 form-check-warning">
                            <input type="radio" id="draft" value="draft" name="status"
                                   class="form-check-input" {{ $post->is_active == 0 ? 'checked' : ''  }}>
                            <label for="draft" class="form-check-label"> پیش نویس </label>
                        </div>
                    </div>

                    <hr>


                    <div class="mb-3">
                        <label class="mb-2">یادداشت <span class="text-warning">+</span></label>
                        <div class="form-floating">

                    <textarea name="note" class="form-control" placeholder="یادداشت "
                              id="floatingTextarea2" style="height: 100px;">{{ old('note',$post->additional_info) }}</textarea>

                            <label for="floatingTextarea2">یادداشت مقاله</label>
                        </div>
                    </div>


                    <div class="form-check float-start">
                        <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1" {{ $post->is_featured == 1 ? 'checked' : ''  }}>
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


@if($post->comments->first()->id ?? null != null)
<div class="card col-md-6">
<!-- ... (other card content) ... -->
<div class="card-body">
<div class="card-widgets">
    <a data-bs-toggle="collapse" href="#cardCollapse4" role="button" aria-expanded="true" aria-controls="cardCollapse4"><i class="mdi mdi-minus"></i></a>
    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
</div>
<h4 class="header-title mb-3">دیدگاه‌های محصول</h4>
<div id="cardCollapse4" class="pt-3 collapse show">
    <div class="table-responsive">

        <ul class="list-group">
            <!-- Example comment item -->
            @foreach($post->comments->take(30) as $comment)
                <li class="list-group-item  @if($comment->status == 'published') border-success @else border-warning bg-soft-warning @endif shadow-sm " data-comment-id="{{ $comment->id }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-1">{{ $comment->username }} میگه :</h5>

                        @if($comment->status == 'published')
                            <small class="badge badge-outline-success status"> تایید شده </small>
                        @else
                            <small class="badge badge-outline-warning status">  در انتظار </small>
                        @endif

                    </div>
                    <p class="p-1 my-custom-comment-style font-12 overflow-auto">{{ $comment->text }}</p>

                    <!-- Add reply form for each comment -->
                    <form class="mt-3">
                        <div class="mb-3">
                            <label for="replyText" class="form-label">پاسخ به دیدگاه:</label>
                            <textarea maxlength="254" class="form-control" id="replyText" rows="3" data-comment-id="{{ $comment->id }}"> {{ $comment->reply }} </textarea>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm me-2 btn-reply">ثبت پاسخ</button>
                        @if($comment->status == 'published')
                            <button type="button" class="btn btn-outline-warning btn-sm me-2 btn-confirm">رد دیدگاه</button>
                        @else
                            <button type="button" class="btn btn-outline-info btn-sm me-2 btn-confirm">تایید دیدگاه</button>
                        @endif
                        <button id="btn-delete-comment" class="btn btn-outline-danger btn-sm me-2 btn-delete-comment">حذف</button>
                        <small class="text-muted float-end">تاریخ: {{ jdate($comment->created_at)->toFormattedDateString() }}</small>
                    </form>
                </li>
                <br/>
            @endforeach
            <!-- Repeat for other comments -->
        </ul>
    </div> <!-- .table-responsive -->
</div> <!-- end collapse -->
</div>
</div>
@endif

</div>
        <!-- end col -->
    </div>

    </form>


    </div>

@endsection

@section('CustomJs')


    @include('admin.blog.posts.inc._scripts2')
    @include('admin.blog.posts.inc._edit_script')

@endsection










