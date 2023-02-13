<div id="edit_beds_modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.bed.edit_bed') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'EditBedsForm']) }}
            {{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editValidationErrorsBox"></div>
                <div class="row">
                    {{ Form::hidden('bed_rc_id',null,['id'=>'bedId']) }}
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('name', __('messages.bed_assign.bed').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', null, ['class' => 'form-control','required', 'id' => 'editBedName']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('bed_type', __('messages.bed.bed_type').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('bed_type', $bedTypes, null, ['class' => 'form-select', 'required', 'id' => 'editBedType', 'placeholder' => 'Select Bed Type', 'data-control' => 'select2']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('charge', __('messages.bed.charge').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('charge', null, ['class' => 'form-control price-input','required', 'id' => 'editBedCharge']) }}
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('description', __('messages.bed.description').(':'),['class' => 'form-label']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'id' => 'editBedDescription']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'btnEditSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
