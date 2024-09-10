<div wire:ignore class="modal fade" id="buildings-modal-{{ $company->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <b class="float-start text-primary">{{ $company->name }}</b>
                 <b class="float-end text-primary">{{ $company->manager_name }}</b>
            </div>

            <div class="modal-body">
                <ul class="list-group p-0">
                    @if($company->buildings->isEmpty())
                        ساختمانی ثبت نشده است
                    @endif
                    @foreach($company->buildings as $index => $building)



                        <li class="list-group-item">
                            <b>{{ $index + 1 }}</b> - <span
                                class="text-info fw-bolder">{{ $building->builder_name }}</span>
                            <span class="fs-xs"> -
                        مالک  :
                      ( {{ $building->owner?->profile?->name }} {{ $building->owner?->profile?->last_name }} )
                        </span>

                            <span class="fs-xs"> مدیریت :
                                  ({{ $building?->manager_name ?? 'ثبت نشده' }})
                           </span>

                            <span class="small fs-xs text-center">
                              {{ $building?->address ?? 'آدرس ثبت نشده' }}
                    </span>
                        <br/>

                            <span>
                           <a href="#" wire:confirm="ساختمان برای شرکت حذف شود؟" wire:click="deAllot({{ $building->id }})">   <i class="fi-trash"></i> </a>
                            </span>

                        </li>





                    @endforeach

                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>

            </div>
        </div>
    </div>
</div>
