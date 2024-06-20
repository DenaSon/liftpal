<div class="modal fade modal-message-{{$user->id}}" id="staticBackdrop-{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  bg-light">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <span class="fe-message-circle text-primary font-18"></span>
                    ارسال پیام به : {{ $user->profile->name ?? $user->phone ?? $user->email }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('channelSend') }}" method="post">
                @csrf
                <input name="receiver_id" type="hidden" value="{{ $user->id }}">

                <input name="receiver_email" type="hidden" value="{{ $user->email ?? null }}">

            <div class="modal-body">

            <div class="mb-3">
                <label for="subject" class="form-label"> موضوع </label>
                <input type="text" id="subject" name="subject" class="form-control" placeholder="موضوع پیام">
            </div>

                <div class="mb-3">

                    <label for="message" class="form-label">متن پیام</label>
                    <textarea class="form-control" name="message" id="message" rows = 5 placeholder="متن پیام"></textarea>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">کانال ارسال  </label>
                    <select class="form-select form-select-sm" id="type" name="channel">
                        <option value="panel">ارسال به پنل </option>

                        @if($user->email)
                        <option value="email">ارسال به ایمیل   </option>
                        <option value="panel_email"> ارسال به پنل و ایمیل   </option>
                        @endif

                    </select>
                </div>


            </div>
            <div class="modal-footer border-warning">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                <button type="submit" class="btn btn-success">ارسال </button>

            </div>
            </form>
        </div>
    </div>
</div>
