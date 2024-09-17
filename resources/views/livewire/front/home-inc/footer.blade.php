<footer class="footer pt-lg-5 pt-4 bg-dark text-light" id="footer-menu">
    <div class="container mb-4 py-4 pb-lg-5">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6 col-sm-4">
                <div class="mb-4 pb-sm-3"><a class="d-inline-block" href="{{ url()->current() }}"><img
                            src="{{ asset('assets/img/logo/logo.png') }}" width="116" alt="Logo"></a></div>
                <ul class="nav nav-light flex-column">
                    <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal text-light text-nowrap"
                                                 href="mailto:{{getSetting('support_manager_email')}}"><i
                                class="fi-mail mt-n1 me-1 align-middle text-primary"></i>{{getSetting('support_manager_email')}}
                        </a></li>
                    <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal text-light text-nowrap"
                                                 href="tel:{{ getSetting('support_manager_phone') }}"><i
                                class="fi-device-mobile mt-n1 me-1 align-middle text-primary"></i>{{ getSetting('support_manager_phone') }}
                        </a></li>
                </ul>
            </div>
            <!-- Links-->
            <div class="col-lg-2 col-md-3 col-sm-4">
                <h3 class="fs-base text-light">لینک های سریع</h3>
                <ul class="list-unstyled fs-sm">
                    @auth
                        <li><a class="nav-link-light" href="{{ route('panel',['page'=>'main']) }}"> حساب کاربری </a>
                        </li>
                    @endauth

                    <li><a wire:navigate class="nav-link-light" href="{{ route('blogIndex') }}"> دانشنامه آسانسور </a></li>
                    <li><a wire:navigate class="nav-link-light" href="{{ route('EED') }}"> سیستم خطایاب </a></li>
                    <li><a wire:navigate class="nav-link-light" href="{{ route('shop') }}"> فروشگاه </a></li>
                    <li><a wire:navigate class="nav-link-light" href="{{ route('contactUs') }}"> تماس باما </a></li>

                </ul>
            </div>
            <!-- Links-->
            <div class="col-lg-2 col-md-3 col-sm-4">
                <h3 class="fs-base text-light"> خدمات مشتریان </h3>
                <ul class="list-unstyled fs-sm">
                    @foreach(\App\Models\Page::whereLocation('footer')->take(5)->get() as $page)
                        <li class="nav-link-light">
                            <a wire:navigate class="nav-link"
                               href="{{ route('page',['id'=>$page->id,'slug'=>slugMaker($page->title)]) }}"
                               role="button"> {{ $page->title }} </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- Subscription form-->
            <div class="col-lg-4 offset-lg-1">
                <h3 class="h5 font-vazir text-light">مشترک شدن در خبرنامه ما</h3>
                <p class="fs-sm mb-4 opacity-60">آموزش و اطلاعیه های خوب را از دست ندهید!</p>


                @livewire('front.static.newsletter')

            </div>
        </div>
    </div>
    <div class="py-4 border-top border-light">
        <div class="container d-flex flex-column flex-lg-row align-items-center justify-content-between py-2">


            <p class="fs-sm text-center text-sm-start mb-4"><span class="text-light opacity-50">© تمام حقوق محفوظ است |
                <span class="fw-normal fs-xs">
                       پیاده سازی :
                    <a role="button" class="text-light" wire:navigate onclick="alert('شماره تماس : 09173434796')">Mohammad Asadi</a>

                </span>
                </span><a wire:navigate
                          class="nav-link-light fw-bold" href="" target="_blank" rel="noopener"></a>
            </p>
            <div class="d-flex flex-lg-row flex-column align-items-center order-lg-2 order-1 ms-lg-4 mb-lg-0 mb-4">


                <div class="d-flex flex-wrap fs-sm mb-lg-0 mb-4 pe-lg-4"><a wire:navigate class="nav-link-light px-2 mx-1"
                                                                            href="https://liftpal.ir/page/1/%D8%AF%D8%B1%D8%A8%D8%A7%D8%B1%D9%87-%D9%85%D8%A7">درباره
                        ما</a><a wire:navigate class="nav-link-light px-2 mx-1"
                                 href="{{ route('blogIndex') }}">مقالات</a><a wire:navigate
                        class="nav-link-light px-2 mx-1"
                        href="{{ route('shop') }}">فروشگاه</a><a wire:navigate
                        class="nav-link-light px-2 mx-1" href="{{ route('contactUs') }}">تماس باما</a></div>

            </div>
        </div>
    </div>
</footer>
