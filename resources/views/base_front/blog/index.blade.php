@extends('front.layouts.master')
@section('meta')

<meta name="description" content="{{ getSetting('website_title') }} دانشنامه ">

@endsection

@section('title',getSetting('website_title'). '-'. 'دانشنامه')

@section('customCss')
<link rel="stylesheet" href="{{ asset('front/assets/css/product-details.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/single-customize.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/blog-details.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/blog-grid.css') }}">
@endsection

@section('content')

@include('front.blog.inc.top-part-index')

<!--=====================================
AUTHOR SINGLE PART START
=======================================-->
<section class="inner-section blog-grid">
<div class="container">
    <div class="row justify-content-center">


        <div class="row">
            <div class="col-12 col-sm-12 col-md-8">


                <div class="blog-details-content">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-sm-12 col-md-6 col-lg-6 col-12">

                                <div class="blog-card">
                                    <div class="blog-media">
                                        <a class="blog-img"
                                           href="{{ route('blogSingle',['post' =>$post->id,'slug' => slugMaker($post->title)]) }}">
                                            <img src="{{ asset($post->images()->first()->file_path )  }}"
                                                 alt="blog" class="img-fluid" height="300">
                                        </a>
                                    </div>
                                    <div class="blog-content">

                                        <h5 class="blog-title">
                                            <a href="{{ route('blogSingle',['post' =>$post->id,'slug' => slugMaker($post->title)]) }}"> {{ $post->title }} </a>
                                        </h5>

                                        <a class="blog-btn"
                                           href="{{ route('blogSingle',['post' =>$post->id,'slug' => slugMaker($post->title)]) }}">
                                            <span>مشاهده مطلب</span>
                                            <i class="icofont-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <div class="blog-details-footer">

                        <div class="paginate">
                            {{ $posts->links() }}
                        </div>


                    </div>


                </div>

            </div>


            @include('front.blog.inc.sidebar')

        </div>


    </div>

</div>
</section>




@include('front.layouts.intro')

@endsection




