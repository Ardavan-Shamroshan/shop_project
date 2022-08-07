@if(session('toast-success'))
    <section class="toast" data-delay="2000">
        <section class="toast-body py-3 d-flex bg-warning text-white">
            <p class="ml-auto mt-3">{{ session('toast-success')}}</p>
            <button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </section>
    </section>

    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        })
    </script>

@endif

