<div>

    <div class="d-flex justify-content-center align-items-center">
        <div class="card mt-4 shadow-lg" style="width: 65%">
            <div class="card-body">

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="جستجو شماره تلفن ..."
                           wire:model.live.500ms="search">
                </div>
                <ul class="list-group p-1">

                    @foreach($users  as $user)
                        <li wire:key="user-{{ $user->id }}" class="list-group-item">
                            ({{ $user->phone }})
                            {{ $user->profile?->name }}    {{ $user->profile?->last_name }}
                            @if($user->companies->count() > 0)
                                <span class="fs-xs fw-bold text-danger float-start">
                                       کارشناس شرکت  : {{ $user->companies->first()->name }}
                                   </span>
                            @else
                                <button
                                    wire:confirm="این کارشناس را برای شرکت انتخاب می کنید؟"
                                    wire:click.debounce.100ms="allotToCompany({{$user}})"
                                    class="float-start ms-2 btn btn-xs btn-outline-dark">انتساب
                                </button>

                            @endif

                        </li>
                    @endforeach

                </ul>


            </div>
        </div>

    </div>

    <div class="d-flex justify-content-center align-items-center">
        <div class="d-flex card card-hover mt-3 p-0 " style="width: 75%">
            <div class="card-body p-0">
                <ul class="list-group p-0">
                    @foreach($technicians as $technician)
                        <li wire:key="technician-{{$technician->id}}" class="list-group-item">
                            {{ $technician->profile?->name }} {{ $technician->profile?->last_name }}
                            ({{ $technician->phone }})
                            درخواست ها : {{ $technician->requests()?->count() }}
                            <button wire:confirm="این مورد را از کارشناسان شرکت حذف می کنید؟"
                                    wire:click="deAllotTechnician({{$technician}})"
                                    class="btn btn-xs btn-outline-danger  float-start">

                                <i class="fi-trash"></i>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


    <x-front.spinner class="m-3"></x-front.spinner>

</div>





