<div class="modal fade side-fade" tabindex="-1" id="show_live_consultations_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.live_consultations') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{ Form::hidden('live_consultation_id',null,['id'=>'startLiveConsultationId']) }}
                <div class="row mb-7">
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.consultation_title').(':')  }}</label>
                        <div>
                            <span class="fs-5 text-gray-800" id="showConsultationTitle"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.consultation_date').(':')  }}</label>
                        <div>
                            <span class="fs-5 text-gray-800" id="showConsultationDate"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.consultation_duration_minutes').(':')  }}</label>
                        <div>
                            <span class="fs-5 text-gray-800" id="showConsultationDurationMinutes"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.blood_issue.patient_name').(':')  }}</label>
                        <div>
                            <span class="fs-5 text-gray-800" id="showConsultationPatient"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.blood_issue.doctor_name').(':')  }}</label>
                        <div>
                            <span class="fs-5 text-gray-800" id="showConsultationDoctor"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.type').(':')  }}</label>
                        <div>
                            <span class="fs-5 text-gray-800" id="showConsultationType"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.type_number').(':')  }}</label>
                        <div>
                            <span class="fs-5 text-gray-800" id="showConsultationTypeNumber"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.host_video').(':')  }}</label>
                        <div>
                            <span class="fs-5 text-gray-800" id="showConsultationHostVideo"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.live_consultation.client_video').(':')  }}</label>
                        <div>
                            <span class="fs-5 text-gray-800" id="showConsultationParticipantVideo"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label
                            class="pb-2 fs-5 text-gray-600">{{ __('messages.testimonial.description').(':')  }}</label>
                        <div>
                            <span class="fs-5 text-gray-800" id="showConsultationDescription"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
