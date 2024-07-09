@extends('front.layouts.master')
@section('meta')

    <meta name="description" content="{{ getSetting('website_title') }} برندها  ">

@endsection

@section('title',getSetting('website_title'). '-'. 'برندها')

@section('customCss')
    <link rel="stylesheet" href="{{ asset('front/assets/css/product-details.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/single-customize.css') }}">

    <link rel="stylesheet" href="{{ asset('front/assets/css/brand-list.css') }}">
@endsection

@section('content')

    @include('front.shop.brand.inc.top-part-index')



    <section class="inner-section">
        <div class="container">

            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 isotope-items">

                @foreach($brands as $brand)
                    <div class="brand-wrap">
                        <div class="brand-media">
                            <img src="{{ asset($brand->images->first()->file_path ?? 'front/assets/images/brand/05.jpg') }}" alt="brand">
                            <div class="brand-overlay">
                                <a href="{{ route('indexByBrand',['brand' => $brand,'slug' => slugMaker($brand->name)]) }}"><i class="fas fa-link"></i></a>
                            </div>
                        </div>
                        <div class="brand-meta">
                            <h4>{{ $brand->name }}</h4>
                            <p>({{$brand->products->count()}} مورد)</p>
                        </div>
                    </div>
                @endforeach


                </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="bottom-paginate">
                        <p class="page-info">نمایش {{ $brands->firstItem() }} از {{ $brands->total() }} نتیجه</p>
                        <ul class="pagination">

                            {{ $brands->links() }}

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>



    @include('front.layouts.intro')





@endsection




