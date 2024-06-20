<section class="card card-body border-0 shadow-sm p-4 mb-4 text-center" id="basic-info">

    <div class="cart-header mb-4"><i class="fi-calculator text-primary fs-5 mt-n1 me-2"></i>
        <b>
            محاسبات {{ $calcName }}
        </b>

    </div>
    <div class="row">
        <div class="col-sm-12 mb-3">

            <div>
                <form wire:submit.prevent="calcAngle" class="p-2">


                    <div class="mb-3">
                        <label for="length" class="form-label"> طول فلکه  </label>
                        <input class="form-control"  type="number" wire:model="length" id="length" placeholder="طول فلکه (متر)" step="0.1">
                        @error('length') <span class="small text-danger"> {{ $message }} </span> @enderror

                    </div>

                    <div class="mb-3">
                        <label for="diameter" class="form-label"> قطر فلکه </label>
                        <input class="form-control" type="number" wire:model="diameter" id="diameter" placeholder="قطر فلکه (متر)" step="0.1">
                        @error('diameter') <span class="small text-danger"> {{ $message }} </span> @enderror
                    </div>


                    <button class="btn btn-info mb-2" type="submit">محاسبه </button>
                </form>

                <div class="d-flex justify-content-center m-2">

                    <button wire:loading type="button" class="btn btn-primary btn-icon">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>

                @if($result)
                    <div class="bg-faded-success p-4 border border-success border-2">

                        <p class="alert alert-accent p-2"> زاویه خم معکوس: {{ ($result) }} درجه </p>

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
                این  محاسبه فقط برای محاسبه زاویه خم معکوس تقریبی در فلکه های هرزگرد معکوس گرلس با آرایش 2:1 کاربرد دارد.

            </li>



        </ul>





    </div>


</section>
