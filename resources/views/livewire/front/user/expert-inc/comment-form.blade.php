<div class="cart mt-2 mb-2" wire:ignore>
    <div class="card">
        <div class="card-body shadow-sm">
        <form wire:submit="saveComment">
            <div class="form-floating mb-3">
                <input wire:model="username" class="form-control" id="floating-input" type="text" placeholder="name">
                <label for="floating-input">نام و نام خانوادگی</label>
            </div>

            <div class="form-floating">
                <textarea wire:model="comment_text" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">پیام خود را وارد کنید</label>
            </div>

            <div class="mt-3 d-flex justify-content-center justify-content-md-end">

                <button @if(!auth()->check()) disabled @endif  type="submit" class="btn btn-primary">ثبت دیدگاه</button>
            </div>
        </form>

        </div>
    </div>
</div>
