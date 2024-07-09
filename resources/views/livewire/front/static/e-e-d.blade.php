<div>


    @include('livewire.front.home-inc.header')


    <div class="container mt-5 mb-md-4 pt-5">
        <nav class="mb-3 pt-md-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
                <li class="breadcrumb-item active" aria-current="page"> سیستم خطایاب آسانسور</li>
            </ol>
        </nav>
    </div>


    <!-- ============================ Contact Detail ================================== -->

    <section class="container mb-5 pb-2 pb-md-4 pb-lg-5">
        <div class="row align-items-md-start align-items-center gy-4">
            <div class="col-lg-5 col-md-6">
                <div class="mx-md-0 mx-auto mb-md-5 mb-4 pb-md-4 text-md-start text-center" style="max-width: 416px;">
                    <h1 class="mb-4 "> سیستم EED</h1>
                    <p class="mb-0 fs-base text-muted text-justify">
                        سیستم EED، راهکاری هوشمند و نوآورانه برای شناسایی و رفع خطاهای آسانسور، به شما این امکان را می‌دهد که با وارد کردن شماره خطای صادر شده از آسانسور، به
                        تفسیر دقیق و روش حل آن دست یابید. این سیستم با بهره‌گیری از یک پایگاه داده بزرگ و وسیع، اطلاعات جامعی را در اختیار شما قرار می‌دهد. EED به تکنسین‌ها و
                        کاربران کمک می‌کند تا مشکلات فنی آسانسور را به سرعت و به سادگی شناسایی و برطرف نمایند. با دقت بالا و رابط کاربری ساده، EED تجربه‌ای کارآمد و مطمئن را
                        فراهم می‌سازد.


                    </p>
                </div>
                <img class="d-block mx-auto rotate-img"
                     src="{{ asset('assets/img/liftpal/eed-pic.jpg') }}" alt="Illustration">
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
                                <textarea wire:model="text" class="form-control form-control-lg" id="c-message" rows="4"
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
