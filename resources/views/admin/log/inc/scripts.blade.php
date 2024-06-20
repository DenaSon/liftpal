<script>
    function deleteLogs() {
        Swal.fire({
            title: 'حذف همه گزارشات؟',
            text: 'همه گزارشات حذف خواهند شد!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'بله, حذف',
            cancelButtonText: 'لغو'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('log-delete') }}";
            }
        });
    }
</script>
