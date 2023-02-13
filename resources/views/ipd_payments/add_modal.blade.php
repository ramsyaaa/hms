<div id="addIpdPaymentModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_payments.add_ipd_payment') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addIpdPaymentNewForm']) }}
            {{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
            <div class="modal-body">
                @if($ipdPatientDepartment->bill)
                    <div class="alert alert-warning">
                        <span>Note: After adding Payment you must need to re-generate Bill.</span>
                    </div>
                @endif
                <div class="alert alert-danger d-none hide" id="ipdPaymentValidationErrorsBox"></div>
                {{ Form::hidden('ipd_patient_department_id',$ipdPatientDepartment->id) }}
                <div class="row">
                    <div class="form-group col-md-12 mb-5">
                        <div class="form-group">
                            {{ Form::label('amount', __('messages.ambulance_call.amount').':', ['class' => 'form-label']) }}
                            <span class="required"></span>
                            <div class="input-group">
                                {{ Form::text('amount', null, ['class' => 'form-control  price-input','id' => 'ipdPaymentAmount', 'required']) }}
                                <div class="input-group-text border-0"><a><span>{{ getCurrencySymbol() }}</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        <div class="form-group">
                            {{ Form::label('date', __('messages.ipd_patient_charges.date').':',['class' => 'form-label']) }}
                            <span class="required"></span>
                            {{ Form::text('date', null, ['class' => 'form-control bg-white','id' => 'ipdPaymentDate','autocomplete' => 'off', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('charge_type_id', __('messages.ipd_payments.payment_mode').':',['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('payment_mode', $paymentModes, null, ['class' => 'form-select  select2Selector', 'id' => 'ipdPaymentModeId', 'required','placeholder'=>'Select Payment Mode']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('document', __('messages.ipd_patient_diagnosis.document').':',['class' => 'form-label']) }}
                        <div class="d-block">
                            <div class="image-picker">
                                <div class="image previewImage" id="ipdPaymentPreviewImage"
                                     style="background-image: url({{ asset('assets/img/default_image.jpg') }})">
                                </div>
                                <span class="picker-edit rounded-circle text-gray-500 fs-small" title="{{__('messages.ipd_patient_diagnosis.document')}}">
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        <input type="file" id="ipdPaymentDocumentImage" name="file"
                                               class="image-upload d-none profileImage" accept=".png, .jpg, .jpeg, .gif"/>
                                        <input type="hidden" name="avatar_remove"/>
                                    </label>
                                 </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group mb-5">
                            {{ Form::label('notes', __('messages.ipd_patient.notes').':',['class' => 'form-label']) }}
                            {{ Form::textarea('notes', null, ['class' => 'form-control ', 'rows' => 4]) }}
                        </div>
                    </div>

                </div>
                <div class="modal-footer p-0">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnIpdPaymentSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
