<div>
    @section('css')

        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/simplebar/dist/simplebar.min.css') }}"/>
        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/tiny-slider/dist/tiny-slider.css') }}"/>
        <!-- Main Theme Styles + Bootstrap-->
        <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">

    @endsection

        <livewire:front.cart.cart-modal/>
    @include('livewire.front.home-inc.header')


    <div class="container mt-5 mb-md-4 pt-5">
        <nav class="mb-3 pt-md-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
                <li class="breadcrumb-item active" aria-current="page">تماس با ما</li>
            </ol>
        </nav>
    </div>


    <!-- ============================ Contact Detail ================================== -->

    <section class="container mb-5 pb-2 pb-md-4 pb-lg-5">
        <div class="row align-items-md-start align-items-center gy-4">
            <div class="col-lg-5 col-md-6">
                <div class="mx-md-0 mx-auto mb-md-5 mb-4 pb-md-4 text-md-start text-center" style="max-width: 416px;">
                    <h1 class="mb-4 ">با ما در ارتباط باشید!</h1>
                    <p class="mb-0 fs-base text-muted">فرم را تکمیل کنید و تیم ما سعی می کند در مدت 24 ساعت با شما تماس
                        بگیرد.</p>
                </div>
                <img class="d-block mx-auto rotate-img"
                     src="{{ asset('assets/img/real-estate/illustrations/contact.svg') }}" alt="Illustration">
            </div>
            <div class="col-md-6 offset-lg-1">
                <div class="card border-0 bg-white p-sm-3 p-2">
                    <div class="card-body m-1">
                        <form class="needs-validation" novalidate="" wire:submit="send">
                            <div class="mb-4">
                                <label class="form-label" for="c-name">نام </label>
                                <input class="form-control form-control-lg" id="c-name" type="text" required="" placeholder="نام و نام خانوادگی"
                                       wire:model="name">
                                @error('name')
                                <div class="small mt-1 text-danger">{{ $message }} </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="c-email">پست الکترونیکی</label>
                                <input wire:model="email" class="form-control form-control-lg" id="c-email" type="email" placeholder="ایمیل">
                                @error('email')
                                <div class="small mt-1 text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="c-phone">شماره تلفن</label>
                                <input wire:model="phone" class="form-control form-control-lg" id="c-phone" placeholder="شماره تلفن"
                                       type="number" required="">
                                @error('phone')
                                <div class="small mt-1 text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="c-message">متن درخواست</label>
                                <textarea  wire:model="text" class="form-control form-control-lg" id="c-message" rows="4"
                                          placeholder="متن مورد نظر خود را بنویسید ..." required=""></textarea>
                                @error('text')
                                <div class="small mt-1 text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="pt-sm-2 pt-1">
                                <button class="btn btn-lg btn-primary w-sm-auto w-100" type="submit">ارسال پیغام</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="container mb-5 pb-2 pb-md-4 pb-lg-5">
        <div class="row g-4">
            <!-- Item-->
            <div class="col-md-4"><a class="icon-box card card-hover h-100" href="mailto:{{ getSetting('support_manager_email') }}">
                    <div class="card-body">
                        <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3"><i class="fi-mail"></i>
                        </div>
                        <span class="d-block mb-1 text-body">ارسال ایمیل</span>
                        <h3 class="h5 icon-box-title mb-0 opacity-90">{{ getSetting('support_manager_email') }}</h3>
                    </div>
                </a></div>
            <!-- Item-->
            <div class="col-md-4"><a class="icon-box card card-hover h-100" href="tel:{{ getSetting('support_manager_phone') }}">
                    <div class="card-body">
                        <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3"><i
                                class="fi-device-mobile"></i></div>
                        <span class="d-block mb-1 text-body">تماس در 7 روز هفته (24/7)</span>
                        <h3 class="h5 icon-box-title mb-0 opacity-90 ltr">{{ getSetting('support_manager_phone') }}</h3>
                    </div>
                </a></div>
            <!-- Item-->
            <div class="col-md-4"><a class="icon-box card card-hover h-100" href="#">
                    <div class="card-body">
                        <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3"><i
                                class="fi-instagram"></i></div>
                        <span class="d-block mb-1 text-body">ما را دنبال کنید</span>
                        <h3 class="h5 icon-box-title mb-0 opacity-90 ltr">@Instagram</h3>
                    </div>
                </a></div>
        </div>
    </section>


    <!-- ============================ Contact Detail ================================== -->

    <!-- ============================ map Start ================================== -->
    <section class="p-0">


        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1716.0629272699525!2d51.60986028201418!3d30.658584346866256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fb0bc99bf923c1d%3A0x483848c797e1c926!2z2KfYs9iq2KfZhiDaqdmH2q_bjNmE2YjbjNmHINmIINio2YjbjNix2KfYrdmF2K_YjCDZitin2LPZiNis2Iwg2KjYp9mH2YbYsSA32Iwg2KfbjNix2KfZhg!5e0!3m2!1sfa!2sde!4v1712832599955!5m2!1sfa!2sde" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    </section>
    <div class="clearfix"></div>
    <!-- ============================ map End ================================== -->


    @include('livewire.front.home-inc.footer')


    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts/>
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script data-navigate-once src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
        <!-- Main theme script-->
        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->

    @endsection
</div>
