<div id="showPatientCase" class="modal fade side-fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.case.case_details') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 mb-5">
                        <label for="case_id"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.operation_report.case_id').(':') }}</label><br>
                        <span id="case_id"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="patient_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.case.patient').(':') }}</label><br>
                        <span id="patient_name"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="patient_phone"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.case.phone').(':') }}</label><br>
                        <span id="patient_phone"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="patient_doctor"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.case.doctor').(':') }}</label><br>
                        <span id="patient_doctor"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="case_date"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.case.case_date').(':') }}</label><br>
                        <span id="case_date"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="case_fee"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.case.fee').(':') }}</label><br>
                        <span id="case_fee"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="created_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="created_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="updated_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="updated_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="patientStatus"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.status').(':') }}</label><br>
                        <span id="patientStatus"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        <label for="description"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.description').(':') }}</label><br>
                        <span id="description"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
