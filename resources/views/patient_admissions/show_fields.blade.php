<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="admissionOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body">
                        <div class="row mb-7">
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.case.patient').(':')  }}</label>
                                <span
                                    class="fs-4 text-gray-800">{{$patientAdmission->patient->user->full_name}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.case.doctor').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{$patientAdmission->doctor->user->full_name}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.bill.admission_id').(':')  }}</label>
                                <p class="m-0">
                                    <span class="badge bg-light-info">{{$patientAdmission->patient_admission_id}}</span>
                                </p>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient_admission.admission_date').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{ !empty($patientAdmission->admission_date)?date('jS M,Y g:i A', strtotime($patientAdmission->admission_date)):'N/A' }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient_admission.discharge_date').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{ !empty($patientAdmission->discharge_date)?date('jS M, Y g:i A', strtotime($patientAdmission->discharge_date)):'N/A'}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient_admission.package').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{ (!empty($patientAdmission->package_id))?$patientAdmission->package->name:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient_admission.insurance').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{ (!empty($patientAdmission->insurance_id))?$patientAdmission->insurance->name:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient_admission.bed').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{(!empty($patientAdmission->bed_id))?$patientAdmission->bed->name:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient_admission.policy_no').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{(!empty($patientAdmission->policy_no))?$patientAdmission->policy_no:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient_admission.agent_name').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{(!empty($patientAdmission->agent_name))?$patientAdmission->agent_name:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient_admission.guardian_name').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{(!empty($patientAdmission->guardian_name))?$patientAdmission->guardian_name:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient_admission.guardian_relation').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{(!empty($patientAdmission->guardian_relation))?$patientAdmission->guardian_relation:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient_admission.guardian_contact').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{(!empty($patientAdmission->guardian_contact))?$patientAdmission->guardian_contact:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient_admission.guardian_address').(':')  }}</label>
                                <span class="fs-4 text-gray-800">{{(!empty($patientAdmission->guardian_address))?$patientAdmission->guardian_address:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.common.status').(':')  }}</label>
                                <p class="m-0">
                                    <span class="badge bg-light-{{($patientAdmission->status === 1) ? 'success' : 'danger'}}">{{($patientAdmission->status === 1) ? __('messages.common.active') : __('messages.common.de_active')}}</span>
                                </p>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.common.created_on').(':')  }}</label>
                                <span data-toggle="tooltip" class="fs-4 text-gray-800" data-placement="right" title="{{ date('jS M, Y', strtotime($patientAdmission->created_at)) }}">{{ $patientAdmission->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span class="fs-4 text-gray-800" data-placement="top"  data-bs-original-title="{{ date('jS M, Y', strtotime($patientAdmission->updated_at)) }}">{{ $patientAdmission->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
