<div id="edit_doctor_opd_charges_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.doctor_opd_charge.edit_doctor_opd_charge') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editDoctorChargesForm']) }}
            {{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editDoctorChargesErrorsBox"></div>
                <div class="row">
                    {{ Form::hidden('id',null,['id'=>'doctorOPDChargeId']) }}
                    <div class="col-md-12 mb-5">
                        {{ Form::label('doctor_id', __('messages.doctor_opd_charge.doctor').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('doctor_id',$doctors, null, ['class' => 'form-select', 'autocomplete' => 'off', 'required','id' => 'editChargesDoctorId','placeholder'=>'Select Patient']) }}
                    </div>
                    <div class="col-md-12 mt-3">
                        {{ Form::label('standard_charge', __('messages.doctor_opd_charge.standard_charge').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('standard_charge', null, ['class' => 'form-control price-input ', 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'id' => 'editDoctorStandardCharge']) }}
                    </div>
                </div>
            </div>
                    <div class="modal-footer pt-0">
                        {{ Form::button( __('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'editDoctorChargesSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                        <button type="button" aria-label="Close" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                    </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
