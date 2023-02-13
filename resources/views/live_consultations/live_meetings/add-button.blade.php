<div class="card-toolbar">
    <div class="d-flex align-items-centerK">
        @if (getLoggedInUser()->hasRole(['Admin', 'Doctor']))
            <div class="mr-2 actions-btn">
                <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal"
                   data-bs-target="#add_live_meeting_modal">{{ __('messages.live_consultation.new_live_meeting') }}</a>
            </div>
        @endif
    </div>
</div>
