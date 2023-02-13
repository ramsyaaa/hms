<div>
    <div class="tab-content" id="myInsuranceTabContent">
        <div class="tab-pane fade show active" id="insurancePoverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body">
                        <div class="row mb-7">
                            <div class="col-lg-3 d-flex flex-column mb-md-10 mb-5">
                                <label
                                    class="pb-2 fs-5 text-gray-600">{{ __('messages.insurance.insurance').(':') }}</label>
                                <span class="fs-5 text-gray-800">{{ $insurance->name}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column mb-md-10 mb-5">
                                <label
                                    class="pb-2 fs-5 text-gray-600">{{ __('messages.insurance.service_tax').(':')  }}</label>
                                <span class="fs-5 text-gray-800">
                                    {{ checkNumberFormat($insurance->service_tax, strtoupper($insurance->currency_symbol ?? getCurrentCurrency())) }}
                                </span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.insurance.discount').(':')  }}</label>
                                <span class="fs-5 text-gray-800">{{ isset($insurance->discount) ? $insurance->discount.'%':'N/A'}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.insurance.insurance_no').(':')  }}</label>
                                <span class="fs-5 text-gray-800">{{ $insurance->insurance_no}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.insurance.insurance_code').(':')  }}</label>
                                <span class="fs-5 text-gray-800">{{$insurance->insurance_code }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.insurance.hospital_rate').(':')  }}</label>
                                <span class="fs-5 text-gray-800">
                                    {{ checkNumberFormat($insurance->hospital_rate, strtoupper($insurance->currency_symbol ?? getCurrentCurrency())) }}
                                </span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.total').(':')  }}</label>
                                <span class="fs-5 text-gray-800">
                                    {{ checkNumberFormat($insurance->total, strtoupper($insurance->currency_symbol ?? getCurrentCurrency())) }}
                                </span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.status').(':')  }}</label>
                                <p class="m-0">
                                    <span
                                        class="badge fs-6 bg-light-{{!empty($insurance->status === 1) ? 'success' : 'danger'}}">{{($insurance->status === 1) ? __('messages.common.active') : __('messages.common.de_active')}}</span>
                                </p>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="pb-2 fs-5 text-gray-600">{{ __('messages.insurance.remark').(':')  }}</label>
                                <span
                                    class="fs-5 text-gray-800">{!! !empty($insurance->remark) ? nl2br(e($insurance->remark)):'N/A'  !!}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at').(':')  }}</label>
                                <span
                                    class="fs-5 text-gray-800">{{ $insurance->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span
                                    class="fs-5 text-gray-800">{{ $insurance->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="fs-5 m-0">{{ __('messages.insurance.disease_details') }}</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive viewList">
                    <table id="showInsuranceAccountPayments"
                           class="table table-striped">
                        <thead>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="text-center">#</th>
                            <th class="w-75">
                                {{ __('messages.insurance.diseases_name') }}
                            </th>
                            <th class="w-25 text-right">
                                <div class="d-flex justify-content-end me-3">
                                    {{ __('messages.insurance.diseases_charge') }}
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="fw-bold">
                        @forelse($diseases as $index => $disease)
                            <tr>
                                <td class="text-center w-5">{{ $loop->iteration }}</td>
                                <td>
                                    {{ $disease->disease_name }}
                                </td>
                                <td class="table__qty">
                                    <div class="d-flex justify-content-end me-3">
                                        {{ checkNumberFormat($disease->disease_charge, strtoupper($insurance->currency_symbol ?? getCurrentCurrency())) }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="3">{{__('messages.common.no_data_available')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
