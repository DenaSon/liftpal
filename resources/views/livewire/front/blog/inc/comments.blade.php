@if($post->comments->count() >0 )
    <div class="mb-4 mb-md-5" id="comments">

        <h3 wire:poll.visible class="mb-4 pb-2 font-vazir">{{ $post->comments->where('status','published')->count() }} نظر ثبت شده</h3>
        <!-- Comment-->
        @foreach($post->comments->where('status','published') as $comment)
        <div class="border-bottom pb-4 mb-4" wire:key="{{ $comment->id }}">

            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center pe-2">
                    <div class="ps-2">
                        <h6 class="fs-base mb-0"> {{ $comment->username }} </h6><span wire:poll.65s class="text-muted fs-sm">{{ jdate($comment->created_at)->ago() }}</span>
                        <p>{{ $comment->text }}</p>
                        @if($comment->reply != null)

                            <p class="text-info small"> <b>پاسخ : </b> {{ $comment->reply }}</p>
                        @endif
                    </div>
                    <hr/>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

<div class="card py-md-4 py-3 shadow-sm">

    <div class="card-body col-lg-8 col-md-10 mx-auto px-md-0 px-4">
        <h3 class="mb-4 pb-sm-2 font-vazir">ثبت نظر شما</h3>
        <form wire:submit="saveComment" class="needs-validation row gy-md-4 gy-3" novalidate="">
        <input wire:model="email" id="email" name="email" style=" display: none">
            <div class="col-sm-6">
                <label class="form-label" for="comment-name">نام</label>
                <input wire:model="comment_name" class="form-control form-control-lg" type="text" id="comment-name"
                       placeholder="نـام"
                       required="">
                <div class="small text-danger">@error('comment_name') {{ $message }} @enderror</div>
                <div class="invalid-feedback">نام خود را وارد کنید</div>
            </div>

            <div class="col-12">
                <label class="form-label" for="comment-text">پیام</label>
                <textarea wire:model="comment_text" class="form-control form-control-lg" id="comment-text" rows="4"
                          placeholder="ثبت نظر"
                          required=""></textarea>
                <div class="small text-danger">@error('comment_text') {{ $message }} @enderror</div>
                <div class="invalid-feedback">نظر خود را تایپ کنید</div>
            </div>
            <div class="col-12 py-2">
                <button class="btn btn-lg btn-primary" type="submit">ارسال</button>
            </div>
        </form>
    </div>

</div>
