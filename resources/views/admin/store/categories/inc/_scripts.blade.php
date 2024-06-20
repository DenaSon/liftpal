<script src="{{ asset('admin/assets/js/pages/select2lib.js') }}"></script>

<script>
    $('.js-example-basic-single').select2({
        placeholder: 'Select an option'
    });

</script>


<script>
    $(document).ready(function () {
        $(".delete-category").click(function () {

            var categoryId = $(this).data("category-id");

            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: "دسته مورد نظر حذف خواهد شد!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله، حذف شود!',
                cancelButtonText: 'لغو'
            }).then((result) => {
                if (result.isConfirmed) {
                    // در صورت تأیید کاربر
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: '{{ route('categories.destroy',0)}}',
                        type: 'DELETE', // متد HTTP
                        data: {
                            "_token": csrfToken,
                            "category_id": categoryId // ارسال ایدی دسته به کنترلر


                        },
                        success: function (response) {
                                console.log(response.message);
                            // به طور مثال: $(this).closest("li").remove();
                        },
                        error: function (xhr) {
                            // در صورت خطا، اقدامات مورد نیاز انجام می‌شود
                            console.log("خطا در حذف دسته: " + xhr.statusText);
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    function confirmDelete(categoryId) {
        Swal.fire({
            title: 'آیا اطمینان دارید؟',
            text: "دسته با زیر دسته های آن حذف خواهند شد!",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'بله, حذف کن!',
            cancelButtonText: 'لغو',
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, submit the form
                document.getElementById('deleteForm-' + categoryId).submit();
            }
        });
    }

    function confirmDeleteSub(subcategoryId) {
        Swal.fire({
            title: 'آیا اطمینان دارید؟',
            text: "زیر دسته حذف خواهد شد!",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'بله, حذف کن!',
            cancelButtonText: 'لغو',
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, submit the form
                document.getElementById('delSub-' + subcategoryId).submit();
            }
        });
    }


    function confirmDeleteInner(innerSubId) {
        Swal.fire({
            title: 'آیا اطمینان دارید؟',
            text: "زیر دسته حذف خواهد شد!",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'بله, حذف کن!',
            cancelButtonText: 'لغو',
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, submit the form
                document.getElementById('innersub-' + innerSubId).submit();
            }
        });
    }




</script>

<script>
    $(document).ready(function() {
        $(".showsub").click(function() {

            $(this).find(".hidden-cat").slideToggle();
        });
    });
</script>
