 @extends('front.layouts.master')

@section('meta')

    <!-- SEO META -->

    <link rel="canonical" content="https://www.atel.ir/" />
    <meta name="title" content="{{ getSetting('website_title') }}">
    <meta name="description" content="{{ getSetting('meta_description') }}">
    <meta name="keywords" content="{{ getSetting('meta_keywords') }}">

    <meta property="og:title" content="{{ getSetting('website_title') }}">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:description" content="{{ getSetting('meta_description') }}">
    <meta property="og:image" content="{{ getSetting('lg_logo_url') }}">

@endsection


@section('title',getSetting('website_title'))




@section('content')

    @include('front.home.inc._bannerPart')
    @include('front.home.inc._brandPart')
    @include('front.home.inc.nicheProducts')



    @include('front.home.inc.newItems')




    @include('front.home.inc._posts')

    @include('front.home.inc._newsletter')

    @include('front.layouts.intro')


@endsection

