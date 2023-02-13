<div id="edit_charges_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.charge.edit_charge') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editChargesForm']) }}
            {{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editChargesErrorsBox"></div>
                <div class="row">
                    {{ Form::hidden('charge_id',null,['id'=>'chargeId']) }}
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('charge_type', __('messages.charge_category.charge_type').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('charge_type', $chargeTypes, null, ['class' => 'form-select','required','id' => 'editChargeTypeId','placeholder' => 'Select Charge Type']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('charge_category_id', __('messages.charge.charge_category').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('charge_category_id', (isset($chargeCategory) ? $chargeCategory : []), null, ['class' => 'form-select','required','id' => 'editChargeCategoryId','placeholder' => 'Select Charge Category']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('code', __('messages.charge.code').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('code', null, ['class' => 'form-control','required','id' => 'editCode']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('standard_charge', __('messages.charge.standard_charge').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('standard_charge', null, ['class' => 'form-control price-input','required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")' , 'id' =>'editStdCharge']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.birth_report.description').(':'), ['class' => 'form-label']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'id' => 'editChargesDescription']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id' => 'editChargesSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" aria-label="Close" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
