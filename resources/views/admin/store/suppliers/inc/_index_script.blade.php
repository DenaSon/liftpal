
<script>//Delete Products with ajax :

    $(document).ready(function() {
        $('.delete-btn').click(async function() {
            const form = $(this).closest('.delete-form');
            const productId = form.data('id');
            const rowId = `row-${productId}`;

            const { value: accept } = await Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: 'محصول و تمام اطلاعات مرتبط با آن حذف خواهند شد!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله، حذف کن!',
                cancelButtonText: 'لغو',
                input: 'checkbox',
                inputPlaceholder:
                    'تایید حذف کامل محصول',
                inputValidator: (result) => {
                    return !result && 'برای ادامه باید حذف را تأیید کنید'
                }
            });

            if (accept) {
                // Make an Ajax request to submit the form
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // Remove the corresponding row from the table
                        $(`#${rowId}`).addClass('bg-soft-danger').hide(1000);

                        console.log(response.message);


                    },
                    error: function(error) {
                        console.log('خطا:', error);
                        Swal.fire('خطا!', 'یک خطا رخ داده است.', 'error');
                    }
                });
            }
        });
    });


</script>
