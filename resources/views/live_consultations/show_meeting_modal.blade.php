<div class="modal fade side-fade" tabindex="-1" id="show_live_meetings_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.live_meetings') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{ Form::hidden('live_Meeting_id',null,['id'=>'showMeetingId']) }}
                <div class="row mb-7">
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.consultation_title').(':')  }}</label>
                        <div class="col-lg-8">
                            <span class="fs-5 text-gray-800" id="showMeetingTitle"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.consultation_date').(':')  }}</label>
                        <div class="col-lg-8">
                            <span class="fs-5 text-gray-800" id="showMeetingDate"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.consultation_duration_minutes').(':')  }}</label>
                        <div class="col-lg-8">
                            <span class="fs-5 text-gray-800" id="showMeetingMinutes"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.host_video').(':')  }}</label>
                        <div class="col-lg-8">
                            <span class="fs-5 text-gray-800" id="showMeetingHost"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.client_video').(':')  }}</label>
                        <div class="col-lg-8">
                            <span class="fs-5 text-gray-800" id="showMeetingParticipant"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.testimonial.description').(':')  }}</label>
                        <div class="col-lg-8">
                            <span class="fs-5 text-gray-800" id="showMeetingDescription"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
