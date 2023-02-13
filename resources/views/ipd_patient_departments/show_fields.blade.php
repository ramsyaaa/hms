<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xxl-5 col-12">
                    <div class="d-sm-flex align-items-center mb-5 mb-xxl-0 text-center text-sm-start">
                        <div class="image image-circle image-small">
                            <img src="{{ $ipdPatientDepartment->patient->patientUser->image_url }}" alt="image"/>
                        </div>
                        <div class="ms-0 ms-md-10 mt-5 mt-sm-0">
                            <span class="badge bg-light-warning mb-2">{{ !empty($ipdPatientDepartment->ipd_number) ? "#".$ipdPatientDepartment->ipd_number : __('messages.common.n/a') }}</span>
                            <h2><a href="#"
                                   class="text-decoration-none">{{ $ipdPatientDepartment->patient->patientUser->full_name }}</a>
                            </h2>
                            <a href="mailto:{{ $ipdPatientDepartment->patient->patientUser->email }}"
                               class="text-gray-600 text-decoration-none fs-5">
                                {{ $ipdPatientDepartment->patient->patientUser->email }}
                            </a>
                            <sapn class="d-flex align-items-center me-5 mb-2 mt-2">
                                @if(!empty($ipdPatientDepartment->patient->address->address1) || !empty($ipdPatientDepartment->patient->address->address2) || !empty($ipdPatientDepartment->patient->address->city) || !empty($ipdPatientDepartment->patient->address->zip))
                                    <span><i class="fas fa-location"></i></span>
                                @endif
                                <span class="p-2">
                                    {{ !empty($ipdPatientDepartment->patient->address->address1) ? $ipdPatientDepartment->patient->address->address1 : '' }}{{ !empty($ipdPatientDepartment->patient->address->address2) ? !empty($ipdPatientDepartment->patient->address->address1) ? ',' : '' : '' }}
                                    {{ empty($ipdPatientDepartment->patient->address->address1) || !empty($ipdPatientDepartment->patient->address->address2)  ? !empty($ipdPatientDepartment->patient->address->address2) ? $ipdPatientDepartment->patient->address->address2 : '' : '' }}
                                    {{!empty($ipdPatientDepartment->address->city) ? ','.$ipdPatientDepartment->address->city : ''}} {{ !empty($ipdPatientDepartment->address->zip) ? ','.$ipdPatientDepartment->address->zip : '' }}
                                </span>
                            </sapn>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7 col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{ !empty($ipdPatientDepartment->patient->cases) ? $ipdPatientDepartment->patient->cases->count() : 0 }}</h2>
                                <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient.total_cases')}}</h3>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{ !empty($ipdPatientDepartment->patient->admissions) ? $ipdPatientDepartment->patient->admissions->count() : 0}}</h2>
                                <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient.total_admissions')}}</h3>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{ !empty($ipdPatientDepartment->patient->appointments) ? $ipdPatientDepartment->patient->appointments->count() : 0 }}</h2>
                                <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient.total_appointments')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-7 overflow-hidden">
        <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <button class="nav-link active p-0" id="ipdOverview" data-bs-toggle="tab" data-bs-target="#poverview"
                        type="button" role="tab" aria-controls="overview" aria-selected="true">
                    {{ __('messages.overview') }}
                </button>
            </li>
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <button class="nav-link p-0" id="cases-tab" data-bs-toggle="tab" data-bs-target="#ipdDiagnosis"
                        type="button" role="tab" aria-controls="cases" aria-selected="false">
                    {{ __('messages.ipd_diagnosis') }}
                </button>
            </li>
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <button class="nav-link p-0" id="patients-tab" data-bs-toggle="tab"
                        data-bs-target="#ipdConsultantInstruction"
                        type="button" role="tab" aria-controls="patients" aria-selected="false">
                    {{ __('messages.ipd_consultant_register') }}
                </button>
            </li>
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <button class="nav-link p-0" id="patients-tab" data-bs-toggle="tab" data-bs-target="#ipdCharges"
                        type="button" role="tab" aria-controls="patients" aria-selected="false">
                    {{ __('messages.ipd_charges') }}
                </button>
            </li>
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <button class="nav-link p-0" id="patients-tab" data-bs-toggle="tab" data-bs-target="#ipdPrescriptions"
                        type="button" role="tab" aria-controls="patients" aria-selected="false">
                    {{ __('messages.ipd_prescription') }}
                </button>
            </li>
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <button class="nav-link p-0" id="patients-tab" data-bs-toggle="tab" data-bs-target="#ipdTimelines"
                        type="button" role="tab" aria-controls="patients" aria-selected="false">
                    {{ __('messages.ipd_timelines') }}
                </button>
            </li>
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <button class="nav-link p-0" id="patients-tab" data-bs-toggle="tab" data-bs-target="#ipdPayment"
                        type="button" role="tab" aria-controls="patients" aria-selected="false">
                    {{ __('messages.account.payments') }}
                </button>
            </li>
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <button class="nav-link p-0" id="patients-tab" data-bs-toggle="tab" data-bs-target="#ipdBill"
                        type="button" role="tab" aria-controls="patients" aria-selected="false">
                    {{ __('messages.bills') }}
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="poverview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.case.case_id').':'  }}</label>
                                <p>
                                    <span class="badge bg-light-info">{{ !empty($ipdPatientDepartment->case_id) ? $ipdPatientDepartment->patientCase->case_id : __('messages.common.n/a') }}</span>
                                </p>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600"> {{ __('messages.ipd_patient.height').':'  }}</label>
                                <span class="fs-5 text-gray-800">{{ !empty($ipdPatientDepartment->height) ? $ipdPatientDepartment->height : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.weight').':' }}</label>
                                <span class="fs-5 text-gray-800">{{ !empty($ipdPatientDepartment->weight) ? $ipdPatientDepartment->weight : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.bp').':' }}</label>
                                <span class="fs-5 text-gray-800">{{ !empty($ipdPatientDepartment->bp) ? $ipdPatientDepartment->bp : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.admission_date').':' }}</label>
                                <span class="fs-5 text-gray-800"
                                      title="{{ \Carbon\Carbon::parse($ipdPatientDepartment->admission_date)->diffForHumans() }}">{{ 
    \Carbon\Carbon::parse($ipdPatientDepartment->admission_date)->translatedFormat('jS M, Y') }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.doctor_id').':' }}</label>
                                <span class="fs-5 text-gray-800">{{ $ipdPatientDepartment->doctor->doctorUser->full_name }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.bed_type_id').':' }}</label>
                                <span class="fs-5 text-gray-800">{{ $ipdPatientDepartment->bedType->title }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.bed_id').':' }}</label>
                                <span class="fs-5 text-gray-800">{{ $ipdPatientDepartment->bed->name }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.is_old_patient').':' }}</label>
                                <span class="fs-5 text-gray-800">{{ ($ipdPatientDepartment->is_old_patient) ? __('messages.common.yes') : __('messages.common.no') }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at').':' }}</label>
                                <span class="fs-5 text-gray-800">{{ !empty($ipdPatientDepartment->created_at) ? $ipdPatientDepartment->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.common.updated_at').':' }}</label>
                                <span class="fs-5 text-gray-800">{{ !empty($ipdPatientDepartment->updated_at) ? $ipdPatientDepartment->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.symptoms').':' }}</label>
                                <span class="fs-5 text-gray-800">{!!   !empty($ipdPatientDepartment->symptoms)?nl2br(e($ipdPatientDepartment->symptoms)) : __('messages.common.n/a') !!}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name"
                                       class="pb-2 fs-5 text-gray-600">{{ __('messages.ipd_patient.notes').':' }}</label>
                                <span class="fs-5 text-gray-800">{!! !empty($ipdPatientDepartment->notes)?nl2br(e($ipdPatientDepartment->notes)) : __('messages.common.n/a')  !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="ipdDiagnosis" role="tabpanel" aria-labelledby="cases-tab">
                <livewire:ipd-diagnosis-table ipdDiagnosisId="{{ $ipdPatientDepartment->id }}"/>
            </div>
            <div class="tab-pane fade" id="ipdConsultantInstruction" role="tabpanel" aria-labelledby="cases-tab">
                <livewire:ipd-consultant-register-table ipdDiagnosisId="{{ $ipdPatientDepartment->id }}"/>
            </div>
            <div class="tab-pane fade" id="ipdCharges" role="tabpanel" aria-labelledby="cases-tab">
                @if(!$ipdPatientDepartment->bill_status)
                    <div class="card-title">
                        <a href="javascript:void(0)" class="btn btn-primary float-end" data-bs-toggle="modal"
                           data-bs-target="#addIpdChargesModal">
                            {{ __('messages.ipd_patient_charges.new_charge') }}
                        </a>
                    </div>
                @endif
                <livewire:ipd-charge-table ipdDiagnosisId="{{ $ipdPatientDepartment->id }}"/>
            </div>
            <div class="tab-pane fade" id="ipdPrescriptions" role="tabpanel" aria-labelledby="cases-tab">
                <a href="javascript:void(0)" class="btn btn-primary float-end" data-bs-toggle="modal"
                   data-bs-target="#addIpdPrescriptionModal">
                    {{ __('messages.ipd_patient_prescription.new_prescription') }}
                </a>
                <livewire:ipd-prescription-table ipdPrescriptionId="{{ $ipdPatientDepartment->id }}"/>
            </div>
            <div class="tab-pane fade" id="ipdTimelines" role="tabpanel" aria-labelledby="cases-tab">
                <div id="ipdTimelines"></div>
            </div>
            <div class="tab-pane fade" id="ipdPayment" role="tabpanel" aria-labelledby="cases-tab">
                @if($ipdPatientDepartment->bill)
                    @if($ipdPatientDepartment->bill->net_payable_amount > 0)
                        <a href="javascript:void(0)" class="btn btn-primary float-end"
                           data-bs-toggle="modal"
                           data-bs-target="#addIpdPaymentModal">
                            {{ __('messages.payment.new_payment') }}
                        </a>
                    @endif
                @else
                    <a href="javascript:void(0)" class="btn btn-primary float-end"
                       data-bs-toggle="modal"
                       data-bs-target="#addIpdPaymentModal">
                        {{ __('messages.payment.new_payment') }}
                    </a>
                @endif
                <livewire:ipd-payment-table ipdPatientDepartmentId="{{ $ipdPatientDepartment->id }}"/>
            </div>
            <div class="tab-pane fade" id="ipdBill" role="tabpanel" aria-labelledby="cases-tab">
                <div class="table-responsive viewList overflow-hidden">
                    <div class="card">
                        <div class="card-body">
                            @include('ipd_bills.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
