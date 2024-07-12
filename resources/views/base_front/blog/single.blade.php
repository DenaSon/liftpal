@extends('front.layouts.master')

@section('title',getSetting('website_title'). '-'.$post->title)
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "headline": "{{ $post->title }}",
        "image": [
            "{{ asset($post->images->first()->file_path) }}"
        ],
        "datePublished": "{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d\TH:i:sP') }}",
        "dateModified": "{{ \Carbon\Carbon::parse($post->updated_at)->format('Y-m-d\TH:i:sP') }}",
        "author": [{
            "@type": "Person",
            "name": "{{ $post->profile->name . $post->profile->last_name }}"
        }]
    }
</script>
@section('meta')

<meta property="og:site_name" content="{{ getSetting('website_title') }}">
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:type" content="product">
<meta property="og:image" content="{{ asset($post->images->first()->file_path) }}">
<meta property="og:url" content="{{ route('blogSingle',['post' => $post,'slug' => slugMaker($post->title)]) }}">
<meta property="og:description" content="{{ $post->description }}">
<meta property="og:locale" content="fa_IR">
<meta name="keywords" content="{{ implode(', ', $post->tags->pluck('name')->toArray()) }}">
<meta name="description" content="{{ $post->description }}">
<!-- AUTHOR META -->
<meta name="author" content="{{ $post->profile->name . $post->profile->last_name }}">
<meta name="email" content="{{ $post->user->email ?? '' }}">


@endsection

@section('customCss')
<link rel="stylesheet" href="{{ asset('front/assets/css/product-details.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/single-customize.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/blog-details.css') }}">
@endsection



@section('content')


@include('front.blog.inc.top-part')






<!--=====================================
AUTHOR SINGLE PART START
=======================================-->
<section class="inner-section blog-grid">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="row">
    <div class="col-lg-12">

        <div class="blog-details-content">
            <ul class="blog-details-meta">
                <li>
                    <i class="icofont-ui-calendar"></i>
                    <span>{{ jdate($post->created_at)->toFormattedDateString() }}</span>
                </li>
                <li>
                    <i class="icofont-user-alt-3"></i>
                    <span> {{ $post->profile->name ?? '' }} {{$post->profile->last_name  }} </span>
                </li>
                <li>
                    <i class="icofont-speech-comments"></i>
                    <span> {{ $post->comments->count() }}  دیدگاه</span>
                </li>

            </ul>
            <h1 class="blog-details-title">{{ $post->title }}</h1>

            <div class="blog-widget widget-text">
                <a href="#"><img  class="img-fluid" src="{{ asset($post->images->first()->file_path) }}" alt="promo"></a>
            </div>

            <div class="blog-details-desc">
                {!! $post->content  !!}
            </div>

            <div class="blog-details-footer">
                <ul class="blog-details-share">
                    <li><span>اشتراک گذاری:</span></li>
                    <li><a href="#" class="icofont-facebook"></a></li>
                    <li><a href="#" class="icofont-twitter"></a></li>
                    <li><a href="#" class="icofont-pinterest"></a></li>
                    <li><a href="#" class="icofont-instagram"></a></li>
                </ul>
                <ul class="blog-details-tag">
                    <li><span></span></li>

                    @foreach($post->tags as $tag)
                    <li><a href="{{ route('blogIndex',['tid'=>$tag->id,'tag' =>slugMaker($tag->name)]) }}">{{ $tag->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>




    </div>
</div>



</div>


    @include('front.blog.inc.sidebar')

</div>


   @include('front.blog.inc._comments')

</div>
</section>
<!--=====================================
AUTHOR SINGLE PART END
=======================================-->



@include('front.layouts.intro')

@endsection




