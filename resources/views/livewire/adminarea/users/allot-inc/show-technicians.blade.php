<div class="modal fade" id="technicians-modal-{{ $company->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <b class="float-start text-primary">{{ $company->name }}</b>
                <b class="float-end text-primary">{{ $company->manager_name }}</b>
            </div>

            <div class="modal-body">
                <ul class="list-group p-0">
                    @if($company->technicians->isEmpty())
                        هیچ کارشناس فنی ثبت نشده است
                    @endif
                    @foreach($company->technicians as $index => $technician)
                    <li class="list-group-item">
                        <b>{{ $loop->iteration }} </b> -
                        {{ $technician->profile?->name  }} {{ $technician->profile?->last_name  }}
                        <span style="direction: ltr; unicode-bidi: bidi-override;"> ({{ formatPhoneNumber($technician->phone) }}) </span>
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
