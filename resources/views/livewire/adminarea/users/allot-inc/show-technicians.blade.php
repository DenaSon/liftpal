<!-- Modal -->
<div class="modal fade" id="technicians-modal-{{$building->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <ul class="list-group p-0">
              @foreach($building->technicians->unique('id') as $technician)

                     <li class="list-group-item">

                         {{ $technician->profile->name ?? '' }}  {{ $technician->profile->last_name ?? ''}} -

                         ({{ $technician->phone }})

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
