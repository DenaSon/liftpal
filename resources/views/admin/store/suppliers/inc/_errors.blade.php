@if ($errors->any())

<script>
    document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        title: 'خطا',
        text: "{{($errors)}}",
        icon: 'warning', // You can use 'success', 'error', 'warning', etc.
        confirmButtonText: 'تایید'
    });
    });


</script>

@endif
