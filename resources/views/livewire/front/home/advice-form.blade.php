<div wire:ignore class="modal fade" id="advice-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">مشاوره با تایم پال</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit="send">
            <div class="modal-body">



    <div class="form-group">
            <label> شماره همراه </label> <span class="text-danger">*</span>
            <div class="input-with-icon">

                <input  wire:model="phone" min="0" type="number" class="form-control @error('phone') is-invalid @enderror" placeholder="شماره همراه">
                <div class="small text-danger">@error('phone') {{ $message }} @enderror</div>
                <i class="ti-user"></i>
            </div>
        </div>


            <div class="form-group">
            <label>ایمیل </label> <span class="text-success">*</span>
            <div class="input-with-icon">
                <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror()" placeholder="ایمیل (اختیاری)">
                <div class="small text-danger">@error('email') {{ $message }} @enderror</div>
                <i class="ti-email"></i>
            </div>
            </div>

            <div class="form-group">
                <label> متن پیام</label>  <span class="text-danger">*</span>
                <div class="input-with-icon">

                        <textarea maxlength="310" wire:model="text" class="form-control @error('text') is-invalid @enderror()"></textarea>

                    <div class="small text-danger">@error('text') {{ $message }} @enderror</div>
                    <i class="ti-text"></i>
                </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">×</button>
                &nbsp;
                <button  type="submit" class="btn btn-success">ارسال درخواست</button>
            </div>
            </form>



        </div>
    </div>
</div>
@script
<script>
    $wire.on('close-modal', () => {
        $('#advice-modal').modal('hide');

    });

    $wire.on('validation-failed', () => {
        Swal.fire({
            icon: 'error',
            text: 'ورودی های خود را بررسی کنید',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

    });

</script>
@endscript
