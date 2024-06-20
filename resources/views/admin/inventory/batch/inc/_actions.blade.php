<!-- Modal -->
<div class="modal fade" id="staticBackdrop-{{$batch->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">اقدامات دسته شماره {{ $index+1 }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>


            <form id="stock_actions" method="post">
                @csrf
                    <div class="modal-body">


                    <div class="container">
                    <label for="exampleInput" class="form-label">ویرایش تعداد فروش</label>
                    <input type="hidden" value="{{$batch->id}}" name="batchId">
                    <input value="{{ $batch->sales_number ?? 0 }}" type="number" name="sales"  class="form-control" id="exampleInput" placeholder="تعداد فروش" max="{{$batch->quantity}}" min="0">
                    <button id="sendData" type="button" class="btn btn-primary mt-2 w-50">ثبت</button>
                    </div>

                    </div>
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>

            </div>
        </div>
    </div>
</div>