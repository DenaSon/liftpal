<div>
    @include('livewire.front.home-inc.header')


    <!-- Page content-->
    <div class="container pt-5 pb-lg-4 mt-5 mb-sm-2">
        <!-- Breadcrumb-->
        <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('management',['page'=>'dashboard']) }}">پنل
                        مدیریتی </a></li>

            </ol>
        </nav>
        <!-- Page content-->
        <div class="row">
            @include('livewire.adminarea.admin-sidebar')
            <!-- Content-->
            <div class="col-lg-8 col-md-7 mb-5 account">

                <h1 class="fw-normal fs-5"> {{ $pageTitle ?? 'اطلاعات حساب کاربری' }} </h1>
                <hr dir="rtl" class=" custom-hr-title-panel mt-2">

                @if(request()->input('page') == 'allot')
                    <livewire:adminarea.users.allot>
                        @elseif(request()->input('page') == 'dashboard')
                            <livewire:adminarea.dashboard/>
                        @elseif(request()->input('page') == 'eed-create')
                            <livewire:adminarea.eed.eed-create/>
                        @elseif(request()->input('page') == 'companies')
                            <livewire:adminarea.company.companies/>
                        @elseif(request()->input('page') == 'user-manager')
                            <livewire:adminarea.users.user-manager/>
                        @elseif(request()->input('page') == 'setting')
                            <livewire:adminarea.system.setting/>
                        @else
                            <livewire:adminarea.dashboard/>
                @endif


            </div>


        </div>
    </div>

    <div class="clearfix"></div>


    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts/>
        <script data-navigate-once
                src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script data-navigate-once
                src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>

        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>
    @endsection


</div>
