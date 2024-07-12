<div>
    @include('livewire.front.home-inc.header')


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

                <h1 class="fw-normal fs-5"> {{ $pageTitle ?? 'اطلاعات حساب کاربری' }} </h1>
                <hr dir="rtl" class=" custom-hr-title-panel mt-2" >

                @if(request()->input('page') == 'profile')
                    <livewire:front.panel.components.profile/>
                @elseif(request()->input('page') == 'main')
                    <livewire:front.panel.components.main/>
                @elseif(request()->input('page') == 'invoice' && !empty(request()->input('order')))
                    <livewire:front.panel.components.invoice/>
                @elseif(request()->input('page') == 'support' )
                    <livewire:front.panel.components.support>
                        @elseif(request()->input('page') == 'favorite' )
                            <livewire:front.panel.components.favorite>
                                @elseif(request()->input('page') == 'address' )
                                    <livewire:front.panel.components.address>
                                        @elseif(request()->input('page') == 'address' )
                                            <livewire:front.panel.components.notifications>
                                                @elseif(request()->input('page') == 'building' )
                                                    <livewire:front.panel.components.building>
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
        <script data-navigate-once
                src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
        <script data-navigate-once
                src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>
    @endsection


</div>
