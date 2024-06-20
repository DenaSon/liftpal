<!--=====================================
            NEWSLETTER PART START
=======================================-->
<section class="news-part" style="background: url('https://atel.ir/products/cid-36/%D8%AF%D9%86%D8%AF%D8%A7%D9%86-%D9%BE%D8%B2%D8%B4%DA%A9%DB%8C') no-repeat center;">
    <div class="container">
        <div class="row align-مورد-center">
            <div class="col-md-5 col-lg-6 col-xl-7">
                <div class="news-text">
                    <h2>%20 تخفیف برای عضویت در خبرنامه</h2>
                    <p class="news-text-p">به جمع مشتریان ویژه آتل بپیوندید و از فرصت‌های اختصاصی بهره‌مند شوید. سریع و رایگان!</p>
                </div>
            </div>
            <div class="col-md-7 col-lg-6 col-xl-5">
                <form class="news-form" method="post" action="{{ route('storeNewsletter') }}">
                    @csrf
                    <input name="email" type="text" placeholder="آدرس ایمیل خود را وارد کنید">
                    <button><span><i class="icofont-ui-email"></i>عضویت</span></button>
                </form>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            NEWSLETTER PART END
=======================================-->
