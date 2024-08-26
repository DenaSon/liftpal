<div>
    @section('css')

        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/simplebar/dist/simplebar.min.css') }}"/>
        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/tiny-slider/dist/tiny-slider.css') }}"/>
        <!-- Main Theme Styles + Bootstrap-->
        <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">

    @endsection


    @include('livewire.front.home-inc.header')


    <div class="container mt-5 mb-md-4 pt-5">
        <nav class="mb-3 pt-md-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{ $page->title }}</li>
            </ol>
        </nav>
    </div>


    <!-- ============================ Contact Detail ================================== -->
        <section class="container mb-5 pb-2 pb-md-4 pb-lg-5">
            <div class="row align-items-md-start align-items-center gy-4">
                <div class="col-md-12 offset-lg-1">
                    <div class="card border-0 bg-white p-sm-3 p-2 shadow-lg">
                        <div class="card-body m-1 contentText">
                            <h2 class="card-title text-center">{{ $page->title }}</h2>
                            <p class="card-text">
                                {!! $page->content !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            .contentText p {
                line-height: 35px;
                text-align: justify-all;
                word-break: break-word;
                hyphens: auto;

            }
            .contentText img {
                max-width: 100%; /* Ensure images don't overflow their container */
                height: auto;    /* Maintain aspect ratio */
                display: block;  /* Remove bottom space caused by inline images */
                margin: 0 10px;  /* Center images horizontally */
                border-radius: 8px;     /* Rounded corners */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */


            }


        </style>






    <!-- ============================ Contact Detail ================================== -->

    <!-- ============================ map Start ================================== -->

    <div class="clearfix"></div>
    <!-- ============================ map End ================================== -->


    @include('livewire.front.home-inc.footer')


    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts/>
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script data-navigate-once
                src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
        <script data-navigate-once
                src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
        <!-- Main theme script-->
        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->

    @endsection
</div>
