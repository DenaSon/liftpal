

    <div class="modal fade" id="get-address-modal" aria-hidden="true" aria-labelledby="get-address-modalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="get-address-modalLabel">ثبت آدرس ارسال</h1>
                    <button type="button" class="btn-close me-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="saveAddress">
                        <div class="row align-items-center">
                        <div class="col-6 mb-3">
                            <label for="province" class="form-label">استان</label>
                            <select class="form-select" wire:model="province">
                           <option class="text-muted" value="" label="انتخاب استان">انتخاب استان</option>
                                @include('livewire.front.cart.inc.province')
                            </select>
                            @error('province') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-6 mb-3">
                            <label for="city" class="form-label">شهر</label>
                            <input class="form-control" id="city" wire:model="city">
                            @error('city') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        </div>
                                <div class="col mb-3">
                                    <label for="postal-address" class="form-label">آدرس پستی</label>
                                    <textarea class="form-control" id="postal-address" rows="3"></textarea>
                                @error('city') <span class="error">{{ $message }}</span> @enderror
                                 </div>

                            <div class="row align-items-center">

                                <div class="col-4 mb-3">
                                         <label for="postal-code" class="form-label">کد پستی</label>
                                         <input type="number" class="form-control" id="postal-code" aria-describedby="numberHelp">
                                         @error('city') <span class="error">{{ $message }}</span> @enderror
                                     </div>

                                <div class="col-4 mb-3">
                                    <label for="building-number" class="form-label">پلاک</label>
                                     <input type="number" class="form-control" id="building-number" aria-describedby="numberHelp">
                                      @error('city') <span class="error">{{ $message }}</span> @enderror
                                    </div>

                                <div class="col-4 mb-3">
                                    <label for="unit-number" class="form-label">شماره واحد</label>
                                    <input type="number" class="form-control" id="unit-number" aria-describedby="numberHelp">
                                    @error('city') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>



                        <button type="submit" class="btn btn-primary">ثبت آدرس</button>


                    </form>


            </div>
        </div>
    </div>

    </div>
