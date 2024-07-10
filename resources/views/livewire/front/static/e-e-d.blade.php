<div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    @endpush

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

    <section class="container  pb-md-4 pb-lg-5">
        <div class="row align-items-md-start align-items-center ">
            <div class="flex-column justify-content-center col-lg-5 col-md-6">
                <div class="ms-md-5 mb-md-5 mb-0  text-center" style="max-width: 416px;">
                    <h1 class="mb-3 text-md-start"> سیستم EED</h1>
                    <p class="mb-0 fs-base text-muted text-justify">
                        سیستم EED، راهکاری هوشمند و نوآورانه برای شناسایی و رفع خطاهای آسانسور، به شما این امکان را می‌دهد که با وارد کردن شماره خطای صادر شده از آسانسور، به
                        تفسیر دقیق و روش حل آن دست یابید. این سیستم با بهره‌گیری از یک پایگاه داده بزرگ و وسیع، اطلاعات جامعی را در اختیار شما قرار می‌دهد. EED به تکنسین‌ها و
                        کاربران کمک می‌کند تا مشکلات فنی آسانسور را به سرعت و به سادگی شناسایی و برطرف نمایند. با دقت بالا و رابط کاربری ساده، EED تجربه‌ای کارآمد و مطمئن را
                        فراهم می‌سازد.


                    </p>
                </div>
                <img class="d-flex ms-0 pt-0 rotate-img"
                     src="{{ asset('assets/img/liftpal/eed-pic.jpg') }}" alt="Illustration">
            </div>
            <div class="col-md-6 offset-lg-1 order-1">

             @include('livewire.front.static.eed-inc.eed-form')

            </div>
        </div>
    </section>


    <section class="container mb-5 pb-2 pb-md-4 pb-lg-5">
        <div class="row mx-1">
            <!-- Item-->
            <div class="card m-auto shadow-sm col-md-3">
                    <div class="card-body">

                        <div class="icon-box text-center">
                            <div class="d-flex align-items-center">
                                <div class="icon-box-media bg-faded-primary text-primary rounded-circle  ">
                                    <i class="fi-laundry"></i>
                                </div>
                                <h6 class="ms-3 icon-box-title fs-sm mb-0">محاسبات فنی مهندسی </h6>
                            </div>
                        </div>
                        <div>
                            <p class="text-dark mt-2  text-justify">ماشین حساب لیفت پال یک سرویس محاسباتی آنلاین است که به مهندسین و فن‌آوران اجازه می‌دهد تا به راحتی و سریعاً محاسبات فنی مربوط به آسانسورها را انجام دهند.  </p>
                        </div>

                        <div class="d-flex justify-content-center justify-content-md-start">

                            <button type="button" class="btn btn-outline-primary">شروع کن</button>

                        </div>



                    </div>
              </div>
            <!-- Item-->
            <div class="card my-2 shadow-sm  col-md-3">
                <div class="card-body">
                    <div class="icon-box text-center">
                        <div class="d-flex align-items-center">
                            <div class="icon-box-media bg-faded-primary text-primary rounded-circle  ">
                                <i class="fi-user-plus"></i>
                            </div>
                            <h6 class="ms-3 icon-box-title fs-sm mb-0">یافتن متخصص</h6>
                        </div>
                    </div>
                    <div>
                        <p class="text-dark mt-4 mb-5  text-justify">
                            لیفت‌پال به شما کمک می کند تا بهترین متخصصان آسانسور، مجریان و نصابان را در منطقه خود پیدا کنید.


                        </p>

                    <div class="d-flex justify-content-center justify-content-md-start">

                        <button type="button" class="btn btn-outline-primary align-self-start">شروع کن</button>

                    </div>

                </div>
                </div>
            </div>
            <!-- Item-->
            <div class="card m-auto shadow-sm col-md-3">
                <div class="card-body">

                    <div class="icon-box text-center">
                        <div class="d-flex align-items-center">
                            <div class="icon-box-media bg-faded-primary text-primary rounded-circle  ">
                                <i class="fi-apartment"></i>
                            </div>
                            <h6 class="ms-3 icon-box-title fs-sm mb-0">ثبت ساختمان</h6>
                        </div>
                    </div>
                    <div>
                        <p class="text-dark mt-5 mb-4  text-justify">
                            لیفت‌پال به عنوان یک سامانه جامع، خدمات متنوعی را برای مدیران ساختمان ارائه می دهد.
                        </p>
                    </div>

                    <div class="d-flex justify-content-center justify-content-md-start">
                        <button type="button" class="btn btn-outline-primary ">شروع کن</button>

                    </div>



                </div>
            </div>
        </div>

    </section>


    <!-- ============================ Contact Detail ================================== -->


    <!-- ============================ map End ================================== -->


    @include('livewire.front.home-inc.footer')


    @section('js')
            <script data-navigate-once src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts/>

        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
            <script data-navigate-once src="{{ asset('assets/vendor/jquery-3.6.0.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
        <!-- Main theme script-->
        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>
            <script data-navigate-once src="{{ asset('assets/js/select2.min.js') }}"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->

        <script>
            $(document).ready(function() {
                $('.select2-error').select2(
                    {
                        theme: "classic",
                        placeholder: "وارد کردن کد خطا",
                        allowClear: true,
                        minimumInputLength: 1,
                        maximumInputLength: 10,
                        tags: false,
                        width: 'resolve',

                    }
                );
            });

        </script>

    @endsection


</div>
