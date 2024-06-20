<script>
    function confirmDelete(sliderId) {
        Swal.fire({
            title: 'اسلایدر حذف شود؟',
            text: 'تمام تنظیمات و تصاویر اسلایدر حذف خواهند شد',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'بله, حذف!',
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, submit the form
                document.getElementById('deleteform-' + sliderId).submit();
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        $(".btn-remove").on("click", function () {
            var imageId = $(this).data("image-id");
            var $imageCol = $(this).closest(".col"); // Get the parent col element

            $.ajax({
                url: "{{ route('delete-slider-image', ':id') }}".replace(':id', imageId),
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Assuming your Laravel controller returns a success message
                    console.log(response.message);

                    // Remove the deleted image col from the DOM
                    $imageCol.remove();
                },
                error: function (xhr, status, error) {
                    console.error(error);
                },
            });
        });
    });
</script>
