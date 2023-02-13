<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="brandOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body">
                        <div class="row mb-7">
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.brand')  }}</label>
                                <span class="fs-5 text-gray-800">{{$brand->name}}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.email')  }}</label>
                                <p>
                                    <span class="fs-5 text-gray-800">{{ !empty($brand->email)?$brand->email:'N/A' }}</span>
                                </p>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.phone')  }}</label>
                                <span class="fs-5 text-gray-800">{{ !empty($brand->phone)?$brand->phone:'N/A' }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on')  }}</label>
                                <span class="fs-5 text-gray-800" data-placement="top"
                                      data-bs-original-title="{{ \Carbon\Carbon::parse($brand->created_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated')  }}</label>
                                <span class="fs-5 text-gray-800" data-placement="top"
                                      data-bs-original-title="{{ \Carbon\Carbon::parse($brand->updated_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($brand->updated_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-title m-5">
                <h3>{{ __('messages.medicine.medicines') }}</h3>
            </div>
            <livewire:medicine-brand-details-table brandDetails="{{$brand->id}}"/>
        </div>
    </div>
</div>
