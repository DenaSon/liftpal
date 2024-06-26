

    <div class="modal fade" id="get-address-modal" aria-hidden="true" aria-labelledby="get-address-modalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="get-address-modalLabel">ثبت آدرس ارسال</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form wire:submit="saveAddress">
                        <div class="mb-3">
                            <label for="province" class="form-label">استان</label>
                            <select class="form-select" wire:model="province">
                           <option class="text-muted" value="" label="انتخاب استان">انتخاب استان</option>
                                @include('livewire.front.cart.inc.province')
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">شهر</label>
                            <input class="form-control" id="city" wire:model="city">

                        </div>



                        <button type="submit" class="btn btn-primary">ثبت آدرس</button>


                    </form>
                </div>

            </div>
        </div>
    </div>


