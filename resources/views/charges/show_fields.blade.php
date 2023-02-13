<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ChargesOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('charge_type', __('messages.charge_category.charge_type').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{$chargeTypes[$charge->charge_type]}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('charge_category', __('messages.charge.charge_category').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{ $charge->chargeCategory->name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('code', __('messages.charge.code').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{ $charge->code}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('standard_charge', __('messages.charge.standard_charge').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">
                                    {{ checkNumberFormat($charge->standard_charge, strtoupper($charge->currency_symbol ?? getCurrentCurrency())) }}
                                </span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800" title="{{ date('jS M, Y', strtotime($charge->created_at)) }}">{{ $charge->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800" title="{{ date('jS M, Y', strtotime($charge->updated_at)) }}">{{ $charge->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('description', __('messages.death_report.description').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{!! !empty($charge->description)?nl2br(e($charge->description)):'N/A'  !!}</span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
