@extends('front.layouts.master')
@section('meta')

    <meta name="description" content="{{ getSetting('website_title') }} تماس باما ">

@endsection

@section('title',getSetting('website_title'). '-'. 'تماس باما')

@section('customCss')
    <link rel="stylesheet" href="{{ asset('front/assets/css/contact.css') }}">
@endsection

@section('content')

    <!--=====================================
                    CONTACT PART START
        =======================================-->
    <section class="inner-section contact-part">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="contact-card">
                        <i class="icofont-location-pin"></i>
                        <h4>دفتر اصلی</h4>
                        <p>{{ getMenu('company_address') }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="contact-card active">
                        <a href="tel:{{ getSetting('support_manager_phone') }}" style="direction:rtl">  <i class="icofont-phone"></i> </a>
                        <h4>شماره تماس</h4>
                        <p>
                            <a href="tel:{{ getSetting('support_manager_phone') }}" style="direction:rtl">{{ getSetting('support_manager_phone') }}</a>

                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="contact-card">
                        <a href="mailto:{{ getSetting('support_manager_email') }}">   <i class="icofont-email"></i> </a>
                        <h4>ایمیل</h4>
                        <p>
                            <a href="mailto:{{ getSetting('support_manager_email') }}">{{ getSetting('support_manager_email') }}</a>
                            <a href="mail:{{ getSetting('system_admin_email') }}">{{ getSetting('system_admin_email') }}</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1020.3186214845779!2d51.59689898872955!3d30.66412535880924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fb0bb738b77abc9%3A0xbc76eea88d79bdc7!2z2YXYt9ioINiv2YbYr9in2YbZvtiy2LTaqduMINiv2qnYqtixINis2KfZh9ivINmB2LHbjNiv24w!5e0!3m2!1sfa!2sde!4v1702983756085!5m2!1sfa!2sde" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="contact-form" method="post" action="{{ route('contact/send') }}">
                        @csrf
                        <h4>ارتباط مستقیم با کارشناسان </h4>
                        <div class="form-group">
                            <div class="form-input-group">
                                <input maxlength="25" required name = 'username' class="form-control" type="text" placeholder="نام شما">
                                <i class="icofont-user-alt-3"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-input-group">
                                <input maxlength="55"  required name="email" class="form-control" type="email" placeholder="ایمیل شما">
                                <i class="icofont-email"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-input-group">
                                <input maxlength="80" required name="subject" class="form-control" type="text" placeholder="موضوع">
                                <i class="icofont-book-mark"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-input-group">
                                <textarea maxlength="255" required name="messagetext" class="form-control" placeholder="پیام شما"></textarea>
                                <i class="icofont-paragraph"></i>
                            </div>
                        </div>
                        <button type="submit" class="form-btn-group">
                            <i class="fas fa-envelope"></i>
                            <span>ارسال پیام</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <!--=====================================
                CONTACT PART END
    =======================================-->






    @include('front.layouts.intro')

@endsection




