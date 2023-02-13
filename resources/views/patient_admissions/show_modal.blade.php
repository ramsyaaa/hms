<div id="showPatientAdmission" class="modal fade side-fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.patient_admission.details') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-7">
                    <div class="col-lg-6 mb-5">
                        <label for="patient_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.case.patient').(':') }}</label><br>
                        <span id="showAdmissionPatient_name"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="doctor_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.case.doctor').(':') }}</label><br>
                        <span id="showAdmissionDoctor_name"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="admission_id"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.admission_id').(':') }}</label><br>
                        <span id="showAdmission_id"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="admission_date"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_admission.admission_date').(':') }}</label><br>
                        <span id="showAdmission_date"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="discharge_date"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_admission.discharge_date').(':') }}</label><br>
                        <span id="showAdmissionDischarge_date"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="package"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_admission.package').(':') }}</label><br>
                        <span id="showAdmissionPackage"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="insurance"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_admission.insurance').(':') }}</label><br>
                        <span id="showAdmissionInsurance"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="admission_bed"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_admission.bed').(':') }}</label><br>
                        <span id="showAdmission_bed"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="policy_no"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_admission.policy_no').(':') }}</label><br>
                        <span id="showAdmissionPolicy_no"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="agent_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_admission.agent_name').(':') }}</label><br>
                        <span id="showAdmissionAgent_name"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="guardian_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_admission.guardian_name').(':') }}</label><br>
                        <span id="showAdmissionGuardian_name"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="guardian_relation"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_admission.guardian_relation').(':') }}</label><br>
                        <span id="showAdmissionGuardian_relation"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="guardian_contact"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_admission.guardian_contact').(':') }}</label><br>
                        <span id="showAdmissionGuardian_contact"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="guardian_address"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_admission.guardian_address').(':') }}</label><br>
                        <span id="showAdmissionGuardian_address"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="patient_status"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.status').(':') }}</label><br>
                        <span id="showAdmissionPatient_status"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="created_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="showAdmissionCreated_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <label for="updated_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="showAdmissionUpdated_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
