<div class="border rounded shadow-sm p-4 mt-3">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex justify-content-center">
                <div class=" ps-2 text-center">
                    <label class="form-label fw-bold">مدیریت آسانسور</label>
                    <div id="elevator_count">{{ $elevator_list->count() }} آسانسور ثبت شده</div>
                </div>
            </div>
        </div>

    </div>

    <div class="container mt-3">


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success d-block w-100" data-bs-toggle="modal"
                data-bs-target="#add-elevator">
            <i class="fi-plus-circle me-1 fs-sm"></i>
            ثبت آسانسور
        </button>

        <!-- Modal -->
        <div wire:ignore class="modal fade" id="add-elevator" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h1 class="modal-title fs-5 bg-soft-success" id="add-elevator">افزودن آسانسور </h1>

                        <button type="button" class="btn-close me-0" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row ">

                            <div class="col-12 mb-4">
                            <select @if($building_list->count() == 1) hidden="hidden" @endif wire:model="building_id" class="form-select border border-danger" aria-label="Default select example">
                                <option selected disabled>انتخاب ساختمان</option>
                                @foreach($building_list as  $index => $building)
                                <option @if($building_list->count() == 1) selected
                                        @endif wire:key="{{ $building->id }}" value="{{ $building->id }}"> {{ $index+1 }} - ({{ $building->builder_name }})
                                <span class="fs-xxs"> {{ \Illuminate\Support\Str::limit($building->address,25) }}</span>
                                </option>



                                @endforeach
                            </select>
                                @if($building_list->count() == 1)
                                    <div class="text-center">
                                        <span class="badge bg-secondary"> افزودن آسانسور ساختمان  {{ $building->builder_name }}  </span>
                                    </div>
                                @endif
                            </div>



                            <div class="form-floating col-12 mb-3">
                                <input wire:model="model" type="text" class="form-control" id="floatingInput" placeholder="مدل">
                                <label for="floatingInput">مدل آسانسور</label>
                            </div>

                            <div class="form-floating col-12 mb-3">
                                <input wire:model="capacity" type="number" class="form-control" id="floatingInput"
                                       placeholder="ظرفیت (نفر)">
                                <label for="floatingInput">ظرفیت (نفر)</label>
                            </div>


                            <div class="form-floating col-12 mb-3">
                                <select wire:model="type" class="form-select custom-select-height-building "
                                        aria-label="Default select example">

                                    <option value="" disabled selected> انتخاب مدل  </option>
                                    <option value="passenger">آسانسور مسافری</option>
                                    <option value="freight">آسانسور باربری</option>
                                    <option value="service">آسانسور خدماتی</option>
                                    <option value="hospital">آسانسور بیمارستانی</option>
                                    <option value="panoramic">آسانسور پانوراما (شیشه‌ای)</option>
                                    <option value="dumbwaiter">آسانسور غذا بر (دوم ویتور)</option>
                                    <option value="home">آسانسور خانگی</option>
                                    <option value="vehicle">آسانسور خودرویی</option>
                                </select>

                            </div>


                            <div class="form-floating col-12 mb-3">
                                <input wire:model="manufacturer" type="text" class="form-control" id="floatingInput"
                                       placeholder="کارخانه">
                                <label for="floatingInput">کارخانه</label>
                            </div>

{{--                            <div class="form-floating col-12 mb-3">--}}
{{--                                <input wire:model="installation_date" type="text" class="form-control" id="floatingInput"--}}
{{--                                       placeholder="تاریخ نصب">--}}
{{--                                <label for="floatingInput">تاریخ نصب</label>--}}
{{--                            </div>--}}

{{--                            <div class="form-floating col-12 mb-3">--}}
{{--                                <input wire:model="last_inspection_date" type="text" class="form-control" id="floatingInput"--}}
{{--                                       placeholder="تاریخ آخرین بازرسی">--}}
{{--                                <label for="floatingInput">تاریخ آخرین بازرسی</label>--}}
{{--                            </div>--}}

{{--                            <div class="form-floating col-12 mb-3">--}}
{{--                                <input wire:model="last_maintenance_date" type="text" class="form-control" id="floatingInput"--}}
{{--                                       placeholder="تاریخ تعمیر">--}}
{{--                                <label for="floatingInput">تاریخ تعمیر</label>--}}
{{--                            </div>--}}

                            <div class="form-floating col-12 mb-3">
                                <select wire:model="status" class="form-select custom-select-height-building" id="customSelect"
                                        aria-label="Default select example">
                                    <option selected class="m-auto">وضعیت آسانسور</option>
                                    <option value="active"> فعال</option>
                                    <option value="deactivate">غیر فعال</option>
                                    <option value="maintenance">درحال تعمیر</option>
                                </select>
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button wire:click.debounce.250="addElevator" type="button" class="btn btn-success btn-xs w-25">ثبت</button>
                        <button type="button" class="btn btn-primary btn-xs" data-bs-dismiss="modal">بستن
                        </button>

                    </div>
                </div>
            </div>
        </div>


    </div>



    <div class="accordion mt-2" id="accordionelevator">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button text-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    آسانسور های ثبت شده
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionelevator">
                <div class="accordion-body">
                    <ul class="list-group">
                 @if($elevator_list->count() > 0)
                            @foreach($elevator_list as $index => $elevator)


                                <li wire:key="{{ $elevator->id }}" class="list-group-item d-flex justify-content-between align-items-center  ">
                <span>
                    <i class="fi-sidebar-left text-success me-2"></i>
              آسانسور      {{ $elevator->getType($elevator->type) }}
                    {{ $elevator->capacity }} نفره
              مدل
                    <span class="text-muted">({{ $elevator->model }})</span> -
                    ساختمان : {{ $elevator->building()->first()->builder_name }}
                    </span>
                                    <a href="javascript:void(0)" class="" wire:click="removeElevator({{ $elevator->id }})">
                                        <i class=" btn-xs fi fi-trash"></i>
                                    </a>
                                </li>
                            @endforeach
                 @else

                     <span class="text-muted">آسانسوری ثبت نشده است</span>

                 @endif

                    </ul>
                </div>
            </div>
        </div>

    </div>


</div>

@script
<script>
    $wire.on('elevator_added', () => {
        $('#add-elevator').modal('hide');

    });

</script>
@endscript
