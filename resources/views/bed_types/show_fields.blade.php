<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                    <div class="card-body">
                        <div class="row mb-7">
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('title', __('messages.bed.bed_type').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{$bedType->title}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('description', __('messages.bed_type.description').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{!! !empty($bedType->description)?nl2br(e($bedType->description)):'N/A' !!}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('created on', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800" title="{{ date('jS M, Y', strtotime($bedType->created_at)) }}">{{ $bedType->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated on', __('messages.common.updated_at').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800" title="{{ date('jS M, Y', strtotime($bedType->updated_at)) }}">{{ $bedType->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="fs-5 m-0">{{ __('messages.bed.beds') }}</h1>
        </div>
    </div>
    <livewire:bed-table-for-bed-type bedTypeId="{{$bedType->id}}"/>
</div>
