
<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow" style="width: 35rem;">
        <div class="card-body">
            <h6 class="card-title text-center mb-4">
                <i class="fi-grid text-muted me-3"></i>
                ثبت شرکت
            </h6>

            <hr class="mb-2"/>
            <form wire:submit.debounce.1000ms="registerCompany">


                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="manager_national_code" placeholder="" wire:model="managerNationalCode">
                    <label for="manager_national_code"> کد ملی مالک </label>
                </div>



                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="companyName" placeholder="" wire:model="companyName">
                    <label for="companyName">نام شرکت</label>
                </div>



                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="nationalId" placeholder="" wire:model="licenceCode">
                    <label for="managerNationalCode"> شماره مجوز </label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="economicCode" placeholder="" wire:model="economicCode">
                    <label for="economicCode"> کد اقتصادی</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="registrationCode" placeholder="" wire:model="registrationCode">
                    <label for="registrationCode"> شماره ثبت</label>
                </div>




                <div class="form-floating mb-3">
                    <input readonly data-jdp type="text" class="form-control" id="licenceExpire" placeholder="" wire:model="licenceExpire">
                    <label for="licenceExpire">تاریخ انقضاء مجوز</label>
                </div>


                <div class="form-floating mb-3">
                    <input  type="number" class="form-control" id="telephone" placeholder="" wire:model="telephone">
                    <label for="telephone">تلفن</label>
                </div>


                <div class="form-floating mb-3">

                    <select class="form-select" id="inputSelect" aria-label="Floating label select example" wire:model="province">
                        <option selected value="">انتخاب استان</option>
                        @include('livewire.front.cart.inc.province')
                    </select>
                    <label for="inputSelect">انتخاب استان</label>
                </div>



                <div class="form-floating mb-3">
                    <input  type="text" class="form-control" id="address" placeholder="" wire:model="address">
                    <label for="address">آدرس</label>
                </div>





                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="rules" wire:model="rules">
                    <label class="form-check-label" for="rules">
                        من
                        {{ auth()->user()->profile?->name }}   {{ auth()->user()->profile?->last_name }}
                     صحت اطلاعات فوق را تایید نموده و با
                        <a target="_blank" href="https://liftpal.ir/page/2/"> قوانین و مقررات </a>  موافق هستم
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">ثبت</button>


            </form>
        </div>
    </div>
</div>





