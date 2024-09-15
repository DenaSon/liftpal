<div>
    @include('livewire.front.home-inc.header')


    <!-- Page content-->
    <div class="container pt-5 pb-lg-4 mt-5 mb-sm-2">
        <!-- Breadcrumb-->
        <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
                <li class="breadcrumb-item">
                    @livewire('components.userarea',['class' => ''])  {{--حساب کاربری--}}
                </li>
                <li class="breadcrumb-item active " aria-current="page">{{ $pageTitle ?? 'اطلاعات حساب کاربری' }}</li>
            </ol>
        </nav>
        <!-- Page content-->
        <div class="row">
            @include('livewire.front.panel.inc.sidebar')
            <!-- Content-->
            <div class="col-lg-8 col-md-7 mb-5 account">

                <h1 class="fw-normal fs-5"> {{ $pageTitle ?? 'اطلاعات حساب کاربری' }} </h1>
                <hr dir="rtl" class=" custom-hr-title-panel mt-2">

                @switch(request()->input('page'))
                    @case('profile')
                        <livewire:front.panel.components.profile />
                        @break

                    @case('main')
                        <livewire:front.panel.components.main />
                        @break

                    @case('invoice')
                        @if (!empty(request()->input('order')))
                            <livewire:front.panel.components.invoice />
                        @endif
                        @break

                    @case('support')
                        <livewire:front.panel.components.support />
                        @break

                    @case('favorite')
                        <livewire:front.panel.components.favorite />
                        @break

                    @case('address')
                        <livewire:front.panel.components.address />
                        @break

                    @case('notification')
                        <livewire:front.panel.components.notifications />
                        @break

                    @case('company-buildings')
                        <livewire:front.panel.components.company.company-buildings/>
                        @break

                    @case('building')
                        @can('manager')
                            <livewire:front.panel.components.building />
                        @else
                           @php  abort(403) @endphp
                        @endcan
                        @break

                    @case('fault-alert')
                        <livewire:front.panel.components.fault-alert />
                        @break

                    @case('get-location')
                        <livewire:front.panel.components.get-location />
                        @break

                    @case('request-list')
                        <livewire:front.panel.components.technician.request-list />
                        @break

                    @case('messages')
                        <livewire:front.panel.components.messages />
                        @break

                    @case('company-dashboard')
                        <livewire:front.panel.components.company.company-dashboard />
                        @break

                    @case('company-technicians')
                        <livewire:front.panel.components.company.technician-manager />
                        @break

                    @case('technician-allot')
                        <livewire:front.panel.components.company.technician-allot />
                        @break

                    @default

                @endswitch



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
        <script data-navigate-once
                src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>

        <script data-navigate-once src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
        <script data-navigate-once
                src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>
    @endsection


</div>
