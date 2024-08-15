<div>
    <form wire:submit.debounce.500ms="sendRequest">
        <div class="card shadow-lg mt-3">

            <div class="card-body mt-2">
                <div class="text-center">
                    <div class="badge bg-warning fs-xs" wire:loading>لطفا صبر کنید...</div>
                </div>

                <div class="form-floating mt-3">
                    <select wire:model.live.500ms="building_id" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option value="" selected>انتخاب ساختمان</option>
                        @foreach($building_list as $building)
                            <option value="{{ $building->id }}">ساختمان {{ $building->builder_name }} {{ $building->floors }} طبقه</option>
                        @endforeach
                    </select>

                    <label for="floatingSelect">
                        انتخاب ساختمان
                        <span class="text-danger">*</span>
                    </label>
                </div>



                @if($elevator_list)
                    <div class="form-floating mt-3">
                        <select wire:model.live.500ms="elevator_id" class="form-select" id="elevatorSelect" aria-label="Floating label select example">
                            <option value="" selected>انتخاب آسانسور</option>
                            @foreach($elevator_list as $elevator)
                                <option value="{{ $elevator->id }}">
                                    {{ $elevator->getType() }} ({{ $elevator->model }}) </option>
                            @endforeach
                        </select>
                        <label for="elevatorSelect">
                             انتخاب آسانسور
                            <span class="text-danger">*</span>
                        </label>
                    </div>
                @endif

                <div class="form-floating mt-3">
                    <select wire:model="fault_cause" class="form-select" id="elevator_faults" aria-label="Floating label select example">
                        <option selected value="نامشخص">انتخاب علت ایراد</option>
                        <option value="نامشخص">علت نامشخص </option>
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
                    <label for="elevator_faults">
                    انتخاب علت ایراد فنی
                        <span class="text-success">*</span>
                    </label>
                </div>

                <div class="mt-3 form-floating">
                    <textarea wire:model="description" class="form-control" placeholder="توضیح مختصر علت خرابی (اختیاری)" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">
                        <i class="fi-pencil text-primary"></i> توضیح مختصر ایراد فنی (اختیاری)
                    </label>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-success btn-md">
                    <i class="bi bi-send-fill"></i> ارسال درخواست
                </button>
            </div>

        </div>
    </form>


    <div class="card mt-3 shadow-lg">
        <div class="row card-body d-flex justify-content-center">

            <!-- Primary spinner -->
            <div class="spinner-grow  text-primary" role="status" style="width: 5rem; height: 5rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div>
            <p class="col card-text text-center my-3 fs-4">در انتظار تایید تکنسین</p>
            </div>
        </div>
    </div>

</div>
