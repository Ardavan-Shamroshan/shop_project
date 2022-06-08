@if(session('alert-section-warning'))

    <div class="alert alert-warning alert-dismissible fade show">
        <h4 class="alert-heading">&times; هشدار </h4>
        <hr>
        <p class="mb-0">
            {{ session('alert_section_warning') }}
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="right: auto!important; left: 0!important;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif