<section class="card card-body border-0 shadow-sm p-4 mb-4 text-center" id="basic-info">

    <div class="cart-header mb-4"><i class="fi-calculator text-primary fs-5 mt-n1 me-2"></i>
        <b>
            محاسبات {{ $calcName }}
        </b>

    </div>
    <div class="row">
        <div class="col-sm-12 mb-3">

            <div>
                <form wire:submit.prevent="calcCapacity" class="p-2">


                    <div class="mb-3">
                        <label for="length" class="form-label"> حداکثر وزن </label>
                        <input class="form-control" type="number" wire:model="maxWeight" id="length"
                               placeholder="حداکثر وزن مجاز" step="0.01">
                       @error('maxWeight')   <label class="small text-danger"> {{ $message }}</label> @enderror

                    </div>


                    <button class="btn btn-info mb-2" type="submit">محاسبه</button>
                </form>

                <div class="d-flex justify-content-center m-2">

                    <button wire:loading type="button" class="btn btn-primary btn-icon">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>

                @if($elevatorCapacity)
                    <div class="bg-faded-success p-4 border border-success border-2">

                        <p class="alert alert-accent p-2"> ظرفیت آسانسور : {{ ($elevatorCapacity) }} نفر </p>
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
                این محاسبه بر اساس فرض وزن 75 کیلوگرم برای هر نفر انجام شده است
            </li>
            <li>
                در صورتی که وزن افراد به طور متوسط بیشتر یا کمتر از 75 کیلوگرم باشد، ظرفیت آسانسور نیز به طور متناسب تغییر خواهد کرد.

            </li>

            <li>
                حداکثر وزن مجاز آسانسور توسط طراح و سازنده آن تعیین می‌شود.

            </li>
            <li>
                در آسانسورهای مسافربری، حداکثر وزن مجاز هر نفر 75 کیلوگرم در نظر گرفته می‌شود.

            </li>
            <li>
                ظرفیت آسانسور باید به گونه‌ای باشد که در شلوغ‌ترین زمان روز، بیش از حد مجاز بارگیری نشود.

            </li>
            <li>
                رعایت ظرفیت مجاز آسانسور برای حفظ ایمنی و سلامت افراد ضروری است.

            </li>
        </ul>


    </div>


</section>
