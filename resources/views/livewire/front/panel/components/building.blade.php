<div>

    <div class=" mt-3">


        <div class="card container shadow-lg">
            <div class="card-body">

                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="آدرس ساختمان:" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">آدرس ساختمان:</label>
                </div>

                <div >
                    <div class="row">
                    <div class="form-floating col-md-6 mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="نام ساختمان">
                        <label for="floatingInput">نام ساختمان</label>
                    </div>

                    <div class="form-floating col-md-6 mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="تعداد طبقه">
                        <label for="floatingInput">تعداد طبقه</label>
                    </div>
                    </div>

                    <div class="row ">

                        <div class="form-floating col-md-6 mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="تعداد واحد">
                            <label for="floatingInput">تعداد واحد</label>
                        </div>


                        <div class="form-floating col-md-6 mb-3 ">
                            <input type="text" class="form-control" id="floatingInput" placeholder="کد آسانسور">
                            <label for="floatingInput">کد آسانسور</label>
                        </div>


                    </div>


                    <div class="row container d-flex justify-content-center">


                        <div class=" row container my-2 mx-0" wire:ignore>
                            <label for="errorCode" class="form-label text-muted"> مدل آسانسور </label>
                            <select class="select2-error  select2 " wire:model="errorCode" style="width: 100%" id="errorCode">
                                <option value="AL" disabled selected>مدل اسانسور را وارد کنید</option>
                                @foreach($errors as $error)
                                    <option value="{{ $error->code }}">{{ $error->code }}</option>
                                @endforeach

                            </select>
                        </div>


                    </div>


                    <div class="row container">


                        <div class="my-2" wire:ignore>
                            <label for="errorCode" class="form-label text-muted"> انتخاب تکنسین </label>
                            <select class="select2-error  select2 " wire:model="errorCode" style="width: 100%" id="errorCode">
                                <option value="AL" disabled selected>تکنسیین خود را انتخاب کنید</option>
                                @foreach($errors as $error)
                                    <option value="{{ $error->code }}">{{ $error->code }}</option>
                                @endforeach

                            </select>
                        </div>


                    </div>


                </div>


                <div class="container mt-4 d-flex justify-content-end">


                    <button type="button" class="btn btn-success  "><i class="fi-building"></i>&nbspثبت ساختمان جدید</button>
                </div>
            </div>

        </div>

    </div>


    <div class="card container mt-3 shadow-lg">
        <div class="card-body">


            <div class="row ">

                <div class="form-floating col-12 mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="نام و نام خانوادگی">
                    <label for="floatingInput">نام و نام خانوادگی</label>
                </div>

                <div class="form-floating col-12 mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="شماره واحد">
                    <label for="floatingInput">شماره واحد</label>
                </div>


                <div class="form-floating col-12 mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="شماره تماس">
                    <label for="floatingInput">شماره تماس</label>
                </div>


            </div>


            <div class="container mt-4 d-flex justify-content-end">

                <button type="button" class="btn btn-success "><i class="fi-plus-square"></i>&nbspثبت اعضا ساختمان</button>
            </div>
        </div>

    </div>


    <div class="card container mt-3 shadow-lg d-flex justify-content-center">
        <div class="card-body m-0 justify-content-center">


            <!-- List group with icons and badges -->
            <ul class="list-group mb-3 ps-0 ">
                <li class="list-group-item d-flex justify-content-between align-items-center">
    <span>
      <i class="fi-chat-left text-muted me-2"></i>
      مشخصات اعضا
    </span>
                    <span class="">
        <button type="button" class="btn btn-translucent-danger btn-icon"> <i class="fi-trash"></i> </button>
     </span>

                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
    <span>
      <i class="fi-chat-left text-muted me-2"></i>
      مشخصات اعضا
    </span>
                    <span class="">
        <button type="button" class="btn btn-translucent-danger btn-icon"> <i class="fi-trash"></i> </button>
     </span>

                </li>


            </ul>


        </div>

    </div>


</div>
