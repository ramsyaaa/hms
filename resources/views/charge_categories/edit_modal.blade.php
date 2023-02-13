<div id="edit_charge_categories_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"
                    id="exampleModalLabel">{{ __('messages.charge_category.edit_charge_category') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editChargeCategoryForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editChargeCategoryErrorsBox"></div>
                <div class="row">
                    {{ Form::hidden('charge_category_id',null,['id'=>'chargeCatId']) }}
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name', __('messages.charge.charge_category').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', null, ['class' => 'form-control','required','id' => 'editChargeCategoryName']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.birth_report.description').(':'), ['class' => 'form-label']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4,'id' => 'editChargeCategoryDescription']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('charge_type', __('messages.charge_category.charge_type').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('charge_type', $chargeTypes, null, ['class' => 'form-select','required','id' => 'editChargeCategoryTypeId','placeholder'=>'Select Charge Type']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'editChargeCategorySave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" aria-label="Close" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
