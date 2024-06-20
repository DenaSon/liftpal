<!-- Modal -->
<div class="modal fade" id="editmodal-{{$brand->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <span class="fe-upload font-20"></span> &nbsp;
                <h1 class="modal-title fs-5" id="exampleModalLabel">

                    ویرایش برند
                <span class="text-muted"> {{ $brand->name }} </span>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('brands.update',$brand->id) }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @method('PUT')

                    @csrf
                    <input type="hidden" value="{{ $brand->images->first()->id ?? 0 }}" name="imageId">
                    <div class="m-2">
                        <label for="name" class="form-label"> نام برند  </label> <span class="text-danger">*</span>
                        <input type="text" name="name" placeholder="نام برند " id="name" class="form-control" value="{{$brand->name}}">
                    </div>

                    <div class="m-2">
                        <label for="description" class="form-label"> توضیحات  </label>
                        <input type="text" name="description" placeholder="توضیح کوتاه" id="description" class="form-control" value="{{ $brand->description }}" >
                    </div>


                    <div class="m-2">
                        <label for="description" class="form-label"> لینک  </label>
                        <input type="url" name="link" placeholder="لینک" id="link" class="form-control" value="{{ $brand->link }}">
                    </div>


                    <div class="m-2">
                        <label for="logo" class="form-label"> تصویر لوگو </label>
                        <input type="file" name="logo" placeholder="آپلود لوگو " id="logo" class="form-control bg-light">
                    </div>


                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
</div>
