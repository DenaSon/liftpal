<div class="modal fade" id="skill-modal-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <ul class="list-group p-1">
                    @forelse($user->skills as $skill)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span> {{ $loop->iteration }} -  {{ $skill->name }} </span>
                            <span class="badge bg-danger">
                                <a wire:confirm="مهارت برای کارشناس حذف شود؟" wire:click="removeSkill({{ $user->id }}, {{ $skill->id }})" role="button">
                                    <i class="fi-trash"></i>
                                </a>
                            </span>
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
