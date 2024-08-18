<div wire:ignore class="modal fade" id="edit-building" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h1 class="modal-title fs-5 bg-soft-success" id="edit-building">ویرایش اطلاعات ساختمان</h1>
                <button type="button" class="btn-close me-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <div class="form-floating mb-3">
                          <textarea wire:model="building_address" class="form-control"
                                    placeholder="آدرس ساختمان"
                                    id="floatingTextarea">

                          </textarea>
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
                            <input wire:model="emergency_contact" type="number" class="form-control"
                                   id="floatingInput"
                                   placeholder="شماره تماس اضطراری">
                            <label for="floatingInput">شماره تماس اضطراری</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <div wire:loading class="text-start">
                    <div wire:loading class="spinner-border" role="status">
                        <span wire:loading class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <button wire:click.debounce.500ms="updateBuilding" type="button"
                        class="btn btn-success btn-xs w-25">ویرایش
                </button>
                <button type="button" class="btn btn-primary btn-xs" data-bs-dismiss="modal">بستن
                </button>

            </div>

        </div>
    </div>


</div>
@script
<script>
    $wire.on('buildingUpdated', () => {
        $('#edit-building').modal('hide');

    });
</script>
@endscript
