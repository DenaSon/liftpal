@extends('front.layouts.master')


@section('meta')

<meta property="og:site_name" content="{{ getSetting('website_title') }}">
<meta property="og:title" content="{{ $page->title }}">
<meta property="og:type" content="product">
<meta property="og:url" content="{{ route('pageSingle',['page' => $page,'slug' => slugMaker($page->title)]) }}">
<meta property="og:locale" content="fa_IR">



@endsection

@section('title',getSetting('website_title'). '-'.$page->title)

@section('customCss')
<link rel="stylesheet" href="{{ asset('front/assets/css/product-details.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/single-customize.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/blog-details.css') }}">
@endsection



@section('content')


@include('front.page.inc.top-part')


<!--=====================================
AUTHOR SINGLE PART START
=======================================-->
<section class="inner-section blog-grid">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="row">
    <div class="col-lg-12">

        <div class="blog-details-content">

            <h2 class="blog-details-title">{{ $page->title }}</h2>
            <div class="blog-details-desc">
                {!! $page->content  !!}
            </div>
        <div class="blog-details-footer">
                <ul class="blog-details-share">
                    <li><span>اشتراک گذاری:</span></li>
                    <li><a href="#" class="icofont-facebook"></a></li>
                    <li><a href="#" class="icofont-twitter"></a></li>
                    <li><a href="#" class="icofont-linkedin"></a></li>
                    <li><a href="#" class="icofont-pinterest"></a></li>
                    <li><a href="#" class="icofont-instagram"></a></li>
                </ul>

            </div>
        </div>




    </div>
</div>



</div>



</div>



</div>
</section>
<!--=====================================
AUTHOR SINGLE PART END
=======================================-->



@include('front.layouts.intro')

@endsection




