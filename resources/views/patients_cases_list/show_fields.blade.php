<div>
    <div class="card mb-5 mb-xl-10">
        <div>
            <div class="card-body">
                <div class="row mb-7">
                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                        {{ Form::label('case_id', __('messages.case.case_id').':',['class'=>'pb-2 fs-5 text-gray-600']) }}
                        <span class="fs-5 text-gray-800">{{ $patientCase->case_id }}</span>
                    </div>
                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                        {{ Form::label('patient_name', __('messages.case.patient').':',['class'=>'pb-2 fs-5 text-gray-600']) }}
                        <span class="fs-5 text-gray-800">{{ $patientCase->patient->patientUser->full_name }}</span>
                    </div>
                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                        {{ Form::label('phone', __('messages.case.phone').':',['class'=>'pb-2 fs-5 text-gray-600']) }}
                        <span
                            class="fs-5 text-gray-800">{{ !empty($patientCase->phone)?$patientCase->phone:'N/A' }}</span>
                    </div>
                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                        {{ Form::label('doctor_name', __('messages.case.doctor').':',['class'=>'pb-2 fs-5 text-gray-600']) }}
                        <span class="fs-5 text-gray-800">{{ $patientCase->doctor->doctorUser->full_name }}</span>
                    </div>
                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                        {{ Form::label('date', __('messages.case.case_date').':',['class'=>'pb-2 fs-5 text-gray-600']) }}
                        <span
                            class="fs-5 text-gray-800">{{ \Carbon\Carbon::parse($patientCase->date)->format('jS M,Y g:i A') }}</span>
                    </div>
                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                        {{ Form::label('status', __('messages.common.status').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                        <p class="m-0"><span
                                class="badge fs-6 bg-light-{{($patientCase->status === 1) ? 'success' : 'danger'}}">{{($patientCase->status === 1) ? __('messages.common.active') : __('messages.common.de_active')}}</span>
                        </p>
                    </div>
                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                        {{ Form::label('fee', __('messages.case.fee').':',['class'=>'pb-2 fs-5 text-gray-600']) }}
                        <span class="fs-5 text-gray-800">
                            {{ checkNumberFormat($patientCase->fee, strtoupper(getCurrentCurrency())) }}
{{--                            <b>{{ getCurrencySymbol() }}</b> {{ number_format($patientCase->fee,2) }}--}}
                        </span>
                    </div>
                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                        {{ Form::label('created_at', __('messages.common.created_on').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                        <span data-toggle="tooltip" data-placement="right"
                              title="{{ date('jS M, Y', strtotime($patientCase->created_at)) }}"
                              class="fs-5 text-gray-800">{{ $patientCase->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                        {{ Form::label('updated_at', __('messages.common.last_updated').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                        <span data-toggle="tooltip" data-placement="right"
                              title="{{ date('jS M, Y', strtotime($patientCase->updated_at)) }}"
                              class="fs-5 text-gray-800">{{ $patientCase->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column">
                        {{ Form::label('description', __('messages.case.description').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                        <span
                            class="fs-5 text-gray-800">{!! !empty($patientCase->description)? nl2br(e($patientCase->description)): 'N/A' !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
