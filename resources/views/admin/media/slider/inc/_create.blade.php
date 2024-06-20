<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <span class="fe-image font-20"></span> &nbsp;
                <h1 class="modal-title fs-5" id="exampleModalLabel">ایجاد اسلایدر</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('slider.store') }}" method="post">
            <div class="modal-body">


                @csrf
                    <div class="m-2">
                        <label for="caption" class="form-label"> عنوان  </label>
                        <input type="text" name="caption" placeholder="عنوان اسلایدر" id="caption" class="form-control">
                    </div>


                    <div class="m-2">
                        <label for="name" class="form-label"> کد دسترسی  </label>
                        <input type="text" name="name" placeholder="نام اسلایدر" id="name" class="form-control bg-light" readonly value="{{ \Illuminate\Support\Str::random(8) }}">
                    </div>






            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">ذخیره</button>
            </div>
            </form>
        </div>
    </div>
</div>
