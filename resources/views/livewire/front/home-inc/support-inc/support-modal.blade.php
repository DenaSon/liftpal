
<!-- Modal -->
<div wire:ignore class="modal fade" id="support-home-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form wire:submit.debounce1000ms="sendSupport">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header ">
                <h1 class="modal-title fs-5" id="exampleModalLabel">درخواست مشاوره</h1>
                <button type="button" class="btn-close me-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="">

                    <div class="form-floating mb-3">
                        <input wire:model="fullname" type="text" class="form-control" id="fullname" placeholder="نام و نام خانوادگی">
                        <label for="fullname">نام و نام خانوادگی</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input wire:model="phone" type="number" class="form-control" id="phone" placeholder="شماره تلفن">
                        <label for="phone">شماره تلفن</label>
                    </div>


                    <div class="form-floating">
                        <textarea wire:model="text" class="form-control" placeholder="متن مورد نظر خود را بنویسید ..." id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">متن مورد نظر خود را بنویسید ...</label>
                    </div>


                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button  type="submit" class="btn btn-primary w-100">ارسال</button>
            </div>
            <div class="text-center" wire:loading>
                <span class="badge bg-info">لظفا صبر کنید...</span>
            </div>
        </div>
    </div>
    </form>

</div>
