<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="docTypeOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.document.document_type').(':')  }}</label>
                                <span class="fs-5 text-gray-800">{{ $documentType->name}}</span>
                            </div>
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at').(':')  }}</label>
                                <span class="fs-5 text-gray-800" data-placement="top"  data-bs-original-title="{{ date('jS M, Y', strtotime($documentType->created_at)) }}">{{ $documentType->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span class="fs-5 text-gray-800" data-placement="top"  data-bs-original-title="{{ date('jS M, Y', strtotime($documentType->updated_at)) }}">{{ $documentType->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="fs-5 m-0">{{ __('messages.document.document') }}</h1>
        </div>
        <livewire:document-type-details-table  documentType="{{$documentType->id}}"/>
    </div>
</div>
