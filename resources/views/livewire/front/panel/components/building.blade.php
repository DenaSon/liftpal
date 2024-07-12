<div>

    <div class=" mt-3">


        <div class="card container shadow-lg">
            <div class="card-body">

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">آدرس ساختمان:</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                </div>
                <div class="row container d-flex justify-content-around">
                    <div class="col-4 mb-3">
                        <label for="text-input" class="form-label">نام ساختمان</label>
                        <input class="form-control w-100" type="text" id="text-input">
                    </div>

                    <div class="col-4 mb-3 ">
                        <label for="text-input" class="form-label">تعداد طبقه</label>
                        <input class="form-control w-25" type="text" id="text-input">
                    </div>


                    <div class="row container d-flex justify-content-around">

                        <div class="col-4 mb-3">
                            <label for="text-input" class="form-label">تعداد واحد</label>
                            <input class="form-control w-25" type="text" id="text-input">
                        </div>


                        <div class="col-4 mb-3">
                            <label for="text-input" class="form-label">کد آسانسور</label>
                            <input class="form-control w-50" type="text" id="text-input">
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


            <div class="row container d-flex justify-content-center align-items-center">
                <div class="col-sm-12 mb-3">
                    <label for="text-input" class="form-label">نام و نام خانوادگی</label>
                    <input class="form-control w-75" type="text" id="text-input">
                </div>

                <div class="col-sm-12 mb-3 mx-0">
                    <label for="text-input" class="form-label">شماره واحد</label>
                    <input class="form-control w-25" type="text" id="text-input">
                </div>

                <div class="col-sm-12 mb-3 mx-0">
                    <label for="text-input" class="form-label">شماره تماس</label>
                    <input class="form-control w-75" type="text" id="text-input">
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
