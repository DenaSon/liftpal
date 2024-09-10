<div>

    <div class="table-responsive mt-5">

        <table class="table table-striped table-hover table-bordered">
            <thead class="">
            <tr>
                <th>#</th>
                <th>نام شرکت</th>
                <th> مالک</th>
                <th>شماره مجوز</th>
                <th>استان</th>
                <th>انقضاء مجوز</th>
                <th> وضعیت</th>
                <th>اقدامات</th>

            </tr>
            </thead>
            <tbody>

            @foreach($companies as $company)
                <tr wire:key="company-{{$company->id}}" class="@if($company->active == 1) bg-faded-success @endif">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $company->name }}</td>
                    <td>
                        <a class="text-dark" target="_blank" href="{{ route('user.index',['filter'=>'phone','search'=>$company->owner->phone]) }}">
                            {{ $company->owner->profile?->name  }} {{ $company->owner->profile?->last_name  }}
                        </a>
                    </td>
                    <td>{{ $company->licence_code }}</td>
                    <td class="text-muted fs-xs">{{ $company?->province }}</td>
                    <td>
                        @if(\Illuminate\Support\Carbon::parse($company->license_expiration_date)->lessThan(now()))
                            <span class="badge bg-danger fw-bold">منقضی</span>
                        @else

                            {{ jdate($company->license_expiration_date)->toFormattedDateString() }}

                        @endif
                    </td>
                    <td>
                        @if($company->active == 1)
                            <span class="badge bg-success">فعال</span>
                        @else
                            <span class="badge bg-danger">غیرفعال</span>
                        @endif
                    </td>

                    <td>
                        @if($company->active == 1)
                            <button wire:confirm="شرکت را غیرفعال می کنید؟" wire:click="deActiveCompany({{$company->id}})" title="غیرفعال سازی"
                                    class="btn btn-xs btn-outline-danger" type="button">
                                <i class="fi-accounting"></i>
                            </button>
                        @else
                            <button wire:confirm="شرکت را فعال سازی می کنید؟" wire:click="activeCompany({{$company->id}})" title="فعال سازی"
                                    class="btn btn-xs btn-outline-success" type="button">
                                <i class="fi-accounting"></i>
                            </button>
                        @endif
                        <button title="اطلاعات" class="btn btn-xs btn-outline-primary" type="button"
                                data-bs-toggle="modal" data-bs-target="#company-info-{{$company->id}}">
                            <i class="fi-info-circle"></i>
                        </button>


                        <a target="_blank"
                           href="https://lift.inso.gov.ir/chooseregion?return=%2freg_%7b0%7d%2fHome%2fValidSellers">
                            <button title="استعلام شرکت" class="btn btn-xs btn-outline-info">
                                <i class="fi-user-check"></i>
                            </button>
                        </a>
                    </td>


                </tr>
                @include('livewire.adminarea.company.company-info-modal')
            @endforeach

            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{ $companies->links() }}
    </div>


</div>
