<header class="navbar navbar-expand-lg navbar-light bg-light fixed-top" data-scroll-header>
    <div class="container"><a target="_self" wire:navigate class="navbar-brand ms-3 ms-xl-4 logo"
                              href="{{ route('home') }}"><img
                class="d-block" src="{{ asset('assets/img/logo/logo.png') }}" width="116" alt="Finder"></a>
        <button data-no-turbolink class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>


        @if(auth()->check())
            <div class="dropdown  d-none d-lg-block order-lg-3 my-n2 me-3">
                <a class="d-inline me-3 py-2" href="javascript:void(0)">
                    <img class="rounded-circle" src="{{ asset('assets/img/avatars/03.jpg') }}" width="40" alt=""></a>
                <div class="dropdown-menu  dropdown-menu-center-hompage ">
                    <div class="d-flex align-items-start border-bottom px-3 py-1 mb-2" style="width: 16rem;">
                        <img class="rounded-circle" src="{{ asset('assets/img/avatars/03.jpg') }}" width="48" alt="">
                        <div class="ps-2 text-end">
                            <h6 class="fs-base mb-0"> {{ auth()->user()->profile->name ?? '' }} {{ auth()->user()->profile->last_name ?? '' }} </h6>
                            <span class="star-rating star-rating-sm"><i class="star-rating-icon fi-star-filled active"></i>
                        <i class="star-rating-icon fi-star-filled active">

                        </i>
                        <i
                            class="star-rating-icon fi-star-filled active"></i>
                        <i class="star-rating-icon fi-star-filled active"></i>
                        <i class="star-rating-icon fi-star-filled active">

                        </i></span>
                            <div class="fs-xs muted">{{ auth()?->user()?->phone }}<br>{{ auth()?->user()?->email ?? 'ایمیل ثبت نشده' }}</div>
                        </div>
                    </div>
                    <a wire:navigate class="dropdown-item" href="{{ route('panel') }}">
                        <i class="fi-user opacity-60 me-2"></i> پنل کاربری</a>
                    <a class="dropdown-item" href="real-estate-account-security.html"><i class="fi-lock opacity-60 me-2"></i>گذرواژه
                        و امنیتی</a>
                    <a class="dropdown-item" href="real-estate-account-properties.html">
                        <i class="fi-home opacity-60 me-2"></i>املاک من</a>
                    <a class="dropdown-item" href="real-estate-account-wishlist.html"><i
                            class="fi-heart opacity-60 me-2"></i>موردعلاقه ها</a>
                    <a class="dropdown-item" href="real-estate-account-reviews.html">
                        <i class="fi-star opacity-60 me-2">

                        </i>نظرات</a><a class="dropdown-item"
                                        href="real-estate-account-notifications.html"><i
                            class="fi-bell opacity-60 me-2">

                        </i>اطلاعیه ها</a>
                    <div class="dropdown-divider"> </div>


                    <a class="dropdown-item active" href="#">پشتیبانی</a>


                    @auth
                       @livewire('auth.logout')
                    @endauth

                </div>
            </div>

        @else
            <a class="btn btn-sm text-primary d-none d-lg-block order-lg-3" href="#signin-modal" data-bs-toggle="modal"><i
                    class="fi-user me-2"></i>ورود </a>
        @endif

        <a class="btn btn-primary btn-sm ms-2 order-lg-3"
           href="real-estate-add-property.html"><i
                class="fi-plus me-2"></i>ثبت<span class='d-none d-sm-inline'> پروژه</span></a>
        <div wire:ignore class="collapse navbar-collapse order-lg-2" id="navbarNav">
            <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem;">
                <!-- Demos switcher-->
                <li class="nav-item  py-2 me-lg-2"><a
                        wire:navigate
                        class="nav-link  align-items-center border-end-lg py-1 pe-lg-4" href="{{ route('shop') }}"
                        role="button" aria-expanded="false"><i class="fi-shopping-bag me-2"></i>
                        فروشگاه</a>

                </li>
                <!-- Menu items-->
                <li class="nav-item dropdown ">
                    <a wire:navigate class="nav-link @if(request()->route()->getName() == 'home') active  @endif" href="{{ route('home') }}"
                       role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">خانه</a>

                </li>

                @if(auth()->check())
                    <li class="nav-item dropdown"><a wire:navigate class="nav-link" href="{{ route('panel') }}"
                                                     role="button"
                                                     data-bs-toggle="dropdown" aria-expanded="false">حساب کاربری</a>
                    </li>

                @endif

                @foreach(getPagesName('header')->take(5) as $page)
                    <li class="nav-item dropdown">
                        <a wire:navigate class="nav-link" href="{{ route('home') }}" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false"> {{ $page->title }} </a>
                    </li>
                @endforeach
                <li class="nav-item dropdown">
                    <a wire:navigate class="nav-link" href="{{ route('contactUs') }}" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false"> تماس باما </a>
                </li>

                <li class="nav-item d-lg-none"><a class="nav-link" href="#signin-modal" data-bs-toggle="modal"><i
                            class="fi-user me-2"></i>ورود به حساب </a></li>


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
