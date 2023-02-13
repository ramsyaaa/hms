<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="image image-circle image-small">
                        <img src="{{$pharmacist->user->image_url}}" class="object-fit-cover" alt="image"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="javascript:void(0)"
                                   class="text-gray-800 text-hover-primary fs-2 me-4 text-decoration-none">{{$pharmacist->user->full_name}}</a>
                                <span
                                        class="text-{{ $pharmacist->user->status === 1 ? 'success' : 'danger' }} mb-2 d-block">{{ ($pharmacist->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </div>
                                <a href="mailto:{{$pharmacist->user->email}}"
                                   class="text-decoration-none d-flex align-items-center text-gray-600 text-hover-primary mb-2 me-2">
                                    {{$pharmacist->user->email}}
                                </a>
                                <span class="d-flex align-items-center text-hover-primary me-5 mb-2">
                                    @if(!empty($pharmacist->address->address1) || !empty($pharmacist->address->address2) || !empty($pharmacist->address->city) || !empty($pharmacist->address->zip))
                                        <span><i class="fas fa-location"></i></span>
                                    @endif
                                    <span class="p-2">
                                        {{ !empty($pharmacist->address->address1) ? $pharmacist->address->address1 : '' }}{{ !empty($pharmacist->address->address2) ? !empty($pharmacist->address->address1) ? ',' : '' : '' }}
                                        {{ empty($pharmacist->address->address1) || !empty($pharmacist->address->address2)  ? !empty($pharmacist->address->address2) ? $pharmacist->address->address2 : '' : '' }}
                                        {{ empty($pharmacist->address->address1) && empty($pharmacist->address->address2) ? '' : '' }} {{!empty($pharmacist->address->city) ? ','.$pharmacist->address->city : ''}} {{ !empty($pharmacist->address->zip) ? ','.$pharmacist->address->zip : '' }}
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
                   href="#pharmacistPoverview">{{ __('messages.overview') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3">
                <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                   href="#pharmacistsPayrolls">{{__('messages.my_payrolls')}}</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myPharmacistTabContent">
        <div class="tab-pane fade show active" id="pharmacistPoverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row">
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.phone')  }}</label>
                                <div class="col-lg-8">
                                    <span class="fs-5 text-gray-800">{{!empty($pharmacist->user->phone)?$pharmacist->user->phone:'N/A'}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.gender')  }}</label>
                                <div class="col-lg-8">
                                    <span class="fs-5 text-gray-800">{{ $pharmacist->user->gender == 0 ? 'Male' : 'Female' }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.blood_group')  }}</label>
                                <div class="col-lg-8">
                                    <span class="badge bg-light-{{!empty($pharmacist->user->blood_group) ? 'success' : 'danger'}}">{{ !empty($pharmacist->user->blood_group) ? $pharmacist->user->blood_group : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.dob')  }}</label>
                                <div class="col-lg-8">
                                    <span class="fs-5 text-gray-800">{{ !empty($pharmacist->user->dob) ? \Carbon\Carbon::parse($pharmacist->user->dob)->translatedFormat('jS M, Y') : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.designation')  }}</label>
                                <div class="col-lg-8">
                                    <span class="fs-5 text-gray-800">{{ !empty($pharmacist->user->designation) ? $pharmacist->user->designation : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.qualification')  }}</label>
                                <div class="col-lg-8">
                                    <span class="fs-5 text-gray-800">{{ !empty($pharmacist->user->qualification) ? $pharmacist->user->qualification : __('messages.common.n/a')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at')  }}</label>
                                <div class="col-lg-8">
                                    <span class="fs-5 text-gray-800">{{ !empty($pharmacist->user->created_at) ? $pharmacist->user->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.updated_at')  }}</label>
                                <div class="col-lg-8">
                                    <span class="fs-5 text-gray-800">{{ !empty($pharmacist->user->updated_at) ? $pharmacist->user->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pharmacistsPayrolls" role="tabpanel">
            <livewire:pharmacist-payroll-table pharmacist="{{$pharmacist->id}}"/>
        </div>
    </div>
</div>
