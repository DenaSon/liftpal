<div>
    <form wire:submit="saveEmail" class="form-group form-group-light rounded-pill" style="max-width: 500px;">
        <div class="input-group input-group-sm"l>
            <span class="input-group-text text-muted"><i
                    class="fi-mail"></i>
            </span>
            <input  wire:model="email" class="form-control" type="text" placeholder="ایمیل شما">
        </div>
        <button  class="btn btn-primary btn-sm rounded-pill" type="submit">ثبت</button>
    </form>

</div>
