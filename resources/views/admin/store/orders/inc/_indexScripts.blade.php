<script>//Delete Products with ajax :

    $(document).ready(function() {
        $('.delete-btn').click(async function() {
            const form = $(this).closest('.delete-form');
            const productId = form.data('id');
            const rowId = `row-${productId}`;

            const { value: accept } = await Swal.fire({
                title: 'سفارش حذف شود؟',
                text: 'سفارش و تمام اطلاعات مرتبط با آن حذف خواهند شد!',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'بله، حذف کن!',
                cancelButtonText: 'لغو',
                input: 'checkbox',
                inputPlaceholder:
                    'تایید حذف کامل سفارش',
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
                    success: function(response,text,XHR) {
                        // Remove the corresponding row from the table

                        $(`#${rowId}`).addClass('bg-soft-danger').hide(1000);
                        Swal.fire('سفارش حذف شد', ' ', 'success');


                    },
                    error: function(error) {

                        Swal.fire('خطایی رخ داده است!', 'بخش گزارشات را بررسی کنید ', 'error');
                    }
                });
            }
        });
    });


</script>
