<!-- Modal -->
<div class="modal fade" id="bs-edit-modal-sm-{{$tag->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <span class="fe-upload font-20"></span> &nbsp;
                <h1 class="modal-title fs-5" id="exampleModalLabel">

                    ویرایش برچسب
                <span class="text-muted"> {{ $tag->name }} </span>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('blogTags.update',$tag->id) }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @method('PUT')
                    @csrf

                    <div class="m-2">
                        <label for="name" class="form-label"> نام برچسب  </label> <span class="text-danger">*</span>
                        <input type="text" name="name" placeholder="نام برند " id="name" class="form-control" value="{{$tag->name}}">
                    </div>


                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
</div>
