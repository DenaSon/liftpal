<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>



<script>
    $(document).ready(function() {

        $('.js-example-basic-single-standards').select2({
            // Options go here
            placeholder: 'انتخاب استاندارد  ', // Placeholder text
            width: '100%',
            theme: "classic",
            tags:true
        });

        });

</script>


<script>
    $(document).ready(function() {

        $('.js-example-basic-single-country').select2({
            // Options go here
            placeholder: 'انتخاب کشور  ', // Placeholder text
            width: '100%',
            theme: "classic",
            tags:true
        });

    });

</script>


<script>
    $(document).ready(function() {

        $('.js-example-basic-single-suppliers').select2({
            // Options go here
            placeholder: 'انتخاب تامین کننده  ', // Placeholder text
            width: '100%',
            theme: "classic",
            tags:true
        });

    });

</script>




<script>
    $(document).ready(function() {

        $('.js-example-basic-single-sections').select2({
            // Options go here
            placeholder: 'انتخاب بخش ', // Placeholder text
            width: '100%',
            theme: "classic",
            tags:true
        });

    });

</script>


<script>
    $(document).ready(function() {

        $('.js-example-basic-single-types').select2({
            // Options go here
            placeholder: 'انتخاب نوع', // Placeholder text
            width: '100%',
            theme: "classic",
            tags:false
        });

    });

</script>




<script>
    $(document).ready(function() {
        $('.btn-removBatch').on('click', function() {
            const batchId = $(this).data('batch-id');

            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                input: 'checkbox',
                inputValue: 0,
                inputPlaceholder:
                    'تایید حذف دسته از انبار',

                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'بله، حذف شود',
                cancelButtonText: 'لغو'
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = '{{ route("liveRemoveBatch", ["id" => "__id__"]) }}';
                    const ajaxUrl = url.replace('__id__', batchId);
                    const isConfirmedValue = result.value ? 1 : 0;
                    console.log(batchId);

                    $.ajax({
                        url: ajaxUrl,
                        type: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            isConfirmed: isConfirmedValue
                        },
                        success: function(response) {
                            $('.batch-' + batchId).hide(400);

                        },
                        error: function(error) {

                        }
                    });
                }
            });
        });
    });
</script>

<!-- Add this to the end of your Blade file, within a script tag or in a separate JavaScript file -->
<script>
    $(document).ready(function () {
        // Bind click event to the "ثبت" button
        $('#sendData').click(function () {
            // Get the data from the input fields
            var batchId = $('input[name="batchId"]').val();
            var sales = $('input[name="sales"]').val();

            // Make an Ajax request
            $.ajax({
                url: '{{ route("live_increase_sales") }}',
                type: 'POST',
                data: {
                    batchId: batchId,
                    sales: sales,
                    // Add any other data you need to send to the controller
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token for security
                },
                success: function (response) {

                    Swal.fire({
                        icon: 'success',
                        title: 'تغییر فروش',
                        text: 'تعداد فروش برای محصول ثبت شد',
                    });
                    location.reload();


                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'خطا ',
                        text: 'تعداد فروش نمی تواند از موجودی بیشتر باشد!',
                    });
                }
            });
        });
    });
</script>



