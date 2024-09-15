<div>
    <div class="card mt-3" id="paginated-users">


        <div class="d-flex justify-content-between">
        <span class="m-1 pt-2 pe-2 ps-2 fw-bold">
            <i class="fi-list me-2"></i>
         مدیریت کارشناس‌های شرکت
        </span>
            <span class="m-1 pt-2 pe-2 ps-2">
                <span class="badge bg-faded-info fw-lighter fs-sm text-waiting"> {{ $users?->count() ?? '0' }} </span>
            </span>

        </div>
        <hr class="w-75 text-secondary">

        <div class="table-responsive mt-3">

            <table class="table {{ $class ?? '' }}">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                    <th>تلفن</th>
                    <th> اقدامات </th>
                </tr>
                </thead>
                <tbody>

                @foreach($companyTechnicians as $user)
                    <tr>
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
                                   href="{{ route('user.index',['filter' =>'phone','search'=> $user?->phone]) }}">   @endcan
                                    {{ $user->profile?->last_name }}

                                    @can('admin-access') </a>
                            @endcan

                        </td>

                        <td>{{ formatPhoneNumber($user->phone) }}</td>
                        <td>

                            <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#skill-modal-{{$user->id}}">
                               مهارت ها
                            </button>
                            @include('livewire.front.panel.components.company.skills-manage')


                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
