<div  class="user-list">



    <div class="card mt-3">

        <div class="form-group">
            <input class="form-control" wire:model.live="search" placeholder="جستجو کاربر (شماره یا نام خانوادگی)">
        </div>

    </div>

    <div wire:init="loadMore">
        <div class="card mt-3 shadow-lg" id="paginated-users">


            <div class="d-flex justify-content-between">
        <span class="m-1 pt-2 pe-2 ps-2 fw-bold">
            <i class="fi-list me-2"></i>

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
                        <th>زمان ثبتنام</th>
                    </tr>
                    </thead>
                    <tbody >

                    @foreach($users as $user)
                        <tr wire:key="{{$user->id}}"  wire:transition.duration.1000ms>
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
                            <td class="@can('company')  fw-bolder @endcan">{{ $user->getRole() }}</td>
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
    document.addEventListener('scroll', function() {
        const {scrollTop, scrollHeight, clientHeight} = document.documentElement;
        if (scrollTop + clientHeight >= scrollHeight - 5) {
            @this.call('loadMore');
        }
    });
</script>
