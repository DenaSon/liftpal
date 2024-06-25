<header class="navbar navbar-expand-lg navbar-light bg-light fixed-top" data-scroll-header>
    <div class="container"><a target="_self" wire:navigate class="navbar-brand ms-3 ms-xl-4 logo"
                              href="{{ route('home') }}"><img
                class="d-block" src="{{ asset('assets/img/logo/logo.png') }}" width="116" alt="Finder"></a>
        <button data-no-turbolink class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <a class="btn btn-sm text-primary d-none d-lg-block order-lg-3" href="#signin-modal" data-bs-toggle="modal"><i
                class="fi-user me-2"></i>ورود به حساب </a><a class="btn btn-primary btn-sm ms-2 order-lg-3"
                                                             href="real-estate-add-property.html"><i
                class="fi-plus me-2"></i>ثبت<span class='d-none d-sm-inline'> پروژه</span></a>
        <div wire:ignore class="collapse navbar-collapse order-lg-2" id="navbarNav">
            <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem;">
                <!-- Demos switcher-->
                <li class="nav-item  py-2 me-lg-2"><a
                        class="nav-link  align-items-center border-end-lg py-1 pe-lg-4" href="{{ route('shop') }}"
                         role="button" aria-expanded="false"><i class="fi-shopping-bag me-2"></i>
                        فروشگاه</a>

                </li>
                <!-- Menu items-->
                <li class="nav-item dropdown "><a wire:navigate class="nav-link" href="{{ route('home') }}"
                                                        role="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">خانه</a>

                </li>

                @if(auth()->check())
                    <li class="nav-item dropdown"><a wire:navigate class="nav-link" href="{{ route('home') }}"
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
