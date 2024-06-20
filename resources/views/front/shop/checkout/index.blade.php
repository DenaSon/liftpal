@extends('front.layouts.master')


@section('title',getSetting('website_title'). '-'.'تسویه حساب ')

@section('customCss')
<link rel="stylesheet" href="{{ asset('front/assets/css/checkout.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/single-customize.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/select2.min.css') }}">

@endsection



@section('content')



<section class="inner-section checkout-part">
<div class="container">
<div class="row">
<div class="col-lg-12">
    <br/>
    <div class="alert-info">
        @if(!request()->query() || request()->query('level') === '' )
        <h5> سبد خرید </h5>
        @elseif(request()->query('level') === 'shipping')
            <h5>  انتخاب آدرس ارسال </h5>
        @elseif(request()->query('level') === 'payment')
            <h5>  صورتحساب و پرداخت </h5>
        @endif
    </div>
</div>
<div class="col-lg-12">
    <div class="account-card">
      <br/>


        <div class="account-content">


            <div class="container">

              @if(!request()->query() || request()->query('level') === '' )


                @elseif(request()->query('level') === 'shipping')


                @elseif(request()->query('level') === 'payment')


                @endif

            </div>

            @if(!request()->query() || request()->query('level') === '' )
            @include('front.shop.checkout.inc._cart_items')
            @endif

            @if(request()->query() && request()->query('level') === 'shipping' || request()->query('level') === 'add_address'  )
                @include('front.shop.checkout.inc._cart_shipping')
            @endif


            @if(request()->query() && request()->query('level') === 'payment'  )
                @include('front.shop.checkout.inc.payment')
            @endif




        </div>
    </div>
</div>



</div>
</div>
</section>




@include('front.layouts.intro')

@endsection


@section('customJs')
    <script src="{{asset('front/assets/js/select2.min.js')}}"></script>





    <script>
        $(document).ready(function() {
            $('.js-province').select2({

                // You can change this to 'material' or other available themes

                placeholder: 'انتخاب استان' // Replace this with your desired default text

            });
        });


    </script>



    @include('front.layouts.inc._validationErrors')

@endsection

