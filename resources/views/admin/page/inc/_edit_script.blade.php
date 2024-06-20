

<script> // comment reply
    $(document).ready(function() {
        $('.btn-reply').click(function(event) {
            event.preventDefault();

            var commentId = $(this).closest('.list-group-item').data('comment-id');
            var replyText = $(this).closest('.list-group-item').find('textarea').val();



            $.ajax({
                url: '{{ route('liveReplySave') }}', // Replace with your controller's URL
                method: 'POST',
                data: {
                    comment_id: commentId,
                    reply_text: replyText,
                    _token: '{{ csrf_token() }}' // Assuming you are using Laravel's CSRF protection
                },
                success: function(response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'پاسخ ارسال شد',
                            text: 'پاسخ شما با موفقیت ارسال شد!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    console.log(response.message);

                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: 'خطا در ثبت پاسخ'
                    });
                }
            });
        });
    });
</script>



<script> // delete comment
    $(document).ready(function() {


        // Delete Comment Button Click Event
        $('.btn-delete-comment').click(function(event) {
            event.preventDefault();

            var commentId = $(this).closest('.list-group-item').data('comment-id');

            Swal.fire({
                title: 'آیا از حذف دیدگاه مطمئن هستید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله، حذف شود',
                cancelButtonText: 'لغو',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, proceed with delete
                    $.ajax({
                        url: '{{ route('liveDeleteComment') }}', // Replace with your delete route
                        method: 'POST',
                        data: {
                            comment_id: commentId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'حذف دیدگاه',
                                text: 'دیدگاه با موفقیت حذف شد.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // Optionally, you might want to remove the deleted comment from the list
                            $(`.list-group-item[data-comment-id="${commentId}"]`).hide(1000);
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'خطا',
                                text: 'خطا در حذف دیدگاه'
                            });
                        }
                    });
                }
            });
        });
    });
</script>





<script> // delete comment
    $(document).ready(function() {


        // Delete Comment Button Click Event
        $('.btn-confirm').click(function(event) {
            event.preventDefault();

                  var commentId = $(this).closest('.list-group-item').data('comment-id');
                  var confirmBtn = $(`.list-group-item[data-comment-id="${commentId}"] .btn-confirm`);
                  var listItem = $(`.list-group-item[data-comment-id="${commentId}"]`);
            var badge = $(`.list-group-item[data-comment-id="${commentId}"] .status`);

            // User confirmed, proceed with delete
                    $.ajax({
                        url: '{{ route('liveConfirmComment') }}', // Replace with your delete route
                        method: 'POST',
                        data: {
                            comment_id: commentId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if(response.message == 'publish')
                            {

                                confirmBtn.text(' تایید دیدگاه').removeClass('btn-outline-warning').addClass('btn-outline-info');
                                listItem.removeClass('border-success').addClass('border-warning bg-soft-warning');

                                badge.removeClass('badge-outline-success').addClass('badge-outline-warning ').text('در انتظار');

                            }
                            if(response.message == 'hidden')
                            {
                                confirmBtn.text('رد دیدگاه').removeClass('btn-outline-info').addClass('btn-outline-warning');
                                listItem.removeClass('border-warning bg-soft-warning').addClass('border-success ');

                                badge.removeClass('badge-outline-warning ').addClass('badge-outline-success').text('تایید شده');
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'خطا',
                                text: 'خطا در حذف دیدگاه'
                            });
                        }
                    });

            });

    });
</script>






