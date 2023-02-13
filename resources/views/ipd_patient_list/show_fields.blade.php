<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xxl-5 col-12">
                    <div class="d-sm-flex align-items-center mb-5 mb-xxl-0 text-center text-sm-start">
                        <div class="image image-circle image-small">
                            <img src="{{ $ipdPatientDepartment->patient->patientUser->image_url }}" class="object-fit-cover"
                                 alt="image"/>
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
                                {{ !empty($ipdPatientDepartment->patient->address->address1) ? $ipdPatientDepartment->patient->address->address1 : '' }}{{ !empty($ipdPatientDepartment->patient->address->address2) ? !empty($ipdPatientDepartment->patient->address->address1) ? ',' : '' : '' }}
                                {{ empty($ipdPatientDepartment->patient->address->address1) || !empty($ipdPatientDepartment->patient->address->address2)  ? !empty($ipdPatientDepartment->patient->address->address2) ? $ipdPatientDepartment->patient->address->address2 : '' : '' }}
                                {{!empty($ipdPatientDepartment->address->city) ? ','.$ipdPatientDepartment->address->city : ''}} {{ !empty($ipdPatientDepartment->address->zip) ? ','.$ipdPatientDepartment->address->zip : '' }}
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
        <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap">
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link active p-0" data-bs-toggle="tab"
                   href="#ipdPatientOverview">{{ __('messages.overview') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#ipdDiagnosis">{{ __('messages.ipd_diagnosis') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#ipdConsultantInstruction">{{ __('messages.ipd_consultant_register') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#ipdCharges">{{ __('messages.ipd_charges') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#ipdPrescriptions">{{ __('messages.ipd_prescription') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#ipdTimelines">{{ __('messages.ipd_timelines') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#ipdPayment">{{ __('messages.account.payments') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link p-0" data-bs-toggle="tab"
                   href="#ipdBill">{{ __('messages.bills') }}</a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ipdPatientOverview" role="tabpanel">
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
                                  title="{{ \Carbon\Carbon::parse($ipdPatientDepartment->admission_date)->diffForHumans() }}">{{ date('jS M, Y h:i A', strtotime($ipdPatientDepartment->admission_date)) }}</span>
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
        <div class="tab-pane fade" id="ipdDiagnosis" role="tabpanel">
            <livewire:ipd-patient-diagnosis-table ipdPatientDepartment="{{ $ipdPatientDepartment->id }}"/>
        </div>
        <div class="tab-pane fade" id="ipdConsultantInstruction" role="tabpanel">
            <livewire:ipd-consultant-register-patient-table ipdPatientDepartment="{{ $ipdPatientDepartment->id }}"/>
        </div>
        <div class="tab-pane fade" id="ipdCharges" role="tabpanel">
            <livewire:ipd-charge-patient-table ipdPatientDepartment="{{ $ipdPatientDepartment->id }}"/>
        </div>
        <div class="tab-pane fade" id="ipdPrescriptions" role="tabpanel">
            <livewire:ipd-prescription-table ipdPrescriptionId="{{ $ipdPatientDepartment->id }}"/>
        </div>
        <div class="tab-pane fade" id="ipdTimelines" role="tabpanel">
            <div id="ipdTimelines"></div>
        </div>
        <div class="tab-pane fade" id="ipdPayment" role="tabpanel">
{{--            <input type="hidden" name="charge_currency" value="{{ $bill['payment_currency']->currency_symbol ?? getCurrentCurrency() }}" id="payment_currency">--}}
{{--            @dump($ipdPatientDepartment->bill->net_payable_amount > 0)--}}
            @if($ipdPatientDepartment->bill && $ipdPatientDepartment->bill->net_payable_amount > 0)
                {{--                        <div class="card-title">--}}
                <button id="ipdPaymentBtn" class="btn btn-primary filter-container__btn float-end" data-turbo="false">
                    {{ __('messages.ipd_payments.make_payment') }}
                </button>
                {{--                        </div>--}}
{{--            @dump($bill['patient_net_payable_amount'])--}}
{{--                <input type="hidden" name="net_payable_amount" id="billAmount"--}}
{{--                       value="{{ $ipdPatientDepartment->bill->net_payable_amount }}"/>--}}
                <input type="hidden" name="net_payable_amount" id="billAmount"
                       value="{{ $bill['patient_net_payable_amount'] }}"/>
                <input type="hidden" name="ipd_number" id="ipdNumber"
                       value="{{$ipdPatientDepartment->ipd_number }}"/>
            @endif
            <livewire:ipd-payment-table ipdPatientDepartmentId="{{ $ipdPatientDepartment->id }}"/>
        </div>
        <div class="tab-pane fade" id="ipdBill" role="tabpanel">
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
