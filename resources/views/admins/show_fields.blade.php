<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="image image-circle image-small">
{{--                        <img src="{{$admin->user->image_url}}" alt="image" class="object-fit-cover"/>--}}
                        <img src="{{$admin->image_url}}" alt="image" class="object-fit-cover"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="javascript:void(0)"
{{--                                   class="text-gray-800 text-hover-primary fs-2 me-4 text-decoration-none">{{$admin->user->full_name}}</a>--}}
                                   class="text-gray-800 text-hover-primary fs-2 me-4 text-decoration-none">{{$admin->full_name}}</a>
                                <span
                                        class="text-{{ $admin->status === 1 ? 'success' : 'danger' }} mb-2 d-block">{{ ($admin->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </div>
{{--                            <a href="mailto: {{$admin->user->email}}"--}}
                            <a href="mailto: {{$admin->email}}"
                               class="text-decoration-none d-flex align-items-center text-gray-600 text-hover-primary mb-2 me-2">
{{--                                {{$admin->user->email}}--}}
                                {{$admin->email}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-7 overflow-hidden">
        <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#aoverview">
                    {{ __('messages.overview') }}
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="aoverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row">
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.phone')  }}</label>
                                <div class="col-lg-8">
{{--                                    <span class="fs-5 text-gray-800">{{!empty($admin->user->phone)?$admin->user->phone:'N/A'}}</span>--}}
                                    <span class="fs-5 text-gray-800">{{!empty($admin->phone)?$admin->phone:'N/A'}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.gender')  }}</label>
                                <div class="col-lg-8">
{{--                                    <span class="fs-5 text-gray-800">{{ $admin->user->gender == 0 ? 'Male' : 'Female' }}</span>--}}
                                    <span class="fs-5 text-gray-800">{{ $admin->gender == 0 ? 'Male' : 'Female' }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.dob')  }}</label>
                                <div class="col-lg-8">
{{--                                    <span class="fs-5 text-gray-800">{{ !empty($admin->user->dob) ? \Carbon\Carbon::parse($admin->user->dob)->translatedFormat('jS M, Y') : __('messages.common.n/a') }}</span>--}}
                                    <span class="fs-5 text-gray-800">{{ !empty($admin->dob) ? \Carbon\Carbon::parse($admin->dob)->translatedFormat('jS M, Y') : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at') }}</label>
                                <div class="col-lg-8">
                                <span
                                        class="fs-5 text-gray-800 me-2">{{ !empty($admin->created_at) ? $admin->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.updated_at') }}</label>
                                <div class="col-lg-8">
                                <span
                                        class="fs-5 text-gray-800 me-2">{{ !empty($admin->updated_at) ? $admin->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
