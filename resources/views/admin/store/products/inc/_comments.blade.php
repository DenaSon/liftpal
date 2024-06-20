<div class="card col-md-6">
    <!-- ... (other card content) ... -->
    <div class="card-body">
        <div class="card-widgets">
            <a data-bs-toggle="collapse" href="#cardCollapse4" role="button" aria-expanded="true" aria-controls="cardCollapse4"><i class="mdi mdi-minus"></i></a>
            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
        </div>
        <h4 class="header-title mb-3">دیدگاه‌های محصول</h4>
        <div id="cardCollapse4" class="pt-3 collapse show">
            <div class="table-responsive">

    <ul class="list-group">
        <!-- Example comment item -->
        @foreach($product->comments->take(30) as $comment)
            <li class="list-group-item  @if($comment->status == 'published') border-success @else border-warning bg-soft-warning @endif shadow-sm " data-comment-id="{{ $comment->id }}">
                <div id="comment-{{$comment->id}}"  class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-1">{{ $comment->username }} میگه :</h5>

                    @if($comment->status == 'published')
                        <small class="badge badge-outline-success status"> تایید شده </small>
                    @else
                        <small class="badge badge-outline-warning status">  در انتظار </small>
                    @endif

                </div>
                <p  class="p-1 my-custom-comment-style font-12 overflow-auto">{{ $comment->text }}</p>

                <!-- Add reply form for each comment -->
                <form class="mt-3">
                    <div class="mb-3">
                        <label for="replyText" class="form-label">پاسخ به دیدگاه:</label>
                        <textarea maxlength="254" class="form-control" id="replyText" rows="3" data-comment-id="{{ $comment->id }}"> {{ $comment->reply }} </textarea>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm me-2 btn-reply">ثبت پاسخ</button>
                    @if($comment->status == 'published')
                        <button type="button" class="btn btn-outline-warning btn-sm me-2 btn-confirm">رد دیدگاه</button>
                    @else
                        <button type="button" class="btn btn-outline-info btn-sm me-2 btn-confirm">تایید دیدگاه</button>
                    @endif
                    <button id="btn-delete-comment" class="btn btn-outline-danger btn-sm me-2 btn-delete-comment">حذف</button>
                    <small class="text-muted float-end">تاریخ: {{ jdate($comment->created_at)->toFormattedDateString() }}</small>
                </form>
            </li>
            <br/>
        @endforeach
        <!-- Repeat for other comments -->
    </ul>
            </div> <!-- .table-responsive -->
        </div> <!-- end collapse -->
    </div>
</div>
