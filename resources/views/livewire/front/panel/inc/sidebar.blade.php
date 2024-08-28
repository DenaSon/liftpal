<aside class="col-lg-4 col-md-5 pe-xl-4 mb-5">
    <!-- Account nav-->
    <div class="card card-body border-0 shadow-sm pb-1 me-lg-1">
        <div class="d-flex d-md-block d-lg-flex align-items-start pt-lg-2 mb-4">
            @if(!isset($photo))
                <div class="mb-3">
                    <label for="formFile" class="form-label">
                        <img class="rounded-circle" src="{{ asset('admin/assets/libs/feather-icons/icons/user.svg') }}"
                             width="48" alt="">
                    </label>
                    <input class="form-control" type="file" id="formFile" wire:model.live.debounce.200ms="photo">
                </div>

            @else
                <img class="rounded-circle" src="{{ asset("$photo") }}" width="48" alt="">
            @endif

            <div class="pt-md-2 pt-lg-0 ps-3 ps-md-0 ps-lg-3">
                <h2 class="fs-lg mb-0">
                   @if(auth()->user()->role == 'technician')
                  <a class="text-decoration-none text-dark" wire:navigate href="{{ route('singleExpert',['id'=>$authUser?->id,'name' =>$authUser->profile?->name . '-' . $authUser->profile?->last_name ]) }}">
                    {{ $authUser->profile?->name ?? '' }}   {{ $authUser->profile?->last_name ?? '' }}</a>
                    @else
                        {{ $authUser->profile?->name ?? '' }}   {{ $authUser->profile?->last_name ?? '' }}
                    @endif
                    <span class="badge bg-faded-info text-waiting fs-xs fw-normal">{{ auth()->user()->getRole() }}</span>
                </h2>


                <ul class="list-unstyled fs-sm mt-3 mb-0">
                    <li><a class="nav-link fw-normal p-0" href="tel:{{ $authUser->phone ??  '' }}"><i
                                class="fi-phone opacity-60 me-2"></i>{{ $authUser->phone ?? '' }}</a></li>

                    @if($authUser->email)
                        <li><a title="{{ $authUser?->email }}" class="nav-link fw-normal p-0" href=""><i
                                    class="fi-mail opacity-60 me-2 fs-xs"></i>{{ \Illuminate\Support\Str::limit($authUser?->email,25) }}</a></li>

                    @endif

                </ul>
            </div>
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

                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'main') active @endif"
                   href="{{ route('panel',['page'=>'main']) }}"><i class="fi-dashboard opacity-60 me-2"></i> داشبورد
                </a>


                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'profile') active @endif"
                   href="{{ route('panel',['page'=>'profile']) }}"><i
                        class="fi-user opacity-60 me-2"></i> پروفایل</a>

                <!--   <a class="card-nav-link" href="real-estate-account-security.html"><i
                           class="fi-lock opacity-60 me-2"></i>گذرواژه و امنیتی</a> -->
                @can('manager')
                    <a class="card-nav-link @if(request()->input("page") == 'building') active @endif"
                       href="{{ route('panel',['page'=>'building']) }}" wire:navigate><i
                            class="fi fi-building opacity-60 me-2"></i>مدیریت ساختمان </a>
                @endcan


                <a class="card-nav-link @if(request()->input("page") == 'address') active @endif"
                   href="{{ route('panel',['page'=>'address']) }}" wire:navigate><i
                        class="fi fi-geo opacity-60 me-2"></i>آدرس‌ها </a>



                <a wire:navigate class="card-nav-link @if(request()->input('page') == 'messages') active @endif"
                   href="{{ route('panel', ['page' => 'messages']) }}">
                    <i class="fi-mail opacity-60 me-2"></i>پیام‌ها
                    @if($messagesCount > 0)
                        <span class="badge bg-faded-danger ms-2 fw-bold">{{ $messagesCount }}</span>
                    @endif
                </a>



                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'notification') active @endif"
                   href="{{ route('panel',['page'=>'notification']) }}"><i
                        class="fi-bell opacity-60 me-2"></i>اطلاعیه‌ها</a>


                <a class="card-nav-link @if(request()->input("page") == 'favorite') active @endif"
                   href="{{ route('panel',['page'=>'favorite']) }}" wire:navigate><i
                        class="fi-heart opacity-60 me-2"></i>مورد‌علاقه</a>

                <a wire:navigate class="card-nav-link @if(request()->input("page") == 'support') active @endif"
                   href="{{ route('panel',['page'=>'support']) }}"><i
                        class="fi-help opacity-60 me-2"></i>پشتیبانی</a>


                <a class="card-nav-link" href="#">
                    <i class="fi-logout opacity-60 me-2"></i>
                    @livewire('auth.logout')
                </a>


            </div>
        </div>
    </div>
</aside>
