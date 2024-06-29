<!-- Footer-->
<footer class="footer pt-2 @if(request()->route()->getName() !== 'home') bg-white @else bg-secondary @endif">
    <div class="container pt-lg-4 pb-1  bg-secondary">
        <!-- Links-->

            <div class="row pt-0 mb-4">

                        <div  class="col-6 col-xs-6 col-sm-6 col-md-2 d-flex  flex-column justify-content-between mb-sm-0 mb-4  "><a class="d-inline-block mb-4" href="real-estate-home-v1.html"><img
                                    src="{{ asset('assets/img/logo/logo.png') }}" width="116" alt="logo"></a>
                            <ul class="nav flex-column mb-sm-4 mb-2">
                                <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="mailto:{{ getSetting('support_manager_email') }}"><i
                                            class="fi-mail mt-n1 me-2 align-middle opacity-70"></i>{{ getSetting('support_manager_email') }}</a>
                                </li>
                                <li class="nav-item"><a class="nav-link p-0 fw-normal" href="tel:{{getSetting('support_manager_phone')}}"><i
                                            class="fi-device-mobile mt-n1 me-2 align-middle opacity-70"></i>
                                        {{getSetting('support_manager_phone')}}</a></li>
                            </ul>
                            <div class="pt-2"><a
                                    class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2"
                                    href="#"><i class="fi-facebook"></i></a><a
                                    class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2"
                                    href="#"><i class="fi-twitter"></i></a><a
                                    class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2"
                                    href="#"><i class="fi-viber"></i></a><a
                                    class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2"
                                    href="#"><i class="fi-telegram"></i></a></div>
                        </div>

                <div class="col-6 col-xs-6 col-sm-6 col-md-3 mb-sm-0 mb-4 ">
                        <h4 class="h5">خدمات مشتریان</h4>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="#">نحوه ثبت سفارش</a></li>
                            <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="#">رویه ارسال کالا</a></li>
                            <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="#">پیگیری سفارش</a></li>
                        </ul>
                </div>
                <div class=" d-none d-md-block col-md-3 mb-sm-0 mb-4 ">
                        <h4 class="h5">چرا از liftpal خرید کنم؟</h4>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="#">مزایای خرید از liftpal</a></li>
                            <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="#">قوانین و مقررات</a></li>
                        </ul>
                </div>
                <div class="d-none d-md-block col-md-4 my-3 ">
                        <div class="row">
                            <img class="col" src="assets/img/footer/logo-namad.png" style="width: 70px; height: 120px;" alt="">
                            <img class="col" src="assets/img/footer/zarin-namad-enamad.jpg" style="width: 70px; height: 120px;" alt=""></div>
                </div>
            </div>





        <!-- Banner-->
        <div class="row justify-content-center ">
            <div class="col-md-3 d-none d-md-block d-md-block d-flex justify-content-center justify-content-md-start">
                <img class=" mt-2 "
                     src="{{ asset('assets/img/footer/elevator-footer.jpg') }}" width="240" height="240" alt="اپلیکیشن">
            </div>
                <div class=" col-md-9 align-self-center ">
                    <div class="me-md-5 rounded-3 bg-dark p-4">
                        <h4 class="text-light">خدمات آسانسور و فروش قطعات</h4>
                        <p class="mb-lg-0 text-light">ما در فروشگاه خدمات آسانسور، انواع خدمات نصب، تعمیر و نگهداری آسانسورهای مسکونی و تجاری را با بهترین کیفیت ارائه می‌دهیم.
                            آسانسورهای شماست.همچنین، فروش قطعات اصلی و معتبر آسانسور، شامل موتور، کابین، درب و سایر اجزای ضروری، از جمله تخصص‌های ماست. هدف ما اطمینان از عملکرد ایمن و کارآمد
                            ما در فروشگاه خدمات آسانسور، انواع خدمات نصب، تعمیر و نگهداری آسانسورهای مسکونی و تجاری را با بهترین کیفیت ارائه می‌دهیم.
                            همچنین، فروش قطعات اصلی و معتبر آسانسور، شامل موتور، کابین، درب و سایر اجزای ضروری، از جمله تخصص‌های ماست. هدف ما اطمینان از عملکرد ایمن و کارآمد
                            آسانسورهای شماست.</p></div>
                </div>


        </div>

        <div class="text-center fs-sm pt-4 mt-3 pb-2">&copy; تمام حقوق این سایت محفوظ است <a href='' class='d-inline-block nav-link p-0' rel='noopener'></a></div>

    </div>
</footer>
