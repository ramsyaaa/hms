<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ePatientAdmissionOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body">
                        <div class="row mb-7">
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('patient_id', __('messages.case.patient').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ $patientAdmission->patient->patientUser->full_name }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('doctor_id', __('messages.case.doctor').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ $patientAdmission->doctor->doctorUser->full_name }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('admission_id', __('messages.bill.admission_id').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <sapn
                                    class="fs-5 text-gray-800">{{ $patientAdmission->patient_admission_id }}</sapn>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('admission_date', __('messages.patient_admission.admission_date').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ \Carbon\Carbon::parse($patientAdmission->admission_date)->format('jS M, Y g:i A') }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('discharge_date', __('messages.patient_admission.discharge_date').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ !empty($patientAdmission->discharge_date)?date('jS M, Y g:i A', strtotime($patientAdmission->discharge_date)):'N/A' }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('package_id', __('messages.patient_admission.package').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ (!empty($patientAdmission->package_id))?$patientAdmission->package->name:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('insurance_id', __('messages.patient_admission.insurance').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <sapn
                                    class="fs-5 text-gray-800">{{ (!empty($patientAdmission->insurance_id))?$patientAdmission->insurance->name:__('messages.common.n/a') }}</sapn>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('bed_id', __('messages.patient_admission.bed').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ (!empty($patientAdmission->bed_id))?$patientAdmission->bed->name:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('policy_no', __('messages.patient_admission.policy_no').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ (!empty($patientAdmission->policy_no))?$patientAdmission->policy_no:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('agent_name', __('messages.patient_admission.agent_name').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ (!empty($patientAdmission->agent_name))?$patientAdmission->agent_name:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('guardian_name', __('messages.patient_admission.guardian_name').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ (!empty($patientAdmission->guardian_name))?$patientAdmission->guardian_name:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('guardian_relation', __('messages.patient_admission.guardian_relation').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ (!empty($patientAdmission->guardian_relation))?$patientAdmission->guardian_relation:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('guardian_contact', __('messages.patient_admission.guardian_contact').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ (!empty($patientAdmission->guardian_contact))?$patientAdmission->guardian_contact:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('guardian_address', __('messages.patient_admission.guardian_address').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{ (!empty($patientAdmission->guardian_address))?$patientAdmission->guardian_address:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('status', __('messages.common.status').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <p class="m-0">
                                    <span class="badge fs-6 bg-light-{{($patientAdmission->status === 1) ? 'success' : 'danger'}}">
                                        {{ ($patientAdmission->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}
                                    </span>
                                </p>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('created_at', __('messages.common.created_on').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($patientAdmission->created_at)) }}"
                                      class="fs-5 text-gray-800">{{ $patientAdmission->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('updated_at', __('messages.common.last_updated').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($patientAdmission->updated_at)) }}"
                                      class="fs-5 text-gray-800">{{ $patientAdmission->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
