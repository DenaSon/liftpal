<aside class="col-lg-4 col-md-5 pe-xl-4 mb-5">
    <!-- Account nav-->
    <div class="card card-body border-0 shadow-sm pb-1 me-lg-1">
        <div class="d-flex d-md-block d-lg-flex align-items-start pt-lg-2 mb-4">
            @if($photo == null)
                <div class="mb-3">
                    <label for="formFile" class="form-label">
                        <img class="rounded-circle" src="{{ asset('admin/assets/libs/feather-icons/icons/user.svg') }}" width="48" alt="">
                    </label>
                    <input class="form-control" type="file" id="formFile" wire:model.live.debounce.200ms="photo">
                </div>

            @else
                <img class="rounded-circle" src="{{ asset($photo) }} }}" width="48" alt="">
            @endif

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
        <a wire:navigate class="btn btn-outline-primary btn-lg w-100 mb-3" href="{{ route('panel',['page'=>'building']) }}"><i
                class="fi-shop me-2"></i> مدیریت ساختمان</a><a
            class="btn btn-outline-secondary d-block d-md-none w-100 mb-3" href="#account-nav"
            data-bs-toggle="collapse"><i class="fi-align-justify me-2"></i>منو</a>
        <div class="collapse d-md-block mt-3" id="account-nav">
            <div class="card-nav">

                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'main') active @endif"
                   href="{{ route('panel',['page'=>'main']) }}"><i class="fi-dashboard opacity-60 me-2"></i> داشبورد </a>


                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'profile') active @endif"
                   href="{{ route('panel',['page'=>'profile']) }}"><i
                        class="fi-user opacity-60 me-2"></i>ویرایش پروفایل</a>

             <!--   <a class="card-nav-link" href="real-estate-account-security.html"><i
                        class="fi-lock opacity-60 me-2"></i>گذرواژه و امنیتی</a> -->


                <a class="card-nav-link @if(request()->input("page") == 'favorite') active @endif"
                   href="{{ route('panel',['page'=>'favorite']) }}" wire:navigate><i
                        class="fi-heart opacity-60 me-2"></i>مورد علاقه‌ها</a>

                <a class="card-nav-link @if(request()->input("page") == 'address') active @endif"
                   href="{{ route('panel',['page'=>'address']) }}" wire:navigate><i
                        class="fi fi-geo opacity-60 me-2"></i>آدرس‌ها </a>





                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <a class="card-nav-link @if(request()->input("page") == 'building') active @endif"
                                   href="{{ route('panel',['page'=>'building']) }}" wire:navigate><i
                                            class="fi fi-building opacity-60 me-2"></i>مدیریت ساختمان </a>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">

                                <a wire:navigate class="card-nav-link d-block" href="#"><i class="fi-bell opacity-60 me-2"></i>مدل آسانسور</a>
                                <a wire:navigate class="card-nav-link d-block" href="#"><i class="fi-user-plus opacity-60 me-2"></i>ثبت عضو</a>

                            </div>
                        </div>
                    </div>

                </div>

                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'notification') active @endif"
                   href="{{ route('panel',['page'=>'notification']) }}"><i
                        class="fi-bell opacity-60 me-2"></i>اطلاعیه ها</a>

                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'support') active @endif" href="{{ route('panel',['page'=>'support']) }}"><i
                        class="fi-help opacity-60 me-2"></i>پشتیبانی</a>


                <a class="card-nav-link" href="#">
                    <i class="fi-logout opacity-60 me-2"></i>
                    @livewire('auth.logout')
                </a>


            </div>
        </div>
    </div>
</aside>
