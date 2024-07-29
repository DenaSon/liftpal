<div>


    @include('livewire.front.home-inc.header')
    @include('livewire.front.user.expert-inc.navigation')


    <section class="container mb-5 pb-1">
        <div class="row">
            <div class="col-md-7 mb-md-0 mb-4"><span class="badge bg-success me-2 mb-3">تایید</span><span class="badge bg-info me-2 mb-3">جدید</span>
                <h2 class="h4 mb-4 pb-4 border-bottom">2,150,000 تومان<span class="d-inline-block ms-1 fs-base fw-normal text-body">/ماهیانه</span></h2>
                <!-- Overview-->
                <div class="mb-4 pb-md-3">
                    <h3 class="h5">توضیحات</h3>
                    <p class="mb-1 line-h18">طرح‌نما یا لورم ایپسوم به نوشتاری آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این نوشتار
                        به‌عنوان عنصری از ترکیب‌بندی برای پُر کردن صفحه و ارائهٔ اولیهٔ شکل ظاهری و کلیِ طرح سفارش‌گرفته‌شده‌استفاده می‌کند، تا ازنظر گرافیکی نشانگر چگونگی نوع
                        و اندازهٔ قلم و ظاهرِ متن باشد. </p>
                    <div class="collapse" id="seeMoreOverview">
                        <p class="mb-1">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون
                            و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. </p>
                    </div>
                    <a class="collapse-label collapsed" href="#seeMoreOverview" data-bs-toggle="collapse" data-bs-label-collapsed="مشاهده بیشتر" data-bs-label-expanded="بستن"
                       role="button" aria-expanded="false" aria-controls="seeMoreOverview"></a>
                </div>

                <!-- Amenities-->
                <div class="mb-sm-3">
                    <h3 class="h5">مهارت ها</h3>
                    <ul class="list-unstyled row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-1 mb-1 text-nowrap">
                        <li class="col"><i class="fi-wifi mt-n1 me-2 fs-lg align-middle"></i>وای فای</li>
                        <li class="col"><i class="fi-thermometer mt-n1 me-2 fs-lg align-middle"></i>سیستم گرمایشی</li>
                        <li class="col"><i class="fi-dish mt-n1 me-2 fs-lg align-middle"></i>استخر</li>
                        <li class="col"><i class="fi-parking mt-n1 me-2 fs-lg align-middle"></i>پارکینگ</li>
                        <li class="col"><i class="fi-snowflake mt-n1 me-2 fs-lg align-middle"></i>تهویه هوا</li>
                        <li class="col"><i class="fi-iron mt-n1 me-2 fs-lg align-middle"></i>گاز رومیزی</li>
                        <li class="col"><i class="fi-tv mt-n1 me-2 fs-lg align-middle"></i>تلویزیون</li>
                        <li class="col"><i class="fi-laundry mt-n1 me-2 fs-lg align-middle"></i>ماشین لباسشویی</li>
                        <li class="col"><i class="fi-cctv mt-n1 me-2 fs-lg align-middle"></i>دوربین مداربسته</li>
                    </ul>
                </div>

                <hr class="mb-2"/>

                @include('livewire.front.user.expert-inc.comment-form')


                <div class="mb-4 pb-4 border-bottom">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex align-items-center pe-2">
                            <div class="ps-2">
                                <h6 class="fs-base mb-0">فلوید مایلز</h6><span class="star-rating"><i class="star-rating-icon fi-star-filled active"></i><i
                                        class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i
                                        class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i></span>
                    </div>
                        </div>
                        <span class="text-muted fs-sm">14 شهریور , 1399</span>
            </div>
                    <p>رکتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی
                        الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به
                        پایان رسد</p>
                    <div class="d-flex align-items-center">
                        <button class="btn-like" type="button"><i class="fi-like"></i><span>(2)</span></button>
                        <div class="border-end me-1">&nbsp;</div>
                        <button class="btn-dislike" type="button"><i class="fi-dislike"></i><span>(1)</span></button>
                    </div>
                </div>

                <!-- Pagination-->
                <nav class="mt-2 mb-4" aria-label="Reviews pagination">
                    <ul class="pagination">
                        <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span></li>
                        <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">1<span class="visually-hidden">صفحه جاری</span></span></li>
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="#">2</a></li>
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="#">3</a></li>
                        <li class="page-item d-none d-sm-block">...</li>
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="#">8</a></li>
                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><i class="fi-chevron-right"></i></a></li>
                    </ul>
                </nav>
            </div>
            <!-- Sidebar-->
            @include('livewire.front.user.expert-inc.sidebar')
        </div>

    </section>


    @include('livewire.front.home-inc.footer')





</div>
