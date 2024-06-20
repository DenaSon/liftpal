

    <script>
        function deleteImage(imageId) {
            Swal.fire({
                title: 'حذف فایل؟',
                text: 'فایل از حافظه پاک خواهد شد!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله, حذف',
                cancelButtonText: 'لغو'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Construct the deletion URL with the image ID
                    var deletionUrl = "{{ route('multimedia.destroy', ['id' => ':imageId']) }}";
                    deletionUrl = deletionUrl.replace(':imageId', imageId);

                    // Perform the redirection
                    window.location.href = deletionUrl;
                }
            });
        }

</script>





    <script>


        // Get references to the form and file input element
        const form = document.getElementById('uploadForm');
        const fileInput = document.getElementById('fileInput');

        // Add an event listener to the file input
        fileInput.addEventListener('change', function() {
            // Check if a file has been selected
            if (fileInput.files.length > 0) {
                // Automatically submit the form when a file is selected
                form.submit();
            }
        });


    </script>
