
<!-- Modal -->
<div wire:ignore class="modal fade" id="support-home-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header ">
                <h1 class="modal-title fs-5" id="exampleModalLabel">درخواست مشاوره</h1>
                <button type="button" class="btn-close me-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="">

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="نام و نام خانوادگی">
                        <label for="floatingInput">نام و نام خانوادگی</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="شماره تلفن">
                        <label for="floatingInput">شماره تلفن</label>
                    </div>

                    
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="متن مورد نظر خود را بنویسید ..." id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">متن مورد نظر خود را بنویسید ...</label>
                    </div>


                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-primary">ارسال</button>
            </div>
        </div>
    </div>
</div>
