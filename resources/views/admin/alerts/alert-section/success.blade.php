@if(session('alert-section-success'))

    <div class="alert alert-success alert-dismissible fade show">
        <h4 class="alert-heading">عملیات با موفقیت انجام شد</h4>
        <hr>
        <p class="mb-0">
            {{ session('alert-section-success') }}
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="right: auto!important; left: 0!important;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif