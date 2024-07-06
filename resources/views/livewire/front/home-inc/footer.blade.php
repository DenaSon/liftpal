<!-- Footer-->
<footer class="footer pt-2 bg-secondary">
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
                            <li class="nav-item mb-2"><a wire:navigate class="nav-link p-0 fw-normal" href="{{ route('shop') }}">فروشگاه</a></li>
                        </ul>
                </div>
                <div class=" d-none d-md-block col-md-3 mb-sm-0 mb-4 ">
                        <h4 class="h5">چرا از liftpal خرید کنم؟</h4>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="#">مزایای خرید از liftpal</a></li>
                            <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="#">قوانین و مقررات</a></li>
                        </ul>
                </div>



                    <div class="d-none d-md-block col-md-4 mt-5 p-0 mx-auto ">

                            <img class="img-thumbnail" src="{{ asset('assets/img/footer/logo.enamad.png') }}" width="100" height="100" alt="Logo Namad">

                            <img class="img-thumbnail" src="{{ asset('assets/img/footer/logo.samandehi.png') }}" width="110" height="100" alt="Samandehi">

                            <img class="img-thumbnail" src="{{ asset('assets/img/footer/logo.etehadie.png') }}" width="90" height="90" alt="Samandehi">

                            <img class="img-thumbnail" src="{{ asset('assets/img/footer/logo.asnaf.png') }}" width="90" height="90" alt="Samandehi">
                    </div>

            </div>





        <!-- Banner-->
        <div class="row container justify-content-center ps-0 ">
            <div class="col-md-3 d-none ms-md-0 d-md-block d-md-block d-flex justify-content-center justify-content-md-start">
                <img class="me-2 ms-0 ps-0 mt-2 "
                     src="{{ asset('assets/img/footer/elevator.png') }}" width="310" height="310" alt="لیفت‌پال">
            </div>
                <div class=" col-md-9 align-self-center ">
                    <div class=" rounded-3 bg-dark p-4 m-0">


                        <h4 class="text-light m-0">لیفت‌پال</h4>
                        <p class="text-justify text-light text-shadow-lg" style="line-height:30px">
                            آیا آماده‌اید تا تجربه‌ای جدید از مدیریت آسانسورهای ساختمان خود داشته باشید؟ سامانه آنلاین ما، یک پلتفرم هوشمند و جامع است که تمامی نیازهای شما را
                            پوشش می‌دهد. از هماهنگی با تکنسین‌های ماهر، تا خرید قطعات باکیفیت و ارتباط مستقیم با مدیران ساختمان – همه و همه در یک جا!
                            ما به شما کمک می‌کنیم تا امور نگهداری و تعمیرات آسانسورهای خود را به سادگی و با اطمینان بیشتری مدیریت کنید.
                        </p>

                    </div>
                </div>


        </div>

        <div class="text-center fs-sm pt-4 mt-3 pb-2">&copy; تمام حقوق این سایت محفوظ است <a href='' class='d-inline-block nav-link p-0' rel='noopener'></a></div>

    </div>
</footer>
