<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xxl-5 col-12">
                    <div class="d-sm-flex align-items-center mb-5 mb-xxl-0 text-center text-sm-start">
                        <div class="image image-circle image-small">
                            <img src="{{ $doctorData->doctorUser->image_url }}" alt="image"/>
                        </div>
                        <div class="ms-0 ms-md-10 mt-5 mt-sm-0">
                            <h2><a href="#"
                                   class="text-decoration-none">{{ $doctorData->doctorUser->full_name }}</a>
                            </h2>
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="mailto:{{ $doctorData->doctorUser->email }}"
                                   class="text-gray-600 text-decoration-none fs-5">
                                    {{ $doctorData->doctorUser->email }}
                                </a>
                                <span class="d-flex align-items-center text-gray-600 text-hover-primary me-5 mb-2">
                                    @if(!empty($doctorData->address->address1) || !empty($doctorData->address->address2) || !empty($doctorData->address->city) || !empty($doctorData->address->zip))
                                        <span><i class="fas fa-location"></i></span>
                                    @endif
                                    <span class="p-2">
                                        {{ !empty($doctorData->address->address1) ? $doctorData->address->address1 : '' }}{{ !empty($doctorData->address->address2) ? !empty($doctorData->address->address1) ? ',' : '' : '' }}
                                        {{ empty($doctorData->address->address1) || !empty($doctorData->address->address2)  ? !empty($doctorData->address->address2) ? $doctorData->address->address2 : '' : '' }}
                                        {{ !empty($doctorData->address->city) ? ','.$doctorData->address->city : '' }} {{ !empty($doctorData->address->zip) ? ','. $doctorData->address->zip : '' }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7 col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{!empty($doctorData->cases) ? $doctorData->cases->count() : 0}}</h2>
                                <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient.total_cases')}}</h3>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{!empty($doctorData->patients) ? $doctorData->patients->count() : 0}}</h2>
                                <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patients')}}</h3>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                            <div class="border rounded-10 p-5 h-100">
                                <h2 class="text-primary mb-3">{{!empty($doctorData->appointments) ? $doctorData->appointments->count() : 0}}</h2>
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
                   href="#doctorOverview">{{ __('messages.overview') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#doctorCases">{{ __('messages.cases') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#doctorPatients">{{ __('messages.patients') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#doctorAppointments">{{ __('messages.appointments') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#doctorSchedules">{{ __('messages.schedules') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#doctorPayroll">{{ __('messages.my_payroll.my_payrolls') }}</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="doctorOverview" role="tabpanel">
        <div class="card mb-5 mb-xl-10">
            <div>
                <div class="card-body  border-top p-9">
                    <div class="row">
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.user.designation') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{$doctorData->doctorUser->designation ?? __('messages.common.n/a')}}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.user.phone') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{!empty($doctorData->doctorUser->phone)?($doctorData->doctorUser->phone):__('messages.common.n/a')}}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.appointment.doctor_department') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{getDoctorDepartment($doctorData->doctor_department_id)}}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.user.qualification') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{$doctorData->doctorUser->qualification ?? __('messages.common.n/a')}}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.user.blood_group') }}</label>
                            <p>
                                @if(!empty($doctorData->doctorUser->blood_group))
                                    <span
                                            class="badge bg-light-{{ !empty($doctorData->doctorUser->blood_group) ? 'success' : 'danger'  }}"> {{ $doctorData->doctorUser->blood_group }} </span>
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
                                <span class="fs-5 text-gray-800">{{ !empty($doctorData->doctorUser->dob) ? \Carbon\Carbon::parse($doctorData->doctorUser->dob)->translatedFormat('jS M,Y') : __('messages.common.n/a')}}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.doctor.specialist') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{$doctorData->specialist}}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.user.gender') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{ ($doctorData->doctorUser->gender != 1) ? __('messages.user.male') : __('messages.user.female') }}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{ !empty($doctorData->doctorUser->created_at) ? $doctorData->doctorUser->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name"
                                   class="pb-2 fs-5 text-gray-600">{{ __('messages.common.updated_at') }}</label>
                            <p>
                                <span class="fs-5 text-gray-800">{{ !empty($doctorData->doctorUser->updated_at) ? $doctorData->doctorUser->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="doctorCases" role="tabpanel">
        <livewire:doctor-cases-table docId="{{$doctorData->id}}"/>
    </div>

    <div class="tab-pane fade" id="doctorPatients" role="tabpanel">
        <livewire:doctor-patient-table docId="{{$doctorData->id}}"/>
    </div>
    <div class="tab-pane fade" id="doctorAppointments" role="tabpanel">
        <livewire:doctor-appointment-table docId="{{$doctorData->id}}"/>
    </div>
    <div class="tab-pane fade" id="doctorSchedules" role="tabpanel">
        <livewire:doctor-schedule-table docId="{{$doctorData->id}}"/>
    </div>
    <div class="tab-pane fade" id="doctorPayroll" role="tabpanel">
        <livewire:doctor-payroll-table docId="{{$doctorData->id}}"/>
    </div>
</div>
