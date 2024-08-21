<div>
    @if(!auth()->user()->hasBuilderRequests())
        <form wire:submit.debounce.500ms="sendRequest">
            <div class="card shadow-lg mt-3">

                <div class="card-body mt-2">


                    <div class="form-floating mt-3">
                        <select wire:model.live.500ms="building_id" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                            <option value="" selected>انتخاب ساختمان</option>
                            @foreach($building_list as $building)
                                <option value="{{ $building->id }}">
                                    ساختمان {{ $building->builder_name }} {{ $building->floors }} طبقه
                                </option>
                            @endforeach
                        </select>

                        <label for="floatingSelect">
                            انتخاب ساختمان
                            <span class="text-danger">*</span>
                        </label>
                    </div>


                    @if($elevator_list)
                        <div class="form-floating mt-3 ">
                            <select wire:model.live.500ms="elevator_id" class="form-select" id="elevatorSelect"
                                    aria-label="Floating label select example">
                                <option value="" selected>انتخاب آسانسور</option>
                                @foreach($elevator_list as $elevator)
                                    <option value="{{ $elevator->id }}">
                                        {{ $elevator->getType() }} ({{ $elevator->national_code }})
                                    </option>
                                @endforeach
                            </select>
                            <label for="elevatorSelect">
                                انتخاب آسانسور
                                <span class="text-danger">*</span>
                            </label>
                        </div>
                    @endif

                    <div class="form-floating mt-3">
                        <select wire:model="fault_cause" class="form-select" id="elevator_faults"
                                aria-label="Floating label select example">
                            <option selected value="نامشخص">انتخاب علت ایراد</option>
                            <option value="نامشخص">علت نامشخص</option>
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
                        <textarea wire:model="description" class="form-control"
                                  placeholder="توضیح مختصر علت خرابی (اختیاری)" id="floatingTextarea2"
                                  style="height: 100px"></textarea>
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

    @else
        <script>
            window.addEventListener('beforeunload', function (e) {

                var confirmationMessage = 'آیا مطمئن هستید که می‌خواهید این صفحه را ترک کنید؟ تغییرات شما ممکن است ذخیره نشده باشند.';

                e.returnValue = confirmationMessage;
                return confirmationMessage;
            });
        </script>
        <style>

        </style>
        <div class="card mt-3 shadow-lg waiting-card">
            <div class="row card-body d-flex justify-content-center align-items-center flex-column">
                <p class="col card-text text-center fs-4 text-waiting text-primary mb-1">در انتظار تایید کارشناس فنی</p>
                <div class="spinner-border fs-4 text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="text-muted text-center mt-4">
                    <p>
                        درخواست شما برای کارشناسان فنی ارسال شد
                    </p>
                    @if(auth()->user()->activeRequests()->count() > 0 )
                    <div class="text-info fs-xs">  15 دقیقه زمان انتظار </div>

                    @endif
                </div>
            </div>
        </div>

    @endif

    @if(auth()->user()->activeRequests()->count() > 0 )

            <div class="accordion mt-3 shadow-lg rounded-3" id="accordion-requestlist">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            آخرین درخواست ها
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion-requestlist">
                        <div class="accordion-body">

                            <div class="table-responsive mt-1">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>شماره</th>
                                        <th>زمان</th>

                                        <th>ساختمان</th>
                                        <th>کارشناس </th>
                                        <th>درخواست</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($request_list as $index => $request)

                                        <tr class="
                            @switch($request->status)
                            @case('accepted')
                             bg-faded-success border-success
                             @break
                             @case('cancelled')
                            bg-faded-dark
                            @break
                             @case('rejected')
                              bg-faded-danger
                              @break
                              @case('pending')
                              bg-faded-warning
                              @break
                              
                              @default
                              bg-faded-primary
                            @endswitch
                            ">
                                            <th scope="row">{{ $index +1 }}</th>
                                            <td>{{ $request->referral }}</td>
                                            <td class="fs-xs text-waiting">{{ jdate($request->created_at)->ago() }}</td>

                                            <td>{{ $request->building->builder_name}}</td>
                                            <td>
                                                {{ $request->technician->profile->name }}
                                                {{ $request->technician->profile->last_name }}
                                            </td>
                                            <td> {{ $request->getStatus() }} </td>
                                        </tr>
                                        <div wire:poll.visible.10s="requestsTimeout"></div>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>








    @endif




</div>
