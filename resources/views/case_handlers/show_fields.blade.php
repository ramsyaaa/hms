<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="image image-circle image-small">
                        <img src="{{$caseHandler->user->image_url}}" alt="image" class="object-fit-cover"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="javascript:void(0)"
                                   class="text-gray-800 text-hover-primary fs-2 me-4 text-decoration-none">{{$caseHandler->user->full_name}}</a>
                                <span
                                        class="text-{{ $caseHandler->user->status === 1 ? 'success' : 'danger' }}">{{ ($caseHandler->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </div>
                                <a href="mailto: {{$caseHandler->user->email}}"
                                   class="text-decoration-none d-flex align-items-center text-gray-600 text-hover-primary mb-2 me-2">
                                    {{$caseHandler->user->email}}
                                </a>
                                <span class="d-flex align-items-center text-hover-primary me-5 mb-2">
                                @if(!empty($caseHandler->address->address1) || !empty($caseHandler->address->address2) || !empty($caseHandler->address->city) || !empty($caseHandler->address->zip))
                                        <span><i class="fas fa-location"></i></span>
                                    @endif
                                    <span class="p-2">
                                        {{ !empty($caseHandler->address->address1) ? $caseHandler->address->address1 : '' }}{{ !empty($caseHandler->address->address2) ? !empty($caseHandler->address->address1) ? ',' : '' : '' }}
                                        {{ empty($caseHandler->address->address1) || !empty($caseHandler->address->address2)  ? !empty($caseHandler->address->address2) ? $caseHandler->address->address2 : '' : '' }}
                                        {{!empty($caseHandler->address->city) ? ','.$caseHandler->address->city : ''}} {{ !empty($caseHandler->address->zip) ? ','.$caseHandler->address->zip : '' }}
                                    </span>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-7 overflow-hidden">
        <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap">
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab"
                   href="#caseHandlerOverview">{{ __('messages.overview') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                   href="#caseHandlerPayrolls">{{__('messages.my_payrolls')}}</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="caseHandlerOverview" role="tabpanel">
        <div class="card mb-5 mb-xl-10">
            <div>
                <div class="card-body  border-top p-9">
                    <div class="row">
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.phone')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{!empty($caseHandler->user->phone)?$caseHandler->user->phone:'N/A'}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.gender')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ $caseHandler->user->gender == 0 ? 'Male' : 'Female' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.blood_group')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-6 badge bg-light-{{!empty($caseHandler->user->blood_group) ? 'success' : 'danger'}}">{{ !empty($caseHandler->user->blood_group) ? $caseHandler->user->blood_group : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.dob')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ !empty($caseHandler->user->dob) ? \Carbon\Carbon::parse($caseHandler->user->dob)->format('jS M, Y') : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.designation')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ !empty($caseHandler->user->designation) ? $caseHandler->user->designation : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.qualification')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ !empty($caseHandler->user->qualification) ? $caseHandler->user->qualification : __('messages.common.n/a')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at') }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ !empty($caseHandler->user->created_at) ? $caseHandler->user->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.updated_at') }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ !empty($caseHandler->user->updated_at) ? $caseHandler->user->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="caseHandlerPayrolls" role="tabpanel">
        <livewire:case-handler-payroll-table caseHandlerId="{{$caseHandler->id}}"/>
    </div>
</div>
