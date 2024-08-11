@include('livewire.front.home-inc.support-inc.support-modal')
<section class="container mb-5 mt-n3 mt-lg-0">
<div class="tns-carousel-wrapper tns-nav-outside tns-nav-outside-flush mx-2" dir="ltr">
<div class="tns-carousel-inner row gx-4 mx-0 py-3"
 data-carousel-options="{&quot;items&quot;: 4, &quot;controls&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}}}">
<div class="col">
    <div class="card card-hover border-0 h-100 pb-2 pb-sm-3 px-sm-3 text-center"><img
            class="d-block mx-auto my-3" src="{{ asset('assets/img/real-estate/illustrations/calculator.svg') }}"
            width="256" alt="Illustration">

        <div class="card-body">
            <h2 class="h5 card-title mt-3">ماشین حساب</h2>
            <p class="card-text fs-sm">
                با استفاده از ماشین حساب آنلاین ما، هزینه‌های تخمینی تعمیر و نگهداری آسانسور خود را به‌سرعت و با دقت محاسبه کنید. کافی است اطلاعات مربوطه را وارد کنید تا از هزینه‌ها مطلع شوید.
            </p>
        </div>
        <div class="card-footer pt-0 border-0"><a class="btn btn-outline-primary stretched-link"
                                                  href=""> شروع کن</a>
        </div>
    </div>
</div>

<div class="col">

    <div class="card card-hover border-0 h-100 pb-2 pb-sm-3 px-sm-3 text-center"><img
            class="d-block mx-auto my-3" src="{{ asset('assets/img/real-estate/illustrations/support.svg') }}"
            width="256" alt="Illustration">
        <div class="card-body">
            <h2 class="h5 card-title mt-2"> پشتیبانی و مشاوره</h2>
            <p class="card-text fs-sm">
                لیفت‌پال فقط یک سامانه جستجوی متخصصان آسانسور نیست، بلکه حامی شما در انتخاب و نگهداری آسانسور نیز می باشد.
                از مشاوره رایگان متخصصان ما بهره مند شوید.
            </p>
        </div>
        <div class="card-footer pt-0 border-0">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
               شروع
            </button>


        </div>


    </div>
</div>
<div class="col">
    <div class="card card-hover border-0 h-100 pb-2 pb-sm-3 px-sm-3 text-center"><img
            class="d-block mx-auto my-3" src="{{ asset('assets/img/liftpal/eed-illustratin.png') }}"
            width="256" alt="Illustration">
        <div class="card-body">
            <h2 class="h5 card-title">سیستم خطایاب اسانسور</h2>
            <p class="card-text fs-sm">

                با سیستم خطایاب EED، تکنسین‌ها می‌توانند زمان خرابی را کاهش داده و عملکرد بهینه و ایمن آسانسورها را تضمین کنند. EED یک ابزار ضروری برای هر تیم پشتیبانی آسانسور است
                .


            </p>
        </div>
        <div class="card-footer pt-0 border-0"><a  wire:navigate.hover class="btn btn-outline-primary stretched-link"
                                                  href=""> خطایاب </a></div>
    </div>
</div>




</div>
</div>
</section>
