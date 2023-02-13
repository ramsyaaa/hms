<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="medicineOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.category')  }}</label>
                            <span class="fs-5 text-gray-800">{{ $category->name}}</span>
                        </div>
                        <div class="col-lg-4 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.status')  }}</label>
                            <p class="m-0">
                                <span class="badge fs-6 bg-light-{{!empty($category->is_active == 1) ? 'success' : 'danger'}}">{{ ($category->is_active == 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </p>
                        </div>
                        <div class="col-lg-4 d-flex flex-column mb-md-10 mb-5">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on')  }}</label>
                            <span data-bs-toggle="tooltip" data-placement="top"
                                  data-bs-original-title="{{ \Carbon\Carbon::parse($category->created_at)->format('jS M, Y') }}">
                                {{ \Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                            </span>
                        </div>
                        <div class="col-lg-4 d-flex flex-column">
                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated')  }}</label>
                            <span data-bs-toggle="tooltip" data-placement="top"
                                  data-bs-original-title="{{ \Carbon\Carbon::parse($category->updated_at)->format('jS M, Y') }}">
                                {{ \Carbon\Carbon::parse($category->updated_at)->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="fs-5 m-0">{{ __('messages.medicine.medicines') }}</h1>
        </div>
        <livewire:medicine-category-details-table categoryDetails="{{$category->id}}"/>
    </div>
</div>
