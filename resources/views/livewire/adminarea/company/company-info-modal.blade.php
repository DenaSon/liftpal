<!-- Modal -->
<div wire:ignore class="modal fade" id="company-info-{{$company->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-sm" id="exampleModalLabel">
                   اطلاعات شرکت {{ $company->name }}
                </h5>

            </div>
            <div class="modal-body p-1">

             <ul class="list-group p-0">
                 <li class="list-group-item">
                     <b class="fw-bolder ">کد اقتصادی : </b>
                     <span class="fw-lighter ms-2">{{ $company->economic_code }}</span>
                 </li>
                 <li class="list-group-item">
                     <b class="fw-bolder ">کد ثبت : </b>
                     <span class="fw-lighter ms-2">{{ $company->registration_code }}</span>
                 </li>

                 <li class="list-group-item">
                     <b class="fw-bolder ">کد ملی مالک  : </b>
                     <span class="fw-lighter ms-2">{{ $company->manager_national_code }}</span>
                 </li>
                 <li class="list-group-item">
                     <b class="fw-bolder ">آدرس  : </b>
                     <span class="fw-lighter ms-2">{{ $company->address }}</span>
                 </li>

                 <li class="list-group-item">
                     <b class="fw-bolder ">تاریخ ثبتنام  : </b>
                     <span class="fw-lighter ms-2">{{ jdate($company->created_at)->toFormattedDateString() }}</span>
                 </li>

             </ul>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
