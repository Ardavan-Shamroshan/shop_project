<script>

    $(document).ready(function () {
        var className = 'delete';
        var element = $('.' + className);

        element.on('click', function (e) {
            e.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },
                buttonsStyling: false,
            });

            swalWithBootstrapButtons.fire({
                title: 'آیا از حذف کردن داده مطمن هستید؟',
                text: "شما میتوانید درخواست خود را لغو نمایید",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
                reverseButtons: true
            }).then((result) => {
                if (result.value === true) {
                    $(this).parent().submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: 'لغو درخواست',
                        text: "درخواست شما لغو شد",
                        icon: 'error',
                        confirmButtonText: 'باشه.'
                    })
                }
            })
        })
    })

</script>
