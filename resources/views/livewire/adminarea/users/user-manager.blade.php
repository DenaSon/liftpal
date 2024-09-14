<div class="user-list">


    <div class="card mt-3 shadow">

        <div class="form-group">
            <input class="form-control" wire:model.debounce.800ms="search" placeholder="جستجو کاربر (شماره یا نام خانوادگی)">
            <button type="button" wire:click="searchUser" class="btn btn-outline-info">
                <i class="fi-search"></i>
            </button>
        </div>

    </div>



    <div wire:init="loadMore">
        <div class="card mt-3 shadow-lg" id="paginated-users">


            <div class="d-flex justify-content-between">
        <span class="m-1 pt-2 pe-2 ps-2 fw-bold">
            <i class="fi-list me-2"></i>
            لیست کاربران
        </span>
                <span class="m-1 pt-2 pe-2 ps-2">
                <span class="badge bg-faded-info fw-lighter fs-sm text-waiting"> {{ $users?->count() ?? '0' }} </span>
            </span>

            </div>
            <hr class="w-75 text-secondary">

            <div class="table-responsive mt-3">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>نقش</th>
                        <th>تلفن</th>
                        <th>ثبت‌نام</th>
                    </tr>
                    </thead>
                    <tbody wire:poll.visible>

                    @foreach($users as $user)
                        <tr wire:key="user-{{$user->id}}" wire:transition.duration.800ms>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                @can('admin-access')
                                    <a class=" text-dark" target="_blank"
                                       href="{{ route('user.index',['filter' =>'phone','search'=> $user?->phone]) }}">
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

                                        @can('admin-access') </a>
                                @endcan

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

        </div>
    </div>


    <div class="d-flex">
        @if($users->hasMorePages())
            <div wire:loading wire:target="loadMore" class="alert alert-info text-center mx-auto mt-3">
                <div class="mx-auto text-center">
                    بارگذاری کاربران...
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('scroll', function () {
        const {scrollTop, scrollHeight, clientHeight} = document.documentElement;
        if (scrollTop + clientHeight >= scrollHeight - 5) {
            @this.
            call('loadMore');
        }
    });
</script>
