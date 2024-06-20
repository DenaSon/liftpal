@extends('front.layouts.master')




@section('title')
    @if(request()->has('q'))
        {{ getSetting('website_title'). '-' .request()->query('q') }}
    @else

        @isset($categoryName) {{ ' خرید و قیمت '. $categoryName }}@endisset
        @isset($brandName) {{ ' خرید و قیمت '. $brandName }} @endisset
    @endif
@endsection
@section('meta')
@isset($categoryName)

    <meta name="description" content="{{ $categoryName }} خرید محصولات ">

@endisset
@isset($brandName)

    <meta name="description" content="{{ $brandName }} خرید محصولات برند">

@endisset
@endsection

@section('customCss')
    <link rel="stylesheet" href="{{ asset('front/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/product-customize.css') }}">

@endsection



@section('content')


    <!--=====================================
                    SHOP PART START
        =======================================-->
    <section class="inner-section shop-part">
        <div class="container">
            <div class="row content-reverse">

          <!-- PUT Filter Sidebar HERE -->
                @include('front.shop.products.inc._sidebar')

                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="top-filter">
                                <form method="get" action="?items={{ request()->query('items') }}" id="paginationForm">
                                <div class="filter-show">

                                    <label class="filter-label">نمایش :</label>

                                    <select class="form-select filter-select" name="items">
                                        <option value="1">12</option>
                                        <option value="2">24</option>
                                        <option value="3">36</option>
                                    </select>


                                </div>
                                </form>
                                <div class="filter-short">
                                    <label class="filter-label">مرتب براساس :</label>
                                    <select class="form-select filter-select">
                                        <option selected>پیش‌فرض</option>
                                        <option value="3">پرطرفدار</option>
                                        <option value="1">ویژه</option>
                                        <option value="2">توصیه</option>
                                    </select>
                                </div>
                            <!--    <div class="filter-action">
                                    <a href="shop-3column.html" title="Three Column"><i class="fas fa-th"></i></a>
                                    <a href="shop-2column.html" title="Two Column"><i class="fas fa-th-large"></i></a>
                                    <a href="shop-1column.html" class="active" title="One Column"><i class="fas fa-th-list"></i></a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4">


                        @foreach($products as $product)
                            @if($product->types->count() != 0)
                            <div class="col">
                                <div class="product-card product-card-main @if($product->batches->isEmpty()) product-disable @endif">
                                    <div class="product-media">
                                       @if($product->is_featured)
                                            <div class="product-label">
                                                <label class="label-text sale">ویژه</label>
                                            </div>
                                       @endif
                                        <button class="product-wish wish">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <a href="{{ route('singleProduct',['product' => $product,'slug' => slugMaker($product->name)]) }}"  class="product-image">
                                            @if($product->images->isNotEmpty())
                                                <img height="200" src="{{ asset($product->images->first()->file_path) }}" alt="product">
                                            @else
                                                <img src="{{ asset('path_to_default_image') }}" alt="default-image">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h6 class="product-name">
                                            <a  href="{{ route('singleProduct',['product' => $product,'slug' => slugMaker($product->name)]) }}">{{ $product->name }}</a>
                                        </h6>
                                        <h6 class="product-price product-price-main">
                                            @if($product->discount > 0)
                                                <span title="تخفیف" class="product-discount-label ms-2"> {{ round($product->discount) }}%</span>
                                            @endif
                                            <span> {{ number_format(round($product->types->first()->price ?? 0 - ( $product->types->first()->price ?? 0 * $product->discount / 100)))  }} تومان  </span>
                                        </h6>
                                        <a href="{{ route('singleProduct',['product' => $product,'slug' => slugMaker($product->name)]) }}" class="product-add product-add-main" title="مشاهده جزئیات و خرید">
                                            <i class="fas fa-shopping-basket"></i>
                                            <span>خرید</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach



                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bottom-paginate">
                                <p class="page-info">
                                    نمایش {{ (($products->currentPage() - 1) * $products->perPage()) + 1 }}
                                    تا {{ (($products->currentPage() - 1) * $products->perPage()) + $products->count() }}
                                    از {{ $products->total() }} نتیجه
                                </p>
                                <ul class="pagination">
                                    {{ $products->links() }}

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=====================================
                SHOP PART END
    =======================================-->





    @include('front.layouts.intro')

@endsection


@section('customJs')
    <script src="{{asset('front/assets/js/select2.min.js')}}"></script>





    @include('front.layouts.inc._validationErrors')

@endsection

