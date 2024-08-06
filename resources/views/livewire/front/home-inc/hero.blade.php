<section class="container pt-5 my-5 pb-lg-4">
    <div class="row pt-0 pt-md-2 pt-lg-0">


            @include('livewire.front.home-inc.hero-slider')


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
