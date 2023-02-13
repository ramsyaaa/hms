<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.bed_assign.bed').(':')  }}</label>
                                <span class="fs-5 text-gray-800">{{$bed->name}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.bed.bed_type').(':')  }}</label>
                                <span class="fs-5 text-gray-800">{{$bed->bedType->title }}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.bed.bed_id').(':')  }}</label>
                                <span class="fs-5 text-gray-800">{{$bed->bed_id  }}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.bed.charge').(':')  }}</label>
                                <span class="fs-5 text-gray-800">
                                    {{ checkNumberFormat($bed->charge, strtoupper($bed->currency_symbol ?? getCurrentCurrency())) }}
                                </span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.bed.available').(':')  }}</label>
                                <p class="m-0">
                                    <span class="badge bg-light-{{!empty($bed->is_available) ? 'success' : 'danger' }} mt-2">{{ ($bed->is_available) ?  __('messages.common.yes')  :  __('messages.common.no') }}</span>
                                </p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column mb-md-10 mb-5 mb-2">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at').(':')  }}</label>
                                <span class="fs-5 text-gray-800" data-placement="top"  data-bs-original-title="{{ date('jS M, Y', strtotime($bed->created_at)) }}">{{ $bed->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column mb-md-10 mb-5 mb-2">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.updated_at').(':')  }}</label>
                                <span class="fs-5 text-gray-800" data-placement="top"  data-bs-original-title="{{ date('jS M, Y', strtotime($bed->updated_at)) }}">{{ $bed->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-12 d-flex flex-column mb-2">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.bed.description').(':')  }}</label>
                                <span class="fs-5 text-gray-800">{{ !empty($bed->description) ? nl2br(e($bed->description)) : 'N/A'}}</span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="fs-5 m-0">{{ __('messages.bed_assign.bed_assigns') }}</h1>
        </div>
    </div>
    <livewire:assign-bed-table bedId="{{$bed->id}}"/>
</div>
