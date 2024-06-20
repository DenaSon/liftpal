@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Error',
                text: `{!! implode(" - ", $errors->all()) !!}`,
                icon: 'warning', // You can use 'success', 'error', 'warning', etc.
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif
