<section class="container pt-5 my-5 pb-lg-4">
    <div class="row pt-0 pt-md-2 pt-lg-0">


        <div class="tns-carousel-wrapper tns-nav-outside tns-nav-outside-flush mx-n2" dir="ltr">
            <div class="tns-carousel-inner row gx-4 mx-0 py-3"
                 data-carousel-options="{&quot;items&quot;: 4, &quot;controls&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}}}">

                <div class="col">
                    <div class="card card-hover border-0 h-100 pb-2 pb-sm-3 px-sm-3 text-center">

                        <img   class="d-block mx-auto my-3" src="{{ asset('admin/assets/images/products/product-11.jpg') }}"
                            width="256" alt="Illustration">

                    </div>
                </div>


                <div class="col">
                    <div class="card card-hover border-0 h-100 pb-2 pb-sm-3 px-sm-3 text-center"><img
                            class="d-block mx-auto my-3"
                            src="{{ asset('assets/img/real-estate/illustrations/find.svg') }}"
                            width="256" alt="Illustration">

                    </div>
                </div>
                <div class="col">
                    <div class="card card-hover border-0 h-100 pb-2 pb-sm-3 px-sm-3 text-center"><img
                            class="d-block mx-auto my-3"
                            src="{{ asset('assets/img/real-estate/illustrations/calculator.svg') }}"
                            width="256" alt="Illustration">

                    </div>
                </div>
                <div class="col">
                    <div class="card card-hover border-0 h-100 pb-2 pb-sm-3 px-sm-3 text-center"><img
                            class="d-block mx-auto my-3"
                            src="{{ asset('assets/img/real-estate/illustrations/support.svg') }}"
                            width="256" alt="Illustration">


                    </div>
                </div>


                <div class="col">
                    <div class="card card-hover border-0 h-100 pb-2 pb-sm-3 px-sm-3 text-center"><img
                            class="d-block mx-auto my-3"
                            src="{{ asset('assets/img/real-estate/illustrations/online-shopping.svg') }}"
                            width="256" alt="Illustration">
                        <div class="card-body">
                            <h2 class="h5 card-title">فروشگاه</h2>
                            <p class="card-text fs-sm">


                                لیفت‌پال به عنوان یک سامانه جامع، در کنار خدمات متنوعی که در زمینه آسانسور ارائه می دهد،
                                فروشگاه آنلاین قطعات و ابزار آسانسور را نیز راه اندازی کرده است.

                            </p>
                        </div>
                        <div class="card-footer pt-0 border-0"><a wire:navigate.hover
                                                                  class="btn btn-outline-primary stretched-link"
                                                                  href="{{ route('shop') }}"> فروشگاه </a></div>
                    </div>
                </div>


            </div>
        </div>


        <div class="col-xl-5 col-lg-6 col-md-7 order-md-1 pt-xl-5 pe-lg-0 mb-3 text-md-start text-center">
            <h1 class="display-4 mt-lg-5 mb-md-4 mb-3 pt-md-4 pb-lg-2"> {{ getSetting('meta_description') }} </h1>
            <p class="position-relative lead ms-lg-n5 fs-6">{{ getMenu('top_description') }}</p>
        </div>

        <div class="col-xl-8 col-lg-10 order-3 mt-lg-n5">
            <form wire:submit="search" class="form-group d-block panel-search">
                <div class="row g-0 ms-sm-n2">
                    <div class="col-md-10 d-sm-flex ">
                        <div class="dropdown w-sm-100 border-end-sm">
                            <input type="text" class="form-control" wire:model="search" placeholder="جستجو...">

                        </div>

                        <div class="input-group">

                            <select class="form-select no-arrow-homedrop">
                                <option class="small">انتخاب گزینه جستجو</option>
                                <option>مجری</option>
                                <option>نصاب</option>
                                <option>تعمیرکار</option>
                                <option class="text-info highlight">فروشگاه</option>
                            </select>
                        </div>

                        <hr class="d-sm-none my-2">

                    </div>
                    <hr class="d-md-none mt-4">
                    <div class="col-md-2 d-sm-flex justify-content-end align-items-end pt-4 pt-md-0">

                        <button class="btn btn-icon btn-primary px-3 w-100 w-sm-auto flex-shrink-0" type="submit"><i
                                class="fi-search"></i><span class="d-sm-none d-inline-block ms-2"> جستجو</span></button>
                    </div>

                </div>
            </form>
        </div>


    </div>
</section>
