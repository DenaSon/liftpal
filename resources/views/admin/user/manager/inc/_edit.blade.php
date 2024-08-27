<div class="modal fade" id="bs-edit-modal-sm-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">
                    <span class="fe-edit-1 text-primary"></span>

                    &nbsp;

                    ویرایش کاربر

                   <small class="text-muted">  {{ $user->phone ?? $user->email }} </small>
                </h4>


                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-3">
                <form action="{{ route('user.update',$user->id) }}" method="post" id="userForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="name" class="form-label">نام</label>
                        <input value="{{ $user->profile->name ?? '' }}" type="text" class="form-control" id="name" placeholder="نام کاربر" name='name'>
                    </div>
                    <div class="mb-2">
                        <label for="last_name" class="form-label">نام خانوادگی</label>
                        <input value="{{ $user->profile->last_name ?? '' }}" name="last_name" type="text" class="form-control" id="last_name" placeholder="نام خانوادگی کاربر">
                    </div>


                    <div class="mb-3">
                        <label for="role" class="form-label">نقش </label>
                        <select name="role" class="form-select" id="role">
                            <option value="admin">مدیر</option>
                            <option value="manager">مدیر ساختمان</option>
                            <option value="technician">کارشناس فنی</option>

                        </select>
                    </div>



                    <div class="mb-2">
                        <label for="password" class="form-label"> کلمه عبور </label> <span class="text-success">*</span>
                        <input value="" dir="ltr"  name="password" type="text" class="form-control" id="password" placeholder="رمز عبور جدید" minlength="8">
                    </div>

                    <div class="form-check float-start" id="notifyCheckbox">
                        <input type="checkbox" class="form-check-input" id="notify" name="notify" value="1">
                        <label class="form-check-label" for="notify">
                            ارسال اعلان به کاربر
                        </label>
                    </div>
                    <br/>

                    <div class="visually-hidden form-check float-start mt-2" >
                        <input {{ $user->status == 'banned' ? 'checked' : '' }} type="checkbox" class="form-check-input " id="userStatus" name="userStatus" value="1">
                        <label  class="form-check-label text-danger" for="userStatus">
                          غیرفعال سازی کاربر
                        </label>
                    </div>


                    <div class="text-end p-2">
                        <button id="sendForm" type="submit" class="btn btn-success waves-effect waves-light"> ویرایش کاربر</button>



                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
            </div>
        </div><!-- /.modal-content -->


