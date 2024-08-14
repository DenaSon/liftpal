<div wire:ignore class="modal fade" id="teqnician-action-building" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">



    @if($building?->count()> 0 )
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form  wire:submit.prevent="sendFaultRequest">
            <div class="modal-header ">
                <h1 class="modal-title fs-5 bg-soft-success h5 fs-sm" id="staticBackdropLabel">
                  درخواست تعمیر ساختمان
                    <input wire:model="building_name" type="button" class="btn btn-outline-secondary btn-xs " disabled>

                </h1>

                <button type="button" class="btn-close me-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <div class="modal-body">


                @if($building->elevators->count() == 1)
                <div class="col-12 mb-4">

               آسانسور :  {{ $building?->elevators?->first()?->model. ' '. $building?->elevators?->first()?->getType() }}

                </div>

                @else

                    <select wire:model="broken_elevator_id" id="elevator_faults" class="form-select">
                      @foreach($elevator_list as $elevator)
                          <option value="{{ $elevator->id  }}"> {{ $elevator->model . '    ' . $elevator->getType() }}  </option>
                      @endforeach
                    </select>
                @endif

                <div class="mt-2">

                    <select wire:model="failure_cause" id="elevator_faults" class="form-select">
                        <option selected value="نامشخص">علت نامشخص</option>
                        <option value="خرابی درب‌ها">خرابی درب‌ها</option>
                        <option value="خرابی موتور">خرابی موتور</option>
                        <option value="خرابی تابلو فرمان">خرابی تابلو فرمان</option>
                        <option value="خرابی کابل‌ها و سیم‌کشی‌ها">خرابی کابل‌ها و سیم‌کشی‌ها</option>
                        <option value="خرابی سیستم ترمز">خرابی سیستم ترمز</option>
                        <option value="خرابی گیربکس">خرابی گیربکس</option>
                        <option value="خرابی سیستم هیدرولیک">خرابی سیستم هیدرولیک</option>
                        <option value="خرابی سنسورها">خرابی سنسورها</option>
                        <option value="خرابی سیستم اضطراری">خرابی سیستم اضطراری</option>
                        <option value="خرابی سیم بکسل‌ها و قرقره‌ها">خرابی سیم بکسل‌ها و قرقره‌ها</option>
                        <option value="خرابی سیستم خنک‌کننده">خرابی سیستم خنک‌کننده</option>
                        <option value="خرابی درب طبقات">خرابی درب طبقات</option>
                        <option value="خرابی باتری‌های پشتیبان">خرابی باتری‌های پشتیبان</option>
                        <option value="خرابی سیستم اعلام خرابی">خرابی سیستم اعلام خرابی</option>
                        <option value="خرابی نورپردازی کابین">خرابی نورپردازی کابین</option>
                    </select>


                </div>

                <div class="mt-2">
                    <div class="form-floating">
                        <textarea wire:model="failure_description" class="form-control" placeholder="توضیح مختصر علت خرابی (اختیاری)" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">توضیح مختصر ایراد فنی (اختیاری)</label>
                    </div>
                </div>



            </div>

            <div class="modal-footer d-flex justify-content-sm-center justify-content-md-end">
                <button  type="submit" class="btn btn-success btn-xs w-25">ارسال درخواست</button>
                <button type="button" class="btn btn-primary btn-xs" data-bs-dismiss="modal">بستن</button>
            </div>
            </form>
        </div>
    </div>
    @endif
</div>
