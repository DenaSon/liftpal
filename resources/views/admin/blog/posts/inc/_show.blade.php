<div class="modal fade" id="bs-show-modal-lg-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-top modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">

                <span class="fe-file-text font-18"></span> &nbsp;   بازبینی متن مقاله   <div class="text-muted">  &nbsp;{{ $post->title }}  &nbsp; </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">



               <div class="text-justify text-right p-2" style="line-height: 32px">

                {!! $post->content !!}

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</div>
