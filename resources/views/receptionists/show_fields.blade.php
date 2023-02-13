<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="image image-circle image-small">
                        <img src="{{$receptionist->user->image_url}}" class="object-fit-cover" alt="image"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="javascript:void(0)"
                                   class="text-gray-800 text-hover-primary fs-2 me-4 text-decoration-none">{{$receptionist->user->full_name}}</a>
                                <span
                                        class="badge bg-light-{{ $receptionist->user->status === 1 ? 'success' : 'danger' }} fw-bolder ms-2 fs-8 py-1 px-3">{{ ($receptionist->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </div>
                            <a href="mailto: {{$receptionist->user->email}}"
                               class="text-decoration-none d-flex align-items-center text-gray-600 text-hover-primary mb-2 me-2">
                                {{$receptionist->user->email}}
                            </a>
                            <span class="d-flex align-items-center text-hover-primary me-5 mb-2">
                                @if(!empty($receptionist->address->address1) || !empty($receptionist->address->address2) || !empty($receptionist->address->city) || !empty($receptionist->address->zip))
                                    <span><i class="fas fa-location"></i></span>
                                @endif
                                <span class="p-2">
                                    {{ !empty($receptionist->address->address1) ? $receptionist->address->address1 : '' }}{{ !empty($receptionist->address->address2) ? !empty($receptionist->address->address1) ? ',' : '' : '' }}
                                    {{ empty($receptionist->address->address1) || !empty($receptionist->address->address2)  ? !empty($receptionist->address->address2) ? $receptionist->address->address2 : '' : '' }}
                                    {{ empty($receptionist->address->address1) && empty($receptionist->address->address2) ? __('messages.common.n/a') : '' }} {{!empty($receptionist->address->city) ? ','.$receptionist->address->city : ''}} {{ !empty($receptionist->address->zip) ? ','.$receptionist->address->zip : '' }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex overflow-auto h-55px">
        <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap">
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab"
                   href="#receptionistPoverview">{{ __('messages.overview') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                   href="#receptionalistPayrolls">{{__('messages.my_payrolls')}}</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content" id="myReceptionistTabContent">
    <div class="tab-pane fade show active" id="receptionistPoverview" role="tabpanel">
        <div class="card mb-5 mb-xl-10">
            <div>
                <div class="card-body  border-top p-9">
                    <div class="row mb-7">
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.phone')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{!empty($receptionist->user->phone)?$receptionist->user->phone:'N/A'}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.gender')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ $receptionist->user->gender == 0 ? 'Male' : 'Female' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.blood_group')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-6 badge bg-light-{{!empty($receptionist->user->blood_group) ? 'success' : 'danger'}}">{{ !empty($receptionist->user->blood_group) ? $receptionist->user->blood_group : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.dob')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ !empty($receptionist->user->dob) ? \Carbon\Carbon::parse($receptionist->user->dob)->translatedFormat('jS M, Y') : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.designation')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ !empty($receptionist->user->designation) ? $receptionist->user->designation : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.qualification')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ !empty($receptionist->user->qualification) ? $receptionist->user->qualification : __('messages.common.n/a')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at') }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ !empty($receptionist->user->created_at) ? $receptionist->user->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.updated_at') }}</label>
                            <div class="col-lg-8">
                                <span class="fs-5 text-gray-800">{{ !empty($receptionist->user->updated_at) ? $receptionist->user->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="receptionalistPayrolls" role="tabpanel">
        <livewire:receptionist-payroll-table receptionistId="{{$receptionist->id}}"/>
    </div>
</div>
