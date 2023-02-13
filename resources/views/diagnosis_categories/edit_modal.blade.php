<div id="edit_diagnosis_categories_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.diagnosis_category.edit_diagnosis_category') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editDiagnosisCatForm', 'method' => 'patch']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editDiagnosisCatErrorsBox"></div>
                {{ Form::hidden('diagnosisCategoryId',null,['id'=>'diagnosisCategoryId']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name', __('messages.diagnosis_category.diagnosis_category').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', '', ['id'=>'editDiagnosisCatName','class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.diagnosis_category.description').(':'),['class' => 'form-label']) }}
                        {{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => 5, 'id' => 'editDiagnosisCatDescription']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'editDiagnosisCatSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
