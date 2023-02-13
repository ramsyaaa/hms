<div id="showPrescription" class="modal fade side-fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.prescription.prescription_details') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="patient_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.patient').(':') }}</label><br>
                        <span id="showPrescriptionPatientName"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="doctor_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.case.doctor').(':') }}</label><br>
                        <span id="showPrescriptionDoctorName"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="food_allergies"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.food_allergies').(':') }}</label><br>
                        <span id="showPrescriptionFoodAllergies"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="tendency_bleed"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.tendency_bleed').(':') }}</label><br>
                        <span id="showPrescriptionTendencyBleed"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="heart_disease"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.heart_disease').(':') }}</label><br>
                        <span id="showPrescriptionHeartDisease"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="high_blood_pressure"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.high_blood_pressure').(':') }}</label><br>
                        <span id="showPrescriptionHighBloodPressure"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="diabetic"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.diabetic').(':') }}</label><br>
                        <span id="showPrescriptionDiabetic"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="surgery"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.surgery').(':') }}</label><br>
                        <span id="showPrescriptionSurgery"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="accident"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.accident').(':') }}</label><br>
                        <span id="showPrescriptionAccident"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="others"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.others').(':') }}</label><br>
                        <span id="showPrescriptionOthers"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="medical_history"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.medical_history').(':') }}</label><br>
                        <span id="showPrescriptionMedicalHistory"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="current_medication"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.current_medication').(':') }}</label><br>
                        <span id="showPrescriptionCurrentMedication"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="female_pregnancy"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.female_pregnancy').(':') }}</label><br>
                        <span id="showPrescriptionFemalePregnancy"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="breast_feeding"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.breast_feeding').(':') }}</label><br>
                        <span id="showPrescriptionBreastFeeding"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="health_insurance"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.health_insurance').(':') }}</label><br>
                        <span id="showPrescriptionHealthInsurance"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="low_income"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.low_income').(':') }}</label><br>
                        <span id="showPrescriptionLowIncome"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="reference"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.prescription.reference').(':') }}</label><br>
                        <span id="showPrescriptionReference"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="status"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.status').(':') }}</label><br>
                        <span id="showPrescriptionStatus"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="created_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="showPrescriptionCreatedOn"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 mb-10">
                        <label for="updated_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="showPrescriptionUpdatedOn"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
