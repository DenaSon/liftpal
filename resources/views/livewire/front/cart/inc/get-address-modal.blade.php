<div class="modal fade" id="get-address-modal" aria-hidden="true" aria-labelledby="get-address-modalLabel" tabindex="-1" wire:ignore>
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="get-address-modalLabel">ثبت آدرس ارسال</h1>
                <button type="button" class="btn-close me-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="saveAddress">
                    <div class="row align-items-center">
                        <div class="col-6 mb-3">
                            <label for="province" class="form-label ">استان</label>
                            <span class="text-danger">*</span>
                            <select class="form-select " wire:model="province" >
                                <optgroup selected disabled value="" label="انتخاب استان">انتخاب استان</optgroup>
                                @include('livewire.front.cart.inc.province')
                            </select>

                        </div>

                        <div class="col-6 mb-3">
                            <label for="city" class="form-label ">شهر</label>
                            <span class="text-danger">*</span>
                            <input class="form-control" id="city" wire:model="city" placeholder="نام شهر">

                        </div>
                    </div>
                    <div class="col mb-3">
                        <label for="postal-address" class="form-label ">آدرس پستی</label>
                        <span class="text-danger">*</span>
                        <textarea placeholder="محله،خیابان،کوچه..." wire:model="postal_address" class="form-control" id="postal-address" rows="3"></textarea>

                    </div>

                    <div class="row align-items-center">

                        <div class="col-4 mb-3">
                            <label for="postal-code" class="form-label ">کد پستی</label>
                            <span class="text-danger">*</span>
                            <input wire:model="postal_code" type="number" class="form-control no-spinner" id="postal-code" placeholder="کد 10 رقمی">

                        </div>

                        <div class="col-4 mb-3">
                            <label for="building-number" class="form-label">پلاک</label>
                            <input wire:model="building_number" type="number" class="form-control no-spinner" id="building-number" placeholder="اختیاری">

                        </div>

                        <div class="col-4 mb-3">
                            <label for="unit-number" class="form-label">شماره واحد</label>
                            <input wire:model="unit_number" type="number" class="form-control no-spinner" id="unit-number" placeholder="اختیاری">

                        </div>
                    </div>

                        <div class="d-flex justify-content-center align-items-center mt-4"  >

                             <button type="submit" class="btn btn-primary ">ثبت آدرس</button>

                        </div>

                </form>


            </div>
        </div>
    </div>


</div>
