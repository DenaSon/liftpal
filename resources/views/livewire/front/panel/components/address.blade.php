<div>

    <div class="container d-flex justify-content-center justify-content-md-end mt-3">
        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#get-new-address-modal">
            <i class="fi-map-pin me-2"></i> ثبت ادرس جدید
        </button>
    </div>

    @include('livewire.front.panel.components.address-inc.address-modal')


    @foreach($user->addresses->sortByDesc('id') as $index => $address)

    <div class="card shadow-lg mt-2">
        <div class="card-body d-flex justify-content-between">
            <p class="card-text fs-sm ">{{ $address->postal_address }}</p>

            <div class="dropend">
                <a class=" fi-dots-vertical dropdown-toggle dropdown-toggle-addressbtnedit" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="fi-dots-vertical"></i> </a>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuLink">

                    <li><a wire:click="deleteAddress({{$address->id}})" class="dropdown-item" href="#"><i class="fi-trash me-2 text-primary"></i>حذف آدرس</a></li>
                </ul>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><i class="fi-user me-2"></i><span>{{ $user->profile->name }} {{ $user->profile->last_name }}</span></li>
            <li class="list-group-item"><i class="fi-map-pin me-2"></i><span>{{ $address->province }} - {{ $address->city }}</span></li>
            <li class="list-group-item"><i class="fi-mail me-2"></i><span>{{ $address->postal_code }}</span></li>
            <li class="list-group-item"><i class="fi-phone me-2"></i><span>{{ $user->phone }}</span></li>
        </ul>



            @if($address->is_default == 0)
            <div class="card-body d-flex justify-content-center justify-content-md-end">
            <button wire:click.debounce.500ms="setDefaultAddress({{$address->id}})" class="btn btn-sm btn-outline-info"><i class="fi-plus me-2"></i>انتخاب آدرس پیش
                فرض</button>
            </div>
            @else
            <div class="card-body d-flex justify-content-center justify-content-md-end">
                <button  disabled class="btn btn-sm btn-outline-success">
                    <i class="fi-check me-2"></i>آدرس پیش فرض
                </button>

            </div>
            @endif


    </div>

    @endforeach


</div>


