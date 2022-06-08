@if(session('swal-success'))

    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'success',
                title: 'عملیات با موفقیت انجام شد',
                text: '{{ session('swal-success') }}',
                confirmButtonText: 'باشه',
            });
        });
    </script>

@endif