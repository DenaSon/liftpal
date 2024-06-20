<div class="modal fade" id="bs-show-modal-sm-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-light">

                <span class="fe-info font-18"></span> &nbsp;  اطلاعات کاربر

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start mb-2">

                    <img onclick="void" class="d-flex me-3 rounded-circle avatar-md" src="{{ asset( $user->profile->image->file_path ??  "admin/assets/images/users/user-6.jpg") }}" alt="Generic placeholder image">

                    <div class="w-100">
                        <h5 class="mt-0 mb-1 font-12"> {{ $user->profile->name ?? '' }}  {{ $user->profile->last_name ?? '' }}  </h5>
                        <p class="text-muted">
                            @if($user->role == 'admin') مدیر @endif
                            @if($user->role == 'author') نویسنده @endif
                            @if($user->role == 'stock') انباردار @endif
                            @if($user->role == 'visitor') همکار @endif
                        </p>

                       <hr/>


                    </div>
                </div>


                    <div class="text-center">


                        @if( !empty($user->posts->count()))
                            <h4 class="font-13 text-muted text-uppercase mb-1"> تعداد مقالات </h4>
                            <p class="mb-3">

                                {{ $user->posts->count() }} مقاله
                            </p>
                        @endif



                            @if( !empty($user->profile->birthday))
                            <h4 class="font-13 text-muted text-uppercase mb-1">تاریخ تولد :</h4>
                            <p class="mb-3">

                                        {{ jdate($user->profile->birthday)->toFormattedDateString() }}
                              </p>
                            @endif



                        <h4 class="font-13 text-muted text-uppercase mb-1">ثبت نام </h4>
                        <p class="mb-3">{{ jdate($user->created_at)->toDateTimeString() }}   </p>

                <h4 class="font-13 text-muted text-uppercase mb-1"> بروز رسانی پروفایل  </h4>
                <p class="mb-3">{{ jdate($user->profile->updated_at)->toDateString() }}   </p>



                            @if( !empty($user->profile->address))
                                <h4 class="font-13 text-muted text-uppercase mb-1"> آدرس </h4>
                                <p class="mb-3">{{ $user->profile->address }}</p>
                            @endif

                    </div>

                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

