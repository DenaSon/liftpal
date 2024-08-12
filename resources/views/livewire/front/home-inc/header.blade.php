<header class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm" data-scroll-header>
    <div class="container  d-flex">
        <a target="_self" wire:navigate class="navbar-brand ms-3 ms-xl-4 logo" href="{{ route('home') }}">
            <img class="d-block" src="{{ asset('assets/img/logo/logo.png') }}" width="116" alt="logo"></a>

        <button data-no-turbolink class="navbar-toggler ms-auto " type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span></button>


        @if(auth()->check())
            <div class="dropdown d-none d-lg-block order-lg-3 my-n2 me-3">
                <a class="d-inline me-3 py-2" href="javascript:void(0)">
                    <img class="rounded-circle" src="{{ asset(auth()->user()?->images()?->first()->file_path ?? asset('admin/assets/libs/feather-icons/icons/user.svg')) }}" width="40" alt="">


                </a>
                <div class="dropdown-menu  dropdown-menu-center-hompage me-5">
                    <div class="d-flex align-items-start border-bottom px-3 py-1 mb-2 " style="width: 16rem;">
                        <i class="fi fi-user fs-lg"></i>
                        <div class="ps-2 text-end">
                            <h6 class="fs-base mb-0"> {{ auth()->user()->profile->name ?? '' }} {{ auth()->user()->profile->last_name ?? '' }} </h6>
                            <span class="star-rating star-rating-sm"><i class="star-rating-icon fi-star-filled active"></i>
                        <i class="star-rating-icon fi-star-filled active">

                        </i>
                        <i class="star-rating-icon fi-star-filled active"></i>
                                <i class="star-rating-icon fi-star-filled active"></i>
                                <i class="star-rating-icon fi-star-filled active"></i>
                            </span>

                            <div class="fs-xs muted">{{ auth()?->user()?->phone }}<br>{{ auth()?->user()?->email ?? 'ایمیل ثبت نشده' }}</div>
                        </div>

                    </div>
                    <a wire:navigate class="dropdown-item" href="{{ route('panel') }}">
                        <i class="fi-user opacity-60 me-2"></i> پنل کاربری</a>

                    <a class="dropdown-item" href="{{ route('panel',['page'=>'profile']) }}"><i
                                class="fi-lock opacity-60 me-2"></i>ویرایش پروفایل</a>


                    <a class="dropdown-item" href="{{ route('panel',['page'=>'favorite']) }}"><i
                                class="fi-heart opacity-60 me-2"></i>موردعلاقه ها</a>

                    <a class="dropdown-item" href="{{ route('panel',['page'=>'address']) }}"><i
                                class="fi fi-geo opacity-60 me-2"></i>آدرس‌ها </a>

                    <a class="dropdown-item" href="{{ route('panel',['page'=>'building']) }}"><i
                                class="fi fi-building opacity-60 me-2"></i>مدیریت ساختمان </a>

                    <a class="dropdown-item" href="{{ route('panel',['page'=>'notification']) }}"><i
                                class="fi-bell opacity-60 me-2"></i>اطلاعیه ها</a>


                    <div class="dropdown-divider"></div>


                    <a class="dropdown-item" href="{{ route('panel',['page'=>'support']) }}"><i
                                class="fi-help opacity-60 me-2"></i>پشتیبانی</a>


                    @auth
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="fi-logout opacity-60 me-2"></i>
                            @livewire('auth.logout')
                        </a>
                    @endauth

                </div>
            </div>

        @else
{{--            <a class=" text-decoration-none d-none d-lg-block me-auto" href="#signin-modal" data-bs-toggle="modal">ورود به حساب</a>--}}
        @endif


        <div wire:ignore class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav navbar-nav-scroll w-100" style="max-height: 35rem;">

                <!-- Menu items-->


                <li class="nav-item "><a wire:navigate class="nav-link" href="{{ route('shop') }}"
                                         role="button"
                                         data-bs-toggle="dropdown" aria-expanded="false">فروشگاه</a>
                </li>


                @if(auth()->check())
                    <li class="nav-item"><a wire:navigate class="nav-link" href="{{ route('panel') }}"
                                             role="button"
                                             data-bs-toggle="dropdown" aria-expanded="false">حساب کاربری</a>
                    </li>

                @endif



                @foreach(getPagesName('header')->take(5) as $page)
                    <li class="nav-item">
                        <a wire:navigate class="nav-link" href="{{ route('home') }}" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false"> {{ $page->title }} </a>
                    </li>
                @endforeach
                <li class="nav-item ">
                    <a wire:navigate class="nav-link" href="{{ route('contactUs') }}" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false"> تماس باما </a>
                </li>

                <li class="nav-item active ms-lg-auto"><a class="nav-link" href="#signin-modal" data-bs-toggle="modal">ورود به حساب </a>
                </li>



            </ul>
        </div>
    </div>
</header>
<livewire:auth.login wire:key="{{uniqid()}}"/>
<!-- Sign Up Modal-->
<livewire:auth.register wire:key="{{ uniqid() }}"/>
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/theme-style.css') }}">
    <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">
@endpush
