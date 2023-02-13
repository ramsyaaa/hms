<div id="add_beds_modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.bed.new_bed') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addNewBedsForm']) }}
            {{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('name', __('messages.bed_assign.bed').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', null, ['id'=>'BedName','class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('bed_type', __('messages.bed.bed_type').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('bed_type', $bedTypes, null, ['class' => 'form-select', 'required', 'id' => 'bedType', 'placeholder' => 'Select Bed Type', 'data-control' => 'select2']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('charge', __('messages.bed.charge').(':'),['class' => 'form-label required']) }}
                        {{ Form::text('charge', null, ['id'=>'bedCharges','class' => 'form-control price-input','required']) }}
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('description', __('messages.bed.description').(':'),['class' => 'form-label']) }}
                        {{ Form::textarea('description', '', ['id'=>'BedDescription','class' => 'form-control', 'rows' => 4]) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'BedSaveBtn','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
