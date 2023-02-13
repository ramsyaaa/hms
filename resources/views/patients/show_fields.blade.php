<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xxl-5 col-12">
                    <div class="d-sm-flex align-items-center mb-5 mb-xxl-0 text-center text-sm-start">
                        <div class="image image-circle image-small">
                            <img src="{{ !empty($data->patientUser->image_url) ? $data->patientUser->image_url : '' }}" alt="image"/>
                        </div>
                        <div class="ms-0 ms-md-10 mt-5 mt-sm-0">
                            <h2><a href="javascript:void(0)"
                                   class="text-decoration-none">{{ !empty($data->patientUser->full_name) ? $data->patientUser->full_name : '' }}</a>
                            </h2>
                            
                            <a href="mailto:{{ !empty($data->patientUser->email) ? $data->patientUser->email : '' }}"
                               class="text-gray-600 text-decoration-none fs-5">
                                {{ !empty($data->patientUser->email) ? $data->patientUser->email : '' }}
                            </a>
                            <span class="d-flex align-items-center me-2 mb-2 mt-2">
                                @if(!empty($data->address->address1) || !empty($data->address->address2) || !empty($data->address->city) || !empty($data->address->zip))
                                    <span><i class="fas fa-location"></i></span>
                                @endif
                                <span class="p-2">
                                    {{ !empty($data->address->address1) ? $data->address->address1 : '' }}{{ !empty($data->address->address2) ? !empty($data->address->address1) ? ',' : '' : '' }}
                                    {{ empty($data->address->address1) || !empty($data->address->address2)  ? !empty($data->address->address2) ? $data->address->address2 : '' : '' }}
                                    {{ empty($data->address->address1) && empty($data->address->address2) ? '' : '' }}{{ !empty($data->address->city) ? ','.$data->address->city : '' }}{{ !empty($data->address->zip) ? ','.$data->address->zip : '' }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7 col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{!empty($data->cases) ? $data->cases->count() : 0}}</h2>
                                <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient.total_cases')}}</h3>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{!empty($data->admissions) ? $data->admissions->count() : 0}}</h2>
                                <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient.total_admissions')}}</h3>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{!empty($data->appointments) ? $data->appointments->count() : 0}}</h2>
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
                   href="#PatientOverview">{{ __('messages.overview') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#showPatientCases">{{ __('messages.cases') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#showPatientAdmissions">{{ __('messages.patient_admissions') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#showPatientAppointments">{{ __('messages.appointments') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#showPatientBills">{{ __('messages.bills') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#showPatientInvoices">{{ __('messages.invoices') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#showPatientAdvancedPayments">{{ __('messages.advanced_payments') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#showPatientDocument">{{ __('messages.documents') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#showPatientVaccinated">{{ __('messages.vaccinations') }}</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content" id="myPatientTabContent">
    <div class="tab-pane fade show active" id="PatientOverview" role="tabpanel">
        <div class="card mb-5 mb-xl-10">
            <div>
                <div class="card-body  border-top p-9">
                    <div class="row">
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.user.phone') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{ !empty($data->patientUser->phone) ? $data->patientUser->phone :__('messages.common.n/a') }}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.user.gender') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{ !empty($data->patientUser->phone) ? ($data->patientUser->gender != 1) ? __('messages.user.male') : __('messages.user.female') : '' }}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.user.blood_group') }}</label>
                            <p>
                                @if(!empty($data->patientUser->blood_group))
                                    <span
                                            class="badge fs-6 bg-light-{{ !empty($data->patientUser->blood_group) ? 'success' : 'danger'  }}"> {{ $data->patientUser->blood_group }} </span>
                                @else
                                    <span
                                            class="fs-5 text-gray-800">{{ __('messages.common.n/a')}}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.user.dob') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{ !empty($data->patientUser->dob) ? \Carbon\Carbon::parse($data->patientUser->dob)->translatedFormat('jS M, Y') : __('messages.common.n/a') }}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{ !empty($data->patientUser->created_at) ? $data->patientUser->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.common.updated_at') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{ !empty($data->patientUser->updated_at) ? $data->patientUser->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="showPatientCases" role="tabpanel">
        <livewire:patient-case-table patientId="{{ $data->id }}"/>
    </div>
    <div class="tab-pane fade" id="showPatientAdmissions" role="tabpanel">
        <livewire:patient-admission-detail-table patientId="{{ $data->id }}"/>
    </div>
    <div class="tab-pane fade" id="showPatientAppointments" role="tabpanel">
        <livewire:patient-appoinment-detail-table patientId="{{ $data->id }}"/>
    </div>
    <div class="tab-pane fade" id="showPatientBills" role="tabpanel">
        <livewire:patient-bill-detail-table patientId="{{ $data->id }}"/>
    </div>
    <div class="tab-pane fade" id="showPatientInvoices" role="tabpanel">
        <livewire:patient-invoice-detail-table patientId="{{ $data->id}}"/>
    </div>
    <div class="tab-pane fade" id="showPatientAdvancedPayments" role="tabpanel">
        <livewire:patient-advance-payment-detail-table patient-id="{{ $data->id }}"/>
    </div>
    <div class="tab-pane fade" id="showPatientDocument" role="tabpanel">
        <livewire:patient-document-table patient-id="{{ $data->id }}"/>
    </div>
    <div class="tab-pane fade" id="showPatientVaccinated" role="tabpanel">
        <livewire:patient-vaccination-detail-table patient-id="{{ $data->id }}"/>
    </div>
</div>
