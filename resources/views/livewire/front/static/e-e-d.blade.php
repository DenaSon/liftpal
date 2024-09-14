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
        <div class="row container align-items-md-start align-items-center justify-content-center mx-auto ">
            <div class="flex-column align-items-center justify-content-center col-lg-5 col-md-6 mx-auto">
                <div class="ms-md-5 mb-md-5 mb-0  justify-content-center text-center text-justify">
                    <h1 class="mb-3 text-md-start"> سیستم EED</h1>
                    <p class="mb-0  text-muted text-justify small-font-eed border border-radius-20 p-3 shadow-sm"
                       style="line-height: 32px">
                        سیستم EED، راهکاری هوشمند و نوآورانه برای شناسایی و رفع خطاهای آسانسور، به شما این امکان را
                        می‌دهد که با وارد کردن شماره خطای صادر شده از آسانسور، به
                        تفسیر دقیق و روش حل آن دست یابید. این سیستم با بهره‌گیری از یک پایگاه داده بزرگ و وسیع، اطلاعات
                        جامعی را در اختیار شما قرار می‌دهد. EED به تکنسین‌ها و
                        کاربران کمک می‌کند تا مشکلات فنی آسانسور را به سرعت و به سادگی شناسایی و برطرف نمایند. با دقت
                        بالا و رابط کاربری ساده، EED تجربه‌ای کارآمد و مطمئن را
                        فراهم می‌سازد.
                    </p>

                </div>
                <div class="d-md-flex align-items-center justify-content-center mt-0 pt-0">
                    <img class="d-none d-md-flex align-items-center justify-content-center pt-0 ms-5 "
                         style="width:250px; height: 250px;"
                         src="{{ asset('assets/img/liftpal/eed-illustratin.png') }}" alt="Illustration">
                </div>
            </div>
            <div
                class="col-md-6 flex-column mx-auto align-items-center justify-content-center custom-offset-eed order-1">

                @include('livewire.front.static.eed-inc.eed-form')

            </div>
        </div>
    </section>


    <section class="container mb-5 pb-2 pb-md-4 pb-lg-5 mt-3">
        <div class="row mt-3 mx-1">
            <!-- Item-->
            <div class="card m-auto shadow-sm col-md-3 fixed-height-eedcard">
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
                        <p class="text-dark mt-2  text-justify">ماشین حساب لیفت پال یک سرویس محاسباتی آنلاین است که به
                            مهندسین و فن‌آوران اجازه می‌دهد تا به راحتی و سریعاً
                            محاسبات فنی مربوط به آسانسورها را انجام دهند. </p>
                    </div>

                    <div class="d-flex justify-content-center ">

                        <button type="button" class="btn btn-outline-primary">شروع کن</button>

                    </div>


                </div>
            </div>
            <!-- Item-->
            <div class="card my-2 shadow-sm  col-md-3 fixed-height-eedcard">
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
                            لیفت‌پال به شما کمک می کند تا بهترین متخصصان آسانسور، مجریان و نصابان را در منطقه خود پیدا
                            کنید.

                        </p>

                        <div class="d-flex justify-content-center ">

                            <button type="button" class="btn btn-outline-primary align-self-start">شروع کن</button>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Item-->
            <div class="card m-auto shadow-sm col-md-3 fixed-height-eedcard">
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
                        <p class="text-dark mt-4 mb-5  text-justify">
                            لیفت‌پال به عنوان یک سامانه جامع، خدمات متنوعی را برای مدیران ساختمان ارائه می دهد.
                        </p>
                    </div>

                    <div class="d-flex justify-content-center ">
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
        <script data-navigate-once
                src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Main theme script-->
        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/js/select2.min.js') }}"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->



    @endsection


</div>
