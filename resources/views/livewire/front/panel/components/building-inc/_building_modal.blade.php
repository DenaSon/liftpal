<div class=" mt-3">

    <div class="border rounded shadow-sm p-4 mt-3">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-md-6 d-flex justify-content-center">
                    <div class=" ps-2 text-center">
                        <label class="form-label fw-bold">مدیریت ساختمان</label>
                        <div id="skill-value">{{ $building_list->count() }} ساختمان ثبت شده</div>
                    </div>
                </div>
            </div>

        </div>


        <div class="container mt-3">


            <button wire:click.debounce.200ms="resetForm" type="button" class="btn btn-success d-block w-100"
                    data-bs-toggle="modal"
                    data-bs-target="#add-building">
                <i class="fi-plus-circle me-1 fs-sm"></i>
                ثبت ساختمان
            </button>

            <!-- Modal -->
            <div wire:ignore class="modal fade" id="add-building" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h1 class="modal-title fs-5 bg-soft-success" id="add-building">افزودن ساختمان</h1>
                            <button type="button" class="btn-close me-0" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div class="form-floating mb-3">
                          <textarea wire:model="building_address" class="form-control"
                                    placeholder="آدرس ساختمان"
                                    id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">آدرس ساختمان</label>
                            </div>

                            <div>
                                <div class="row">

                                    <div class="form-floating col-12 mb-3">
                                        <input wire:model="manager_name" type="text" class="form-control"
                                               id="floatingInput"
                                               placeholder="نام و نام خانوادگی مدیر">
                                        <label for="floatingInput">نام و نام خانوادگی مدیر</label>
                                    </div>


                                    <div class="form-floating col-12 mb-3">
                                        <input wire:model="building_name" type="text" class="form-control"
                                               id="floatingInput"
                                               placeholder="نام ساختمان">
                                        <label for="floatingInput">

                                            نام ساختمان
                                            <span class="text-success">*</span>

                                        </label>
                                    </div>

                                    <div class="form-floating col-12 mb-3">
                                        <input wire:model="building_floors" type="number" class="form-control"
                                               id="floatingInput"
                                               placeholder="تعداد طبقه">
                                        <label for="floatingInput">تعداد طبقات</label>
                                    </div>


                                    <div class="form-floating col-12 mb-3">
                                        <input wire:model="building_units" type="number" class="form-control"
                                               id="floatingInput"
                                               placeholder="تعداد واحد">
                                        <label for="floatingInput">تعداد واحد</label>
                                    </div>

                                    <div class="form-floating col-12 mb-3">
                                        <input wire:model="manager_contact" type="number" class="form-control"
                                               id="floatingInput"
                                               placeholder="شماره تماس مدیر">
                                        <label for="floatingInput">شماره تماس مدیر</label>
                                    </div>

                                    <div class="form-floating col-12 mb-3">
                                        <input wire:model="emergency_contact" type="number" class="form-control"
                                               id="floatingInput"
                                               placeholder="شماره تماس اضطراری">
                                        <label for="floatingInput">شماره تماس اضطراری</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button wire:click.debounce.250ms="addBuilding" type="button"
                                    class="btn btn-success btn-xs w-25">ثبت
                            </button>
                            <button type="button" class="btn btn-primary btn-xs" data-bs-dismiss="modal">بستن
                            </button>

                        </div>

                    </div>
                </div>


            </div>


            <div class="accordion mt-2" id="accordion-building">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOneBuilding">
                        <button class="accordion-button text-success" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOneBuilding" aria-expanded="true"
                                aria-controls="collapseOneBuilding">
                            ساختمان های ثبت شده
                        </button>
                    </h2>
                    <div id="collapseOneBuilding" class="accordion-collapse collapse show"
                         aria-labelledby="headingOneBuilding" data-bs-parent="#accordion-building">
                        <div class="accordion-body">
                            <ul class="list-group ">
                                @if($building_list->count() > 0)
                                    @foreach($building_list as $index => $building)
                                        <li wire:key="{{ $building->id }}"
                                            class="list-group-item pt-0 m-0 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">

                <span class="w-100 mt-3">
                    <i class="fi-apartment text-success me-2"></i>
                    {{ $index+1 }} -
                    <span class="fw-bold badge bg-faded-primary ms-1 me-2"> {{ $building->builder_name }}</span>
                    <span class="fs-xs muted d-none d-md-inline-block"> {{ \Illuminate\Support\Str::limit($building->address, 45) }}</span>
                </span>


                                            <div class="d-flex  flex-md-row mx-auto mt-3 justify-content-center justify-content-md-end align-items-center w-100">
                                                <a wire:click="editBuilding({{ $building->id }})"
                                                   href="javascript:void(0)"
                                                   data-bs-toggle="modal" data-bs-target="#edit-building"
                                                   class="me-3">
                                                    <i class="btn-xs fi fi-edit text-info fs-6"></i>
                                                </a>

                                                <a href="javascript:void(0)" class="me-3"
                                                   wire:click="removeBuilding({{ $building->id }})">
                                                    <i class="btn-xs fi fi-trash fs-6 text-danger"></i>
                                                </a>

                                                <a href="javascript:void(0)" class="me-3"
                                                   wire:click="sendMemberBuildingAlert({{ $building->id }})">
                                                    <i class="btn-xs fi fi-alert-triange fs-6 text-warning"></i>
                                                </a>

                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#teqnician-action-building" class="me-3">
                                                    <i class="btn-xs fi fi-bell-on fs-6 text-primary"></i>
                                                </a>

                                            </div>

                                        </li>

                                    @endforeach

                                @else

                                    <span class="text-muted">ساختمانی ثبت نشده است</span>

                                @endif

                            </ul>
                            <div class="d-flex justify-content-center">
                                <span class="badge bg-warning text-center mt-2" wire:loading>درحال ارسال،لطفا صبر کنید...</span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@include('livewire.front.panel.components.building-inc._building_edit')
@include('livewire.front.panel.components.building-inc._building_edit_teqnician_action')


@script
<script>
    $wire.on('building_added', () => {
        $('#add-building').modal('hide');

    });
</script>
@endscript

