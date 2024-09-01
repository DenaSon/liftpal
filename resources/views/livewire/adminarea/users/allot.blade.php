<div>

    <div class="row">
        <!-- Header and footer -->
        <div class="col-12 card text-center mt-3">


            <div class="card-body">


                <div class="form-group">
                    <div class="m-2  w-50">
                        <input class="form-control" type="search" wire:model.live="buildingFilter"
                               placeholder="نام ساختمان">
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
                            placeholder="نام شرکت"
                        >
                    </div>
                    <select class="m-2 p-1 form-control w-100" wire:model="companyId">
                        @if($companies->isEmpty())
                            <option>بدون نتیجه</option>
                        @else
                            <option selected> انتخاب شرکت</option>
                            @foreach($companies as $index => $company)
                                <option value="{{ $company->id }}" wire:key="{{ $company->id }}">
                                    {{ $company->id }} - {{ $company->name }} - مدیریت : {{ $company->manager_name }}
                                    ({{ $company?->phone }})
                                    {{ \Illuminate\Support\Str::limit( $company?->address,15)  }}
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
                            wire:model.live="technicianFilter"
                            placeholder="شماره کارشناس فنی"
                        >
                    </div>
                    <select class="m-2 p-1 form-control w-100" wire:model="technicianId">
                        @if($technicians->isEmpty())
                            <option value="">بدون نتیجه</option>
                        @else
                            <option selected> انتخاب کارشناس فنی</option>
                            @foreach($technicians as $index => $technician)
                                <option value="{{ $technician->id }}" wire:key="{{ $technician->id }}">
                                    {{ $technician->id }}
                                    - {{ $technician->name }}  {{ $technician->profile->name }} {{ $technician->profile->last_name }}
                                    ({{ $technician?->phone }})

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
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>ساختمان</th>
                    <th> کارشناسان </th>
                    <th>شرکت </th>
                </tr>
                </thead>
                <tbody>
                @foreach($buildings as $index => $building)
                    <tr wire:key="building-{{ $building->id }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bolder">{{ $building->builder_name }}</td>

                        <td>
                          <button class="btn btn-xs btn-outline-primary" data-bs-toggle="modal" data-bs-target="#technicians-modal-{{$building->id}}">
                              <i class="fi-users"></i>
                          </button>
                        </td>
                        <td>
                            {{ $building->companies?->first()?->name }}
                        </td>
                    </tr>
                    @include('livewire.adminarea.users.allot-inc.show-technicians')
                @endforeach

                </tbody>
            </table>
        </div>




    </div>









</div>

