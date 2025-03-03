<div>

    @if($message_list->count() == 0)
        <div class="text-center mt-3">
           هنوز پیامی دریافت نکرده اید
        </div>
    @endif

    @foreach($message_list as $message)

        <div wire:key="{{ $message->id }}" class="card @if($message->is_read == 0) bg-secondary @endif card-hover mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="d-flex align-items-center">
                        <i class="fi-edit fs-lg me-2"></i>
                        <span class="fs-sm text-dark opacity-80 px-1 fw-bolder">
                    {{ $message->title }}
                    </span>
                        <span class="badge bg-faded-danger rounded-pill ms-2">  @if($message->sender?->role == 'admin')  <i>مدیر : </i>   @endif</span>
                        <span class="badge bg-faded-accent rounded-pill  ms-2">

                       {{ $message->sender?->profile?->name ?? 'ثبت نشده' }} {{ $message->sender?->profile?->last_name ?? 'ثبت نشده' }}
                    </span>

                    </div>
                    <div class="dropdown content-overlay">
                        <button type="button" class="btn btn-icon btn-light btn-xs rounded-circle shadow-sm"
                                id="contextMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu my-1" aria-labelledby="contextMenu">
                            @if($message->is_read == 0)
                            <li>
                                <button  wire:click.debounce.450ms="markAsRead({{$message->id}})" type="button" class="dropdown-item">
                                    <i class="fi-pencil opacity-60 me-2"></i>
                                    خوانده شده
                                </button>
                            </li>
                            @endif
                            <li>
                                <button wire:confirm="از حذف پیام اطمینان دارید؟" wire:click.debounce.450ms="removeMessage({{$message->id}})" type="button" class="dropdown-item">
                                    <i class="fi-trash opacity-60 me-2"></i>
                                    حذف پیام
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="m-2 p-2 text-justify">
                    {{ $message->content }}
                </p>
                <hr/>
                <div class="fs-sm">
      <span class="text-nowrap me-3 float-start">
        <i class="fi-map-pin text-muted me-1"> </i>
        {{ jdate($message->created_at)->toFormattedDateString()}}
      </span>

                </div>
            </div>
        </div>
    @endforeach

    <div class="pagination mt-2">
        {{ $message_list->links() }}
       </div>

</div>

