@extends('front.layouts.master')


@section('title',getSetting('website_title'). '-'.'جزئیات سفارش')

@section('customCss')

    <link rel="stylesheet" href="{{ asset('front/assets/css/profile-customize.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/orderlist.css') }}">


@endsection



@section('content')



    <section class="inner-section checkout-part">
        <div class="container">
            <div class="row">


            @include('front.shop.profile.sidebar')

                @if(request()->has('action') && request('action') == 'orders')
                    @include('front.shop.profile.inc.orders')
                @elseif(request()->has('action') && request('action') == 'edit_profile')
                    @include('front.shop.profile.inc.edit_profile')
                @elseif(request()->has('action') && request('action') == 'transactions')
                    @include('front.shop.profile.inc.transactions')
                @elseif(request()->has('action') && request('action') == 'accounts')
                    @include('front.shop.profile.inc.accounts')
                @elseif(request()->has('action') && request('action') == 'accounts_add')
                    @include('front.shop.profile.inc.accounts_add')
                @endif

            </div>



        </div>

    </section>




    @include('front.layouts.intro')

@endsection


@section('customJs')

    @include('front.layouts.inc._validationErrors')
    @include('front.shop.profile.inc._scripts')

@endsection

