<!-- Modal -->
<div class="modal fade" id="bs-edit-modal-md-{{$menu->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <span class="fe-upload font-20"></span> &nbsp;
                <h1 class="modal-title fs-5" id="exampleModalLabel">

                   ویرایش منو
                    <span class="text-muted"> {{ $menu->name }} </span>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('menu.update',$menu->id) }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @method('PUT')

                    @csrf

                    <div class="m-2">
                        <label for="name" class="form-label"> نام </label><span class="text-danger">*</span>
                        <input type="text" name="name" placeholder="نام Menu " id="name" class="form-control" value="{{$menu->name}}">
                    </div>
                    <div class="m-2">
                        <label for="slug" class="form-label"> کد دسترسی </label><span class="text-danger">*</span>
                        <input type="text" name="slug" placeholder="کد دسترسی" id="slug" class="form-control" value="{{$menu->slug}}">
                    </div>

                    <div class="m-2">
                        <label for="description" class="form-label"> متن </label><span class="text-danger">*</span>
                        <textarea name="description" placeholder="توضیحات" id="description" class="form-control">{{$menu->description}}</textarea>
                    </div>


                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
</div>
