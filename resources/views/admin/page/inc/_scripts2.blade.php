<!-- Dropzone file uploads-->
<script src="{{ asset('admin/assets/libs/dropzone/min/dropzone.min.js') }}"></script>

<!-- Init js-->
<script src="{{ asset('admin/assets/js/pages/form-fileuploads.init.js') }}"></script>

<!-- Init js -->
<script src="{{ asset('admin/assets/js/pages/add-product.init.js') }}"></script>

<!-- Init js-->
<script src=" {{ asset('admin/assets/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>


<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace('editor1', {
        language: 'fa', // Set the language to Persian

        // Other CKEditor configuration options
    });
</script>


<script>
    $(document).ready(function() {
        // Get references to form elements
        $('#submit').hide(10);
        const form = $('#myForm');
        const validatorButton = $('#validator');

        // Add click event listener to the custom validation button
        validatorButton.on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Serialize form data
            const formData = form.serialize();  // Use serialize() to get all form data

            // Get CSRF token from the meta tag in the head
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send AJAX request to validate data
            $.ajax({
                url: '{{ route('page-validator') }}',
                type: 'POST',
                dataType: 'json',
                data: formData,  // Pass the serialized form data
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response, status, xhr)
                {
                    $('#submit').show(250);
                },
                error: function(xhr, status, error) {

                    if (xhr.status === 400) {
                        // Forbidden (validation failed) response
                        const errors = xhr.responseJSON.errors;
                        $('#submit').hide(350);
                        showErrorsWithSweetAlert(errors);


                    }

                }
            });
        });


        function showErrorsWithSweetAlert(errors) {
            const errorMessages = Object.values(errors).join('\n');

            Swal.fire({
                icon: 'error',
                title: 'خطا در اعتبارسنجی',
                html: errorMessages.replace(/\n/g, '<li>'), // Replace newlines with <br> for HTML
                confirmButtonText: 'تایید',
                text: errorMessages,
            });
        }

    });


</script>







<script>
    $(document).ready(function() {
        // Get references to form elements
        $('#submit').hide(10);
        const form = $('#myForm');
        const validatorButton = $('#validatorEdit');

        // Add click event listener to the custom validation button
        validatorButton.on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Serialize form data
            const formData = form.serialize();  // Use serialize() to get all form data

            // Get CSRF token from the meta tag in the head
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send AJAX request to validate data
            $.ajax({
                url: '{{ route('page-validator') }}',
                type: 'PUT',
                dataType: 'json',
                data: formData,  // Pass the serialized form data
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response, status, xhr)
                {
                    $('#submit').show(250);
                },
                error: function(xhr, status, error) {

                    if (xhr.status === 400) {
                        // Forbidden (validation failed) response
                        const errors = xhr.responseJSON.errors;
                        $('#submit').hide(350);
                        showErrorsWithSweetAlert(errors);


                    }

                }
            });
        });


        function showErrorsWithSweetAlert(errors) {
            const errorMessages = Object.values(errors).join('\n');

            Swal.fire({
                icon: 'error',
                title: 'خطا در اعتبارسنجی',
                html: errorMessages.replace(/\n/g, '<li>'), // Replace newlines with <br> for HTML
                confirmButtonText: 'تایید',
                text: errorMessages,
            });
        }

    });


</script>


<!-- Include SweetAlert2 library -->


<script>
    // Add an event listener to the reset button
    document.getElementById('resetButton').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default reset behavior

        // Display the SweetAlert2 confirmation dialog
        Swal.fire({
            title: 'اطمینان دارید؟',
            text: "همه ورودی ها به حالت اولیه برمیگردند!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'لغو',
            confirmButtonText: 'بله !'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, reset the form
                document.getElementById('myForm').reset();
                Swal.fire(
                    'انجام شد',
                    '',
                    'success'
                );
            }
        });
    });


</script>



<script>
    $(document).ready(function() {
        $('.btn-remove').on('click', function() {
            const imageId = $(this).data('image-id');

            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                input: 'checkbox',
                inputValue: 0,
                inputPlaceholder:
                    'حذف تصویر از حافظه',

                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'بله، حذف شود',
                cancelButtonText: 'لغو'
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = '{{ route("liveRemoveImg", ["id" => "__id__"]) }}';
                    const ajaxUrl = url.replace('__id__', imageId);
                    const isConfirmedValue = result.value ? 1 : 0;

                    $.ajax({
                        url: ajaxUrl,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            isConfirmed: isConfirmedValue
                        },
                        success: function(response) {
                            $('#' + imageId).closest('.col').hide(650);
                        },
                        error: function(error) {
                            console.error('Error deleting image', error);
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.custom-image-thumb').on('click', function() {
            const imageSrc = $(this).attr('src');

            $('#modalImage').attr('src', imageSrc); // Set the modal image source
            $('#imageModal').modal('show'); // Show the modal
        });
    });
</script>





<script>
    $(document).ready(function() {
        $('#post-title, #editor1,#post-summary,#post-category,.property,.propertyvalue').on('keypress', function() {
            $('#submit').hide();
        });


    });
</script>






