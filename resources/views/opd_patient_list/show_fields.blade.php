<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body">
            <div class="row">
                <div class="col-xxl-5 col-12">
                    <div class="d-sm-flex align-items-center mb-5 mb-xxl-0 text-center text-sm-start">
                        <div class="image image-circle image-small">
                            <img src="{{ $opdPatientDepartment->patient->patientUser->image_url }}"
                                 class="object-fit-cover" alt="image"/>
                        </div>
                        <div class="ms-0 ms-md-10 mt-5 mt-sm-0">
                            <span class="badge bg-light-warning mb-2">{{ !empty($opdPatientDepartment->opd_number) ? "#".$opdPatientDepartment->opd_number : __('messages.common.n/a') }}</span>
                            <h2><a href="#"
                                   class="text-decoration-none">{{ $opdPatientDepartment->patient->patientUser->full_name }}</a>
                            </h2>
                            <a href="mailto:{{ $opdPatientDepartment->patient->patientUser->email }}"
                               class="text-gray-600 text-decoration-none fs-5">
                                {{ $opdPatientDepartment->patient->patientUser->email }}
                            </a>
                            <sapn class="d-flex align-items-center me-5 mb-2 mt-2">
                                @if(!empty($opdPatientDepartment->patient->address->address1) || !empty($opdPatientDepartment->patient->address->address2) || !empty($opdPatientDepartment->patient->address->city) || !empty($opdPatientDepartment->patient->address->zip))
                                    <span><i class="fas fa-location"></i></span>
                                @endif
                                {{ !empty($opdPatientDepartment->patient->address->address1) ? $opdPatientDepartment->patient->address->address1 : '' }}{{ !empty($opdPatientDepartment->patient->address->address2) ? !empty($opdPatientDepartment->patient->address->address1) ? ',' : '' : '' }}
                                {{ empty($opdPatientDepartment->patient->address->address1) || !empty($opdPatientDepartment->patient->address->address2)  ? !empty($opdPatientDepartment->patient->address->address2) ? $opdPatientDepartment->patient->address->address2 : '' : '' }}
                                {{ empty($opdPatientDepartment->patient->address->address1) && empty($opdPatientDepartment->patient->address->address2) ? '' : '' }}{{ !empty($opdPatientDepartment->patient->address->city) ? ','.$opdPatientDepartment->patient->address->city : '' }}{{ !empty($opdPatientDepartment->patient->address->zip) ? ','.$opdPatientDepartment->patient->address->zip : '' }}
                            </sapn>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7 col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{ !empty($opdPatientDepartment->patient->cases) ? $opdPatientDepartment->patient->cases->count() : 0 }}</h2>
                                <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient.total_cases')}}</h3>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{ !empty($opdPatientDepartment->patient->admissions) ? $opdPatientDepartment->patient->admissions->count() : 0 }}</h2>
                                <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient.total_admissions')}}</h3>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{ !empty($opdPatientDepartment->patient->appointments) ? $opdPatientDepartment->patient->appointments->count() : 0 }}</h2>
                                <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient.total_appointments')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-7 overflow-hidden">
        <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap">
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link active p-0" data-bs-toggle="tab"
                   href="#opdPatientOverview">{{ __('messages.overview') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#opdVisits">{{ __('messages.opd_patient.visits') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#opdDiagnosis">{{ __('messages.ipd_diagnosis') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#opdTimelines">{{ __('messages.ipd_timelines') }}</a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="opdPatientOverview" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.case.case_id').':'  }}</label>
                            <p>
                                <span class="badge bg-light-info">{{ !empty($opdPatientDepartment->case_id) ? $opdPatientDepartment->patientCase->case_id : __('messages.common.n/a') }}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600"> {{ __('messages.ipd_patient.height').':'  }}</label>
                            <span class="fs-5 text-gray-800">{{ !empty($opdPatientDepartment->height) ? $opdPatientDepartment->height : __('messages.common.n/a') }}</span>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.weight').':' }}</label>
                            <span class="fs-5 text-gray-800">{{ !empty($opdPatientDepartment->weight) ? $opdPatientDepartment->weight : __('messages.common.n/a') }}</span>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.bp').':' }}</label>
                            <span class="fs-5 text-gray-800">{{ !empty($opdPatientDepartment->bp) ? $opdPatientDepartment->bp : __('messages.common.n/a') }}</span>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.opd_patient.appointment_date') }}</label>
                            <span class="fs-5 text-gray-800"
                                  title="{{ \Carbon\Carbon::parse($opdPatientDepartment->appointment_date)->diffForHumans() }}">{{ date('jS M, Y h:i A', strtotime($opdPatientDepartment->appointment_date)) }}</span>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.doctor_id').':' }}</label>
                            <span class="fs-5 text-gray-800">{{ $opdPatientDepartment->doctor->doctorUser->full_name }}</span>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_payments.payment_mode') }}</label>
                            <span class="fs-5 text-gray-800">{{ !empty($opdPatientDepartment->payment_mode_name) ? $opdPatientDepartment->payment_mode_name : __('messages.common.n/a') }}</span>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.doctor_opd_charge.standard_charge') }}</label>
                            <span class="fs-5 text-gray-800">
                                @if(!empty($opdPatientDepartment->standard_charge))
                                    {{ checkNumberFormat($opdPatientDepartment->standard_charge, $opdPatientDepartment->currency_symbol ? strtoupper($opdPatientDepartment->currency_symbol) : strtoupper(getCurrentCurrency())) }}
                                @else
                                    {{ __('messages.common.n/a') }}
                                @endif
                            </span>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.is_old_patient').':' }}</label>
                            <span class="fs-5 text-gray-800">{{ ($opdPatientDepartment->is_old_patient) ? __('messages.common.yes') : __('messages.common.no') }}</span>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at').':' }}</label>
                            <span class="fs-5 text-gray-800">{{ !empty($opdPatientDepartment->created_at) ? $opdPatientDepartment->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.common.updated_at').':' }}</label>
                            <span class="fs-5 text-gray-800">{{ !empty($opdPatientDepartment->updated_at) ? $opdPatientDepartment->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.symptoms').':' }}</label>
                            <span class="fs-5 text-gray-800">{!!  !empty($opdPatientDepartment->symptoms)?nl2br(e($opdPatientDepartment->symptoms)) : __('messages.common.n/a')  !!}</span>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.notes').':' }}</label>
                            <span class="fs-5 text-gray-800">{!! !empty($opdPatientDepartment->notes)?nl2br(e($opdPatientDepartment->notes)) : __('messages.common.n/a')  !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="opdVisits" role="tabpanel">
            <livewire:patient-opd-visitor-table patientOpd="{{$opdPatientDepartment->patient_id}}"/>
        </div>
        <div class="tab-pane fade" id="opdDiagnosis" role="tabpanel">
            <livewire:opd-patient-diagnosis-table patientDiagnosis="{{ $opdPatientDepartment->id }}"/>
        </div>
        <div class="tab-pane fade" id="opdTimelines" role="tabpanel">
            <div id="opdTimelines"></div>
        </div>
    </div>
</div>
