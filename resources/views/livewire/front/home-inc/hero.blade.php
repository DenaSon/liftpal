<section class="container pt-5 my-5 pb-lg-4">
    <div class="row pt-0 pt-md-2 pt-lg-0">


            @include('livewire.front.home-inc.hero-slider')




        <div class="col-xl-8 col-lg-10 order-3 mt-lg-5 mt-lg-5 w-100 mx-auto d-block">
            <form wire:submit="search" class="form-group d-block panel-search">
                <div class="row g-0 ms-sm-n2">
                    <div class="col-md-10 d-sm-flex ">
                        <div class="dropdown  w-sm-100 border-end-sm">
                            <input type="text" class="form-control" wire:model="search" placeholder="جستجو...">

                        </div>

                        <div class="input-group">

                            <select class="form-select no-arrow-homedrop">
                                <option class="small">جستجوی تکنسین</option>
                                <option>شماره 1</option>
                                <option>شماره 2</option>
                                <option>شماره 3</option>
                            </select>
                        </div>



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
