<section class="card card-body border-0 shadow-sm p-4 mb-4 text-center" id="basic-info">

    <div class="cart-header mb-4"><i class="fi-calculator text-primary fs-5 mt-n1 me-2"></i>
        <b>
            محاسبات {{ $calcName }}
        </b>

    </div>
    <div class="row">
        <div class="col-sm-12 mb-3">

            <div>
                <form wire:submit.prevent="calcCabinArea" class="p-2">


                    <div class="mb-3">
                        <label for="length" class="form-label"> طول  </label>
                        <input class="form-control"  type="number" wire:model="length" id="length" placeholder="طول" step="0.01">

                    </div>

                    <div class="mb-3">
                        <label for="width" class="form-label"> عرض </label>
                        <input class="form-control" type="number" wire:model="width" id="width" placeholder="عرض" step="0.01">
                    </div>

                    <div class="mb-3">
                        <div x-data="{ thickness: 0.5 }" class="mb-3">
                            <label for="thickness-input" class="form-label"> ضخامت دیواره کابین</label>
                            <input x-model="thickness" class="form-range" type="range" id="thickness-input" wire:model="thickness" min="0.1" max="10" value="100" step="0.1">
                         <span disabled class="btn btn-outline-dark">  <span x-text="thickness"></span></span>
                        </div>

                    </div>


                    <button class="btn btn-info mb-2" type="submit">محاسبه </button>
                </form>

                <div class="d-flex justify-content-center m-2">

                    <button wire:loading type="button" class="btn btn-primary btn-icon">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>

                @if($elevatorCabinArea)
                    <div class="bg-faded-success p-4 border border-success border-2">

                    <p class="alert alert-accent p-2"> مساحت کابین: {{ ($elevatorCabinArea) }} متر مربع </p>

                    </div>
                @endif
            </div>


            <hr class="pt-2"/>
            <br/>
        </div>

    </div>

    <div class="text-justify">

       <h4 class="h6">نکات مرتبط با محاسبات</h4>
            <ul>
            <li>
                این محاسبات برای محاسبه مساحت کابین آسانسور بر اساس طول، عرض و ضخامت دیواره کابین استفاده می شود.



            </li>
            <li>
                در طراحی کابین آسانسور، باید به فضای مورد نیاز برای درب ها، پنل های کنترل، سیستم تهویه و سایر تجهیزات نیز توجه کرد.

            </li>
            <li>
                در این محاسبات ضخامت دیواره کابین به عنوان یک عامل تقریبی در نظر گرفته شده است.

            </li>

        </ul>





    </div>


</section>
