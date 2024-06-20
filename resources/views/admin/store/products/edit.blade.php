        @extends('admin.panel.layouts.master')
        @section('page-title','ویرایش محصول'.' '. $product->name)
        @section('CustomCss')

        <script src="{{ asset('vendor/ckstandard/ckeditor.js') }}"></script>


        <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>
        <script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>

        @endsection
        @section('content')
        @include('admin.store.products.inc._errors')
        <form  enctype="multipart/form-data" id="myForm" method="post"  action="{{ route('products.update',$product->id) }}">

        @csrf
        @method('PUT')
        <div class="row">
        <div class="col-lg-8">
        <div class="card">
        <div class="card-body">
        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3"> اطلاعات محصول </h5>

        <div class="mb-3">
            <label for="product-name" class="form-label">نام محصول <span
                    class="text-danger">*</span></label>
            <input value="{{ old('name',$product->name) }}" name="name" type="text" id="product-name"
                   class="form-control" placeholder="نام محصول و مدل">
        </div>

        <div class="mb-3">
            <label for="product-description" class="form-label">توضیحات <span
                    class="text-danger">*</span></label>

            <textarea required name="details" id="editor1" rows="10"
                      cols="80"> {{ old('details',$product->details) }} </textarea>


            <!-- end Snow-editor-->
        </div>

        <div class="mb-3">
            <label for="product-summary" class="form-label"> خلاصه معرفی محصول </label>
            <textarea maxlength="155"  name="description"
                      class="form-control" id="product-summary"
                      rows="2" placeholder="توصیف جذابی که محتوای مهم را انتقال دهد"> {{ trim(old('description',$product->description)) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="product-brand" class="form-label"> برند محصول <span class="text-danger">*</span></label>
            <select id="product-brand" class="js-example-basic-single form-control select2"
                    name="brand">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>

                    {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>



        <div class="mb-3">
            <label for="product-tags" class="form-label"> برچسب ها <span
                    class="text-danger">*</span></label>
            <select id="product-tags" class="js-example-basic-multiple-tags form-control select2" name="tags[]" multiple="multiple">
                @foreach($tags as $tag)
                    <option value="{{ $tag->name }}" {{ in_array($tag->name, old('tags', $product->tags->pluck('name')->toArray())) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>

        </div>

        <div class="row">


            <div class="col-md-5">

                <div class="card mt-1 shadow-lg">
                    <div class="card-body">
                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2"> دسته بندی  </h5>

        <div class="mb-3">
        <div class="" style="height: 450PX;overflow-y: scroll;scrollbar-face-color: #0a58ca">


            @foreach($categories->whereNull('parent_id') as $category)
                <ul class="tree-list">
                    <li>
                        <input class="form-check-input me-1" type="checkbox" name="categories[]" value="{{$category->id}}" id="id-{{$category->id}}" {{ $category->id }}" {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <label class="label" for="id-{{$category->id}}"> {{ $category->name }}</label>

                        @if($category->subcategories->count() > 0)
                            @foreach($category->subcategories as $subIndex => $subcategory)
                                <ul class="tree-list">
                                    <li>

                                        <input class="form-check-input me-1" type="checkbox" name="categories[]" value="{{$subcategory->id}}" id="id-{{$subcategory->id}}" {{ $subcategory->id }}" {{ in_array($subcategory->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        <label class="label" for="id-{{$subcategory->id}}"> {{ $subcategory->name }}</label>

                                        @if($subcategory->subcategories->count() > 0)
                                            @foreach($subcategory->subcategories as $subIndexInner => $innerSubcategory)
                                                <ul class="tree-list">
                                                    <li>
                                                        <input class="form-check-input me-1" type="checkbox" name="categories[]" value="{{$innerSubcategory->id}}" id="id-{{$innerSubcategory->id}}" {{ $innerSubcategory->id }}" {{ in_array($innerSubcategory->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                        <label class="label" for="id-{{$innerSubcategory->id}}"> {{ $innerSubcategory->name }}</label>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        @endif
                                    </li>
                                </ul>
                            @endforeach
                        @endif
                    </li>
                </ul>
            @endforeach



                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-7">

                <div class="mb-3">

                    <div class="card shadow-lg">

                        <div class="card-body">
                            <h5 class="text-uppercase mt-0 mb-3 bg-light p-2"> ویژگی های محصول </h5>
                            <div id="attributeContainer" class="">
                                <div class="attribute-row">
                                    <div class="form-group">
                                        <button type="button" id="addAttributeButton" class="mb-3 waves-effect waves-light btn btn-outline-info w-100 h-25 btn-sm" > افزودن ویژگی </button>

                                        <br>

                                        <div class="" style="overflow-y: scroll;height: 435px;" id="newfeatures">

                                        @foreach($properties as $index => $property)
                                            <div class="attribute-row form-group">
                                                <small> ویژگی شماره :  </small><b>{{ $index +1 }}</b> <br/>
                                                <input value="{{ $property->name }}" class="p-1 m-2 w-75"  type="text" name="attributeName[]">
                                                <input value="{{ $property->value }}" class="p-1 m-2 w-75" type="text" name="attributeValue[]">
                                                <button  type="button" class="waves-effect waves-light m-2 p-1 btn btn-md btn-outline-pink remove-attribute">حذف</button>
                                            </div>
                                        @endforeach

                                        <input type="hidden" id="attributeCounter" name="attributeCounter" value="0">

                                        </div>

                                    </div>
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


        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2"> اطلاعات  </h5>




        <div class="mb-3">

        <label class="form-label" for="product-discount"> تخفیف %</label>

        <input name="discount" type="number" step="1" min="0" max="100" class="form-control"
               id="product-discount" placeholder="%"
               value="{{ old('discount',$product->discount) }}">
        </div>



        <div class="mb-3">
        <label class="form-label" for="product-unit"> واحد <span class="text-danger">*</span></label>
        <input name="unit" type="text" class="form-control" id="product-unit"
               placeholder="گرم | تعداد | عدد | بسته ..." value="{{ old('unit',$product->unit ?? "") }}">
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


        <div class="row row-cols-1 row-cols-md-3 g-2 mt-1 row-cols-sm-2">
            @foreach($product->images as $index => $image)
                <div class="col position-relative">
                    <div class="border p-0 custom-image-container">


                            <img src="{{ asset($image->file_path) }}" alt="Thumbnail" class="img-thumbnail custom-image-thumb" id="{{ $image->id }}">

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

        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
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

                                @foreach($types as $index => $type)
                                    <div class="option-row form-group" id="row-{{$type->id}}">
                                        <small> گزینه شماره  :  </small><b>{{ $index +1 }}</b> <br/>
                                        <input value="{{ $type->name }}" class="p-1 m-2 w-75"  type="text" name="optionname">
                                        <input value="{{ $type->price }}" class="p-1 m-2 w-75" type="text" name="optionprice">
                                        <div class="clearfix"></div>
                                        <button data-value="{{$type->id}}"  type="button" class="waves-effect waves-light m-2 p-1 btn btn-xs btn-outline-pink remove-type">
                                            حذف
                                        </button>
                                        <button data-value="{{$type->id}}" type="button" class="waves-effect waves-light m-2 p-1 btn btn-xs btn-outline-secondary edit-type">
                                           ثبت تغییرات
                                        </button>
                                   <hr>
                                    </div>
                                @endforeach

                                <div class="" id = 'newoptions'>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>










        <div class="card">
        <div class="card-body">
        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2"> وضعیت نمایش </h5>


        <div class="mb-3">

        <br/>
        <div class="radio form-check-inline form-check mb-2 form-check-success">
            <input type="radio" id="publish" value="published" name="status"
                   class="form-check-input" {{ $product->is_active == 1 ? 'checked' : '' }} checked>
            <label for="publish" class="form-check-label"> انتشار </label>
        </div>
        <div class="radio form-check-inline form-check mb-2 form-check-warning">
            <input type="radio" id="draft" value="draft" name="status"
                   class="form-check-input" {{ $product->is_active == 0 ? 'checked' : ''  }}>
            <label for="draft" class="form-check-label"> پیش نویس </label>
        </div>
        </div>

        <hr>


        <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input" id="customSwitch1" name="is_featured" value="1" @if($product->is_featured == 1) checked @endif>
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
        <script> let usePutRequest = true; </script>

        <button id="validatorEdit" type="button" class="btn w-25 btn-info waves-effect waves-light"> بررسی ورودی
        ها
        </button>
        <button id="submit" type="submit" class="btn w-25 btn-success waves-effect waves-light">ثبت محصول
        </button>
        <button onclick="window.location.href='{{ route('dashboard') }}' " id='cancel' type="reset" class="btn w-sm btn-danger waves-effect waves-light">لغو
        </button>

        </div>

        <hr>


        @if($product->comments->first()->id ?? null != null)
            @include('admin.store.products.inc._comments')
        @endif

        </div>
        <!-- end col -->
        </div>

        </form>




        @endsection

        @section('CustomJs')

        @include('admin.store.products.inc._edit_script')
        @include('admin.store.products.inc._comments_script')

        @endsection


