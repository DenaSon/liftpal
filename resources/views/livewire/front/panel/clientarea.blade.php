<div>
    @include('livewire.front.home-inc.header')
    @push('styles')

        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css') }}"/>
    @endpush

    <!-- Page content-->
    <div class="container pt-5 pb-lg-4 mt-5 mb-sm-2">
        <!-- Breadcrumb-->
        <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('panel') }}">حساب کاربری</a></li>
                <li class="breadcrumb-item active " aria-current="page">{{ $pageTitle ?? 'اطلاعات حساب کاربری' }}</li>
            </ol>
        </nav>
        <!-- Page content-->
        <div class="row">
            @include('livewire.front.panel.inc.sidebar')
            <!-- Content-->
            <div class="col-lg-8 col-md-7 mb-5 account">
                <h1 class="fw-normal fs-5">{{ $pageTitle ?? 'اطلاعات حساب کاربری' }}</h1>

                @if(request()->input('page') == 'profile')
                    <livewire:front.panel.components.profile lazy/>
                @endif


            </div>


        </div>
    </div>

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

        <script src="{{ asset('assets/vendor/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>
    @endsection


</div>
