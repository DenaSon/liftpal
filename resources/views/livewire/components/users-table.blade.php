<div>
    <div class="card {{ $card_class ?? '' }}" id="paginated-users">


        <div class="d-flex justify-content-between">
        <span class="m-1 pt-2 pe-2 ps-2 fw-bold">
            <i class="fi-list me-2"></i>
         {{ $list_name ?? '' }}
        </span>
            <span class="m-1 pt-2 pe-2 ps-2">
                <span class="badge bg-faded-info fw-lighter fs-sm text-waiting"> {{ $users?->count() ?? '0' }} </span>
            </span>

        </div>
        <hr class="w-75 text-secondary">

    <div class="table-responsive mt-3">

        <table class="table {{ $class }}">
            <thead>
            <tr>
                <th>#</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>نقش</th>
                <th>تلفن</th>
                <th> ثبت‌نام</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        @can('admin-access')
                            <a class=" text-dark" target="_blank"  href="{{ route('user.index',['filter' =>'phone','search'=> $user?->phone]) }}">
                                @endcan

                        {{ $user->profile?->name }}
                        @can('admin-access')
                        </a>
                        @endcan
                    </td>
                    <td>
                        @can('admin-access')
                        <a class="text-dark" target="_blank"
                           href="{{ route('user.index',['filter' =>'phone','search'=> $user?->phone]) }}">   @endcan   {{ $user->profile?->last_name }}

                            @can('admin-access') </a>  @endcan

                    </td>


                    <td>
                                   <span class="btn btn-xs @switch($user->role)
                                   @case('manager')
                                   btn-outline-info
                                   @break
                                    @case('technician')
                                   btn-outline-warning
                                   @break
                                    @case('company')
                                   btn-outline-dark
                                   @break
                                    @case('admin')
                                   btn-outline-danger
                                   @endswitch p-1 ps-3 pe-3">{{ $user->getRole() }}</span>
                    </td>


                    <td>{{ formatPhoneNumber($user->phone) }}</td>
                    <td class="fs-xs">{{ jdate($user->created_at)->isToday() ? 'امروز' : jdate($user->created_at)->toFormattedDateString()  }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $users->links(data: ['scrollTo' => '#paginated-users'])}}
    </div>

    @if($users->isEmpty())
        <span class="text-center text-info p-3 m-3">کاربری وجود ندارد</span>
    @endif
</div>
</div>
