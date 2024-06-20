@extends('admin.panel.layouts.master')
@section('page-title', 'مدیریت موجودی : محصول : '. $product->name . ' - '. $product->sku)
@section('CustomCss')

<script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
<script src="{{ asset('admin/assets/js/jalalidatepicker.min.js') }}"></script>

<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>


<link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
type="text/css"/>
<link href="{{ asset('admin/assets/css/jalalidatepicker.min.css') }}" rel="stylesheet" type="text/css"/>
@include('admin.store.products.inc._errors')
@endsection
@section('content')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="row align-content-center">
<div class="col-md-8 mx-auto">

    <form method="post" action="{{ route('batch.store',['id' => $product->id]) }}">
<div class="card">
    <div class="card-body">

            @csrf

            <div id="progressbarwizard">

                <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                    <li class="nav-item">
                        <a href="#account-2" data-bs-toggle="tab" data-toggle="tab"
                           class="nav-link rounded-0 pt-2 pb-2 @if($product->batches->isEmpty()) active @endif">
                            <i class="mdi mdi-stocking me-1"></i>
                            <span class="d-none d-sm-inline">موجودی و موقعیت</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile-tab-2" data-bs-toggle="tab" data-toggle="tab"
                           class="nav-link rounded-0 pt-2 pb-2">
                            <i class="mdi mdi-clock-outline me-1"></i>
                            <span class="d-none d-sm-inline">زمان و قیمت</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#finish-2" data-bs-toggle="tab" data-toggle="tab"
                           class="nav-link rounded-0 pt-2 pb-2">
                            <i class="mdi mdi-information-outline me-1"></i>
                            <span class="d-none d-sm-inline">اطلاعات فنی</span>
                        </a>
                    </li>

                    @if($product->batches->isNotEmpty())

                        <li class="nav-item active">
                            <a href="#batch" data-bs-toggle="tab" data-toggle="tab"
                               class="nav-link rounded-0 pt-2 pb-2 active">
                                <i class="mdi mdi-group me-1"></i>
                                <span class="d-none d-sm-inline"> دسته ها </span>
                            </a>
                        </li>

                    @endif


                </ul>

                <div class="tab-content b-0 mb-0 pt-0">

                    <div class="tab-pane @if( $product->batches->isEmpty() ) active  @endif" id="account-2">
                        <div class="row">
                            <div class="col-12">

                        @if($product->types->isNotEmpty() )
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="product-types">
                                        نوع
                                        <span class="text-danger">*</span>

                                    </label>
                                    <div class="col-md-9">
                                    <select id="product-types" class="form-select js-example-basic-single-types" name="type_id" required>


                                        @foreach($product->types as $type)
                                            <option value="{{ $type->id }}" selected>
                                                {{ $type->name }}
                                            </option>

                                        @endforeach

                                    </select>
                                    </div>

                                </div>
                                @endif



                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="quantity">
                                        موجودی
                                        <span class="text-danger">*</span>
                                        <span class="text-primary font-11">( {{ $product->unit }} )  </span>
                                    </label>
                                    <input name="unit" type="hidden" value="{{ $product->unit }}">

                                    <div class="col-md-9">
                                        <input min="0" type="number" class="form-control" id="quantity"
                                               name="quantity" value="{{ old('quantity') }}"
                                               placeholder="موجودی اولیه">
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="reorder_level"> هشدار
                                        <span class="font-12"> سفارش مجدد </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input min="0" type="number" class="form-control" id="reorder_level"
                                               name="reorder_level" value="{{ old('reorder_level') }}" placeholder="تعداد موجودی">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="expire_alert"> هشدار
                                        <span class="font-12"> تاریخ انقضاء </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input min="0" type="number" class="form-control" id="expire_alert"
                                               name="expire_alert" value="{{ old('expire_alert') }}" placeholder="تعداد روز">
                                    </div>
                                </div>


                                <hr/>


                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="location_code"> کد
                                        موقعیت </label>
                                    <div class="col-md-9">
                                        <input dir="ltr" type="number" class="form-control"
                                               id="location_code" name="location_code"
                                               value="{{ old('location_code') }}">
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="location"> موقعیت
                                        انبار </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="location"
                                               name="location" value="{{ old('location') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="section"> بخش </label>
                                    <div class="col-md-9">

                                        <select name="section"
                                                class="form-select js-example-basic-single-sections"
                                                id="section">

                                            <option value="دندان پزشکی">دندان پزشکی</option>
                                            <option value="عمومی">عمومی</option>
                                        </select>


                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="shelf"> قفسه </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="shelf" name="shelf"
                                               value="{{ old('shelf') }}">
                                    </div>
                                </div>


                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>

                    <div class="tab-pane" id="profile-tab-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="entry_date">تاریخ ورود به
                                        انبار </label>
                                    <div class="col-md-9">
                                        <input value="{{ old('entry_date') }}" dir="ltr" readonly data-jdp type="text" class="form-control"
                                               id="entry_date"
                                               name="entry_date">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="expire_date"> تاریخ انقضاء
                                        کالا
                                        <span class="text-danger">*</span> </label>
                                    <div class="col-md-9">
                                        <input value="{{ old('expire_date') }}" dir="ltr" readonly data-jdp type="text" class="form-control"
                                               id="expire_date"
                                               name="expire_date">
                                    </div>
                                </div>


                                <hr>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="cost_price">
                                        قیمت خرید
                                        <span class="text-primary font-11">( تومان )  </span> <span
                                            class="text-danger">*</span>

                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" id="cost_price"
                                               name="cost_price" value="{{old('cost_price')}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="sale_price">

                                        قیمت فروش
                                        <span class="text-primary font-11"> ( تومان )  </span> <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" id="sale_price"
                                               name="sale_price" value=" {{ old('sale_price') }}">
                                    </div>
                                </div>


                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>

                    <div class="tab-pane" id="finish-2">
                        <div class="row">
                            <div class="col-12">


                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="fda_license_number">

                                        شماره مجوز
                                        <span class="text-primary font-11">( FDA )  </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input dir="ltr" type="text" class="form-control" id="sale_price"
                                               name="fda_license_number" value=" {{ old('fda_license_number') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="drug_identification_number">

                                        شماره شناسایی دارویی
                                        <span class="text-primary font-11">( DIN )  </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input dir="ltr" type="text" class="form-control"
                                               id="drug_identification_number" name="din" value="{{ old('drug_identification_number') }}">
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="standard_type">
                                        نوع استاندارد
                                        <span class="text-primary font-11">( ISO 9000 )  </span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="standard_type"
                                                class="form-select js-example-basic-single-standards"
                                                id="standard_type">
                                            <option value=""></option>
                                            <option value="ISO9000"> ISO9000</option>
                                            <option value="ISO13485">ISO13485</option>
                                            <option value="ISO14971"> ISO14971</option>
                                            <option value="ISO60601"> ISO60601</option>
                                            <option value="ISO9008"> ISO9008</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="country">

                                        کشور سازنده

                                    </label>
                                    <div class="col-md-9">

                                        <select name="country"
                                                class="form-select js-example-basic-single-country"
                                                id="country">
                                            <option value=""></option>
                                            @include('admin.inventory.batch.inc.country_list')

                                        </select>


                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="product-supplier"> تامین
                                        کننده
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select id="product-supplier"
                                                class="js-example-basic-single-suppliers form-control select2"
                                                name="supplier">
                                            @foreach($suppliers as $supplier)
                                                <option value=""></option>
                                                <option
                                                    value="{{ $supplier->name }}">
                                                    {{ $supplier->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="consumption_type">

                                        نوع استفاده

                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="consumption_type"
                                               name="consumption_type" value="{{ old('consumption_type') }}">
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="approval_status">
                                        وضعیت تایید
                                    </label>
                                    <div class="col-md-9">
                                        <select name="approval_status" class="form-select"
                                                id="approval_status">
                                            <option value="approved"> تایید شده</option>
                                            <option value="review"> در حال بررسی</option>
                                            <option value="pending"> در انتظار تایید</option>
                                            <option value="cancelled"> لغو شده</option>
                                        </select>
                                    </div>
                                </div>


                            </div> <!-- end col -->


                        </div> <!-- end row -->


                    </div>

                    @if( $product->batches->isNotEmpty() )

                        @include('admin.inventory.batch.batch_list')

                    @endif


                <div class="d-flex justify-content-center m-2">
                    <button type="submit" class="btn btn-outline-primary">
                        <span class="mdi mdi-content-save-outline "></span> ذخیره اطلاعات
                    </button>
                    @if( $product->batches->isNotEmpty() )

                    <a class="btn btn-outline-info ms-2 me-2" href="{{ route('singleProduct',['product'=>$product,'slug'=>slugMaker($product->name)]) }}" target="_blank"> مشاهده محصول </a>
                    @endif
                </div>


                </div> <!-- tab-content -->


            </div> <!-- end #progressbarwizard-->



    </div> <!-- end card-body -->
</div>
    </form>

</div>
<!-- end col -->
</div>
<!-- end row -->





<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

@endsection

@section('CustomJs')

    <script>

        var options = {
            time: true,
            hasSecond: false,
            separatorChars: {
                date: '-',
                time: ':',
                dateTime: ' ',

            }


        };
        jalaliDatepicker.startWatch(options);

    </script>
@include('admin.inventory.batch.inc._scripts')


@endsection










