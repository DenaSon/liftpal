<div wire:ignore class="modal fade" id="cost-calculator" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-block position-relative border-0 px-sm-5 px-4">
                <h3 class="h4 modal-title mt-4 text-center">به دنبال خانه هستید؟</h3>
                <button class="btn-close position-absolute top-0 end-0 mt-3 me-3" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 px-4">
                <form class="needs-validation" novalidate >
                    <div class="mb-3">
                        <label class="form-label fw-bold mb-2" for="property-city">انتخاب موقعیت</label>
                        <select wire:model.live.debounce.150ms="selectedOption" class="form-control form-select" id="property-city" required>
                            <option value="0" selected disabled hidden>انتخاب شهر</option>
                            <option value="1">شیکاگو</option>
                            <option value="2">پاریس</option>
                            <option value="3">فرانسه</option>
                            <option value="4">نیویورک</option>
                            <option value="5">سن فراسیسکو</option>
                        </select>
                        <div class="invalid-feedback">لطفا شهر را انتخاب کنید.</div>
                    </div>

                    <button class="btn btn-primary d-block w-100 mb-4" type="submit"><i class="fi-calculator me-2"></i>محاسبه</button>
                </form>
            </div>
        </div>
    </div>

</div>
