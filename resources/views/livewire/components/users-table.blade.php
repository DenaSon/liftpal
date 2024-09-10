<div>
    <div class="card {{ $card_class ?? 'mt-3 shadow-lg' }}" id="paginated-users">


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
                <th>زمان ثبتنام</th>
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
                           href="{{ route('user.index',['filter' =>'phone','search'=> $user?->phone]) }}">   @endcan   {{ $user->profile->last_name }}

                            @can('admin-access') </a>  @endcan

                    </td>
                    <td class="@can('company')  fw-bolder @endcan">{{ $user->getRole() }}</td>
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
