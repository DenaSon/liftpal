<div>

    <div class="row">
        <!-- Header and footer -->
        <div class="col-12 card text-center mt-3">


            <div class="card-body">


                <div class="form-group">
                    <div class="m-2  w-50">
                        <input class="form-control" type="search" wire:model.live="buildingFilter"
                               placeholder="جستجو نام ساختمان">
                    </div>
                    <select class="m-2 p-1 form-control w-100" wire:model="buildingId">
                        @if($buildings->count() < 1)
                            <option>بدون نتیجه</option>
                        @else
                            <option selected> انتخاب ساختمان</option>
                            @foreach($buildings as $index => $building)
                                <option value="{{ $building->id }}" wire:key="{{ $building->id }}"> {{ $building->id }}
                                    - {{ $building->builder_name }} -
                                    ( {{ $building->owner?->profile?->name }} {{ $building->owner?->profile?->last_name }}
                                    ) -
                                    {{ \Illuminate\Support\Str::limit($building->address,'25') }}
                                    با مدیریت
                                    {{ $building->manager_name }}

                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>


                {{--       ------------------------------------------------------         --}}

                <div class="form-group mt-4">
                    <div class="m-2 w-50">
                        <input
                            class="form-control"
                            type="search"
                            wire:model.live="companyFilter"
                            placeholder="جستجو نام شرکت"
                        >
                    </div>
                    <select class="m-2 p-1 form-control w-100" wire:model="companyId">
                        @if($companies->isEmpty())
                            <option>بدون نتیجه</option>
                        @else
                            <option selected> انتخاب شرکت</option>
                            @foreach($companies as $index => $company)
                                <option value="{{ $company->id }}" wire:key="{{ $company->id }}">
                                    {{ $company->id }} - {{ $company->name }} - مدیریت : {{ $company->owner?->profile?->name }} {{ $company->owner?->profile?->last_name }}
                                    ({{ $company?->telephone }})
                                    {{ \Illuminate\Support\Str::limit( $company?->address,12)  }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>


                <div class="text-center">
                    <button wire:click="allot" class="w-25 btn btn-outline-primary mt-4"> ثبت</button>
                </div>


            </div>

        </div>

        <div class="table-responsive mt-5">
            <table class="table table-hover table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>شرکت</th>
                    <th>ساختمان‌ها</th>
                    <th>کارشناسان</th>
                </tr>
                </thead>
                <tbody>
                @if($company_list->isEmpty())
                    هیچ شرکتی ثبت نشده است
                @endif

                @foreach($company_list as $index => $company)

                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>
                            {{ $company->name }}
                        </td>
                        <td>
                            <button class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#buildings-modal-{{$company->id}}">
                                <i class="fi-grid"></i>
                            </button>
                        </td>

                        <td>
                            <button class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#technicians-modal-{{$company->id}}">
                                <i class="fi-users"></i>
                            </button>
                        </td>

                    </tr>
                    @include('livewire.adminarea.users.allot-inc.show-buildings')
                    @include('livewire.adminarea.users.allot-inc.show-technicians')
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="pagination">

        {{ $company_list->links() }}
        </div>

    </div>


</div>

