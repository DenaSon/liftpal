<aside class="col-lg-4 col-md-5 pe-xl-4 mb-5">
    <!-- Account nav-->
    <div class="card card-body border-0 shadow-sm pb-1 me-lg-1">
        <div class="d-flex d-md-block d-lg-flex align-items-start justify-content-center pt-lg-2 mb-4">
            <img src="{{ asset('media/managerpng.jpg') }}" alt="" class="w-75 mx-auto"  width="150"/>
        </div>

    @if(Auth::user()->isRole('manager'))
            <a wire:navigate class="btn btn-outline-primary btn-lg w-100 mb-3"
               href="{{ route('panel',['page'=>'fault-alert']) }}"><i
                    class="fi-shop me-2"></i>اعلام مشکل فنی</a>
        @elseif(Auth::user()->isRole('technician'))
            <a wire:navigate class="btn btn-outline-primary btn-lg w-100 mb-3 mt-3"
               href="{{ route('panel',['page'=>'request-list'])}}">
                <i class="fi-bell-on me-2"></i>  درخواست‌ها
            </a>
        @endif


        <a class="btn btn-outline-secondary d-block d-md-none w-100 mb-3" href="#account-nav"
           data-bs-toggle="collapse"><i class="fi-align-justify me-2"></i>منو</a>
        <div class="collapse d-md-block mt-3" id="account-nav">
            <div class="card-nav">

                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'dashboard') active @endif"
                   href="{{ route('management',['page'=>'dashboard']) }}"><i class="fi-dashboard opacity-60 me-2"></i> داشبورد
                </a>


                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'allot') active @endif"
                   href="{{ route('management',['page'=>'allot']) }}"><i
                        class="fi-user opacity-60 me-2"></i> تخصیص</a>

                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'eed-create') active @endif"
                   href="{{ route('management',['page'=>'eed-create']) }}"><i
                        class="fi-flame opacity-60 me-2"></i>سیستم EED</a>


                <a class="card-nav-link" href="#">
                    <i class="fi-logout opacity-60 me-2"></i>
                    @livewire('auth.logout')
                </a>


            </div>
        </div>
    </div>
</aside>
