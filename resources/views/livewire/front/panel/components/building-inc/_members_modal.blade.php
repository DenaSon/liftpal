<div class="border rounded shadow-sm p-4 mt-3">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex justify-content-center">
                <div class=" ps-2 text-center">
                    <label class="form-label fw-bold">افزودن اعضای ساختمان</label>
                    <div id="skill-value">3 عضو ثبت شده</div>
                </div>
            </div>
        </div>

    </div>

    <div class="container mt-3">


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success d-block w-100" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
            <i class="fi-plus-circle me-1 fs-sm"></i>
            افزودن عضو
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h1 class="modal-title fs-5 bg-soft-success" id="staticBackdropLabel">افزودن اعضای
                            ساختمان</h1>
                        <button type="button" class="btn-close me-0" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="form-floating col-12 mb-3">
                            <input type="text" class="form-control" id="floatingInput"
                                   placeholder="نام و نام خانوادگی">
                            <label for="floatingInput">نام و نام خانوادگی</label>
                        </div>

                        <div class="form-floating col-12 mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="شماره واحد">
                            <label for="floatingInput">شماره واحد</label>
                        </div>

                        <div class="form-floating col-12 mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="شماره تماس">
                            <label for="floatingInput">شماره تماس</label>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-xs w-25">ثبت</button>
                        <button type="button" class="btn btn-primary btn-xs" data-bs-dismiss="modal">بستن</button>

                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row container mt-3 collapse" id="showMoreuser" style="">
        <!-- List group with icons and badges -->
        <ul class="list-group">

            <li wire:key="2" class="list-group-item d-flex justify-content-between align-items-center  ">
<span>
<i class="fi-user-check text-success me-2"></i>
میلاد اسدی
</span>
                <a href="#" class="">
                    <i class=" btn-xs fi fi-trash"></i>
                </a>
            </li>
            <li wire:key="3" class="list-group-item d-flex justify-content-between align-items-center  ">
<span>
<i class="fi-user-check text-success me-2"></i>
محمد اسدی
</span>
                <a href="#" class="">
                    <i class=" btn-xs fi fi-trash"></i>
                </a>
            </li>
            <li wire:key="2" class="list-group-item d-flex justify-content-between align-items-center  ">
<span>
<i class="fi-user-check text-success me-2"></i>
مسلم حمیدی
</span>
                <a href="#" class="">
                    <i class=" btn-xs fi fi-trash"></i>
                </a>
            </li>
        </ul>

    </div>

    <div class="container mt-2">
        <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start">

            <a class="collapse-label d-inline-block fs-md fw-bold text-success text-decoration-none pt-2 pb-3 mx-auto mx-md-0 ms-md-2 collapsed"
               href="#showMoreuser" data-bs-toggle="collapse" data-bs-label-collapsed="مشاهده اعضا"
               data-bs-label-expanded="بستن" role="button" aria-expanded="false" aria-controls="showMoreuser">
                <i class="fi-arrow-down me-2"></i>
            </a>
        </div>
    </div>

</div>
