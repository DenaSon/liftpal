<!-- Sidebar-->
<aside class="col-lg-4 col-md-5 pe-xl-4 mb-5">
    <!-- Account nav-->
    <div class="card card-body border-0 shadow-sm pb-1 me-lg-1">
        <div class="d-flex d-md-block d-lg-flex align-items-start pt-lg-2 mb-4"><img
                    class="rounded-circle" src="{{ asset('assets/img/avatars/09.jpg') }}" width="48"
                    alt="">
            <div class="pt-md-2 pt-lg-0 ps-3 ps-md-0 ps-lg-3">
                <h2 class="fs-lg mb-0">
                    {{ $authUser->profile?->name ?? '' }}   {{ $authUser->profile?->last_name ?? '' }}
                </h2><span class="star-rating">
        <i
                class="star-rating-icon fi-star-filled active"></i><i
                            class="star-rating-icon fi-star-filled active"></i><i
                            class="star-rating-icon fi-star-filled active"></i><i
                            class="star-rating-icon fi-star-filled active"></i><i
                            class="star-rating-icon fi-star-filled active"></i></span>
                <ul class="list-unstyled fs-sm mt-3 mb-0">
                    <li><a class="nav-link fw-normal p-0" href="tel:{{ $authUser->phone ?? '' }}"><i
                                    class="fi-phone opacity-60 me-2"></i>{{ $authUser->phone ?? '' }}</a></li>
                    <li><a class="nav-link fw-normal p-0" href="mailto:{{ $authUser->email ?? '' }}"><i
                                    class="fi-mail opacity-60 me-2"></i>{{ $authUser->email ?? '' }}</a></li>
                </ul>
            </div>
        </div>
        <a class="btn btn-outline-primary btn-lg w-100 mb-3" href="real-estate-add-property.html"><i
                    class="fi-shop me-2"></i> خرید محصولات</a><a
                class="btn btn-outline-secondary d-block d-md-none w-100 mb-3" href="#account-nav"
                data-bs-toggle="collapse"><i class="fi-align-justify me-2"></i>منو</a>
        <div class="collapse d-md-block mt-3" id="account-nav">
            <div class="card-nav">
                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'profile') active @endif"
                   href="{{ route('panel',['page'=>'profile']) }}"><i
                            class="fi-user opacity-60 me-2"></i>اطلاعات حساب کاربری</a><a
                        class="card-nav-link" href="real-estate-account-security.html"><i
                            class="fi-lock opacity-60 me-2"></i>گذرواژه و امنیتی</a><a
                        class="card-nav-link" href="real-estate-account-properties.html"><i
                            class="fi-home opacity-60 me-2"></i>املاک من</a>
                <a class="card-nav-link @if(request()->input("page") == 'favorite') active @endif"
                   href="{{ route('panel',['page'=>'favorite']) }}" wire:navigate><i
                            class="fi-heart opacity-60 me-2"></i>موردعلاقه ها</a><a
                        class="card-nav-link" href="real-estate-account-reviews.html"><i
                            class="fi-star opacity-60 me-2"></i>نظرات</a><a class="card-nav-link"
                                                                            href="real-estate-account-notifications.html"><i
                            class="fi-bell opacity-60 me-2"></i>اطلاعیه ها</a><a class="card-nav-link"
                                                                                 href="real-estate-help-center.html"><i
                            class="fi-help opacity-60 me-2"></i>پشتیبانی</a><a class="card-nav-link"
                                                                               href="#">
                    <i class="fi-logout opacity-60 me-2"></i>
                    @livewire('auth.logout')
                </a></div>
        </div>
    </div>
</aside>
