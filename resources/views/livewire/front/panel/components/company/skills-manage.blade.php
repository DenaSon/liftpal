<div class="modal fade" id="skill-modal-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <ul class="list-group p-1">
                    @forelse($user->skills as $skill)
                        <li wire:key="{{ $skill->id }}"
                            class="list-group-item d-flex justify-content-between align-items-center item-hovered">
                            <span>{{ $loop->iteration }} - {{ $skill->name }}

                                @if($skill->pivot->approved == 1)
                                    <span class="ms-2 text-success fs-xs  alert alert-success p-1"> تایید شده  </span>
                                @else
                                @endif

                            </span>


                            @if($skill->pivot->approved == 1)

                                <button wire:click="removeApproved({{$skill->id}},{{$user->id}})" type="button"
                                        class="btn btn-outline-warning btn-icon btn-xs" title="لغو تایید مهارت">
                                    لغو
                                </button>

                            @else
                                <button wire:click="approved({{$skill->id}},{{$user->id}})" type="button"
                                        class="btn btn-outline-info btn-icon btn-xs" title="تایید مهارت">
                                    تایید
                                </button>

                            @endif

                        </li>
                    @empty
                        <x-front.empty-list item-name="مهارت"></x-front.empty-list>
                    @endforelse

                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
