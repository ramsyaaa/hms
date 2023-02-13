<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card">
                <div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('patient', __('messages.case.patient').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                        class="fs-5 text-gray-800">{{ $advancedPayment->patient->patientUser->full_name }}</span>
                            </div>
                            <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('receipt no', __('messages.advanced_payment.receipt_no').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <p class="m-0">
                                    <span class="badge bg-light-info fs-6 ">{{ $advancedPayment->receipt_no}}</span>
                                </p>
                            </div>
                            <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('amount', __('messages.advanced_payment.amount').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">
                                    {{ checkNumberFormat($advancedPayment->amount, strtoupper($advancedPayment->currency_symbol ?? getCurrentCurrency())) }}
                                </span>
                            </div>
                            <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('date', __('messages.advanced_payment.date').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{ \Carbon\Carbon::parse($advancedPayment->date)->translatedFormat('jS M, Y') }}</span>
                            </div>
                            <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('created at', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800"  title="{{ date('jS M, Y', strtotime($advancedPayment->created_at)) }}">{{ $advancedPayment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800"  title="{{ date('jS M, Y', strtotime($advancedPayment->updated_at)) }}">{{ $advancedPayment->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
