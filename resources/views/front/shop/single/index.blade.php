@extends('front.layouts.master')


@section('meta')

    <meta property="og:site_name" content="{{ getSetting('website_title') }}">
    <meta property="og:title" content="{{ $product->name }}">
    <meta property="og:type" content="product">
    <meta property="og:image" content="{{ asset($product->images->first()->file_path ?? 'front/assets/images/coming-soon.png') }}">
    <meta property="og:url" content="{{ route('singleProduct',['product' => $product,'slug' => slugMaker($product->name)]) }}">
    <meta property="og:description" content="{{ $product->description }}">
    <meta property="og:locale" content="fa_IR">
    <meta name="keywords" content="{{ implode(', ', $product->tags->pluck('name')->toArray()) }}">



@endsection

@section('title','قیمت و خرید ' .' '.$product->name)

@section('customCss')
    <link rel="stylesheet" href="{{ asset('front/assets/css/product-details.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/single-customize.css') }}">
@endsection



@section('content')


    @include('front.shop.single.inc.top-part')

   @include('front.shop.single.inc._product-details')


    <!--=====================================
              PRODUCT TAB PART START
    =======================================-->
    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li><a href="#tab-desc" class="tab-link active" data-bs-toggle="tab">توضیحات</a></li>
                        <li><a href="#tab-spec" class="tab-link" data-bs-toggle="tab">مشخصات</a></li>
                        <li><a href="#tab-reve" class="tab-link" data-bs-toggle="tab">بررسی ({{ $product->comments->where('status','published')->count() }})</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane fade show active" id="tab-desc">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-frame">
                            <div class="tab-descrip product-details-single">

                              {!! $product->details  !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-spec">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-frame">
                            <table class="table table-bordered">
                                <tbody>



                            @foreach($product->productProperties($product->id) as $property)
                                <tr>
                                    <th scope="row"> {{ $property->name }} </th>
                                    <td>{{ $property->value }}</td>
                                </tr>
                            @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-reve">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-frame">
                            <ul class="review-list">
                                @foreach($product->load('comments')->comments->where('status','published') as $index => $comment)
                                <li class="review-item">
                                    <div class="review-media">
                                        <a class="review-avatar" href="#">
                                            <img src="{{ asset('front/assets/images/user.png') }}" alt="review">
                                        </a>



                                        <h5 class="review-meta">
                                            <a href="#"> {{ $comment->username }} </a>
                                            <span>{{ jdate($comment->created_at)->toFormattedDateString()}}</span>
                                        </h5>



                                    </div>


             <p class="review-desc">{{ $comment->text }}</p>


                                    @if(\Illuminate\Support\Str::length($comment->reply) > 3)
                                    <form class="review-reply">

                                        <input disabled type="text" placeholder=" {{ $comment->reply }} ">

                                    </form>
                                    @endif
                                </li>



                                @endforeach
                            </ul>
                        </div>
                        <div class="product-details-frame">
                            @auth()
                            <h3 class="frame-title">نظر خود را اضافه کنید</h3>

                            <form class="review-form" method="post" action="{{ route('sendComment') }}">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input name="username" type="text" class="form-control" placeholder="نام">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea name="review_details" class="form-control" placeholder="توضیحات"></textarea>
                                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                                            <input type="hidden" name="product_id_hash" value="{{ hash('sha256', $product->id) }}">

                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <button class="btn btn-inline">
                                            <i class="icofont-water-drop"></i>
                                            <span>ثبت نظر</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @else
                                <div class="not-auth-user">
                                <h5>
                                    &nbsp;&nbsp; جهت ارسال دیدگاه وارد حساب کاربری خود شوید
                                    <u class="text" onclick="phoneRegister()"> ورود به حساب </u>
                                </h5>


                                </div>

                            @endauth

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=====================================
                PRODUCT TAB PART END
    =======================================-->













    @include('front.layouts.intro')

@endsection




