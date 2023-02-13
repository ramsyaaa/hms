<div id="add_departments_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tagHeader">{{ __('messages.role.new_role') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addDepartmentForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="departmentErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('name', __('messages.common.name').':') }}
                        <span class="required"></span>
                        {{ Form::text('name', null, ['class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('is_active', __('messages.common.active').':') }}
                        <label class="switch switch-label switch-outline-primary-alt d-block">
                            <input name="is_active" class="switch-input" type="checkbox" value="1" checked>
                            <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer pt=0">
                {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'departmentSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" id="departmentCancel" class="btn btn-light ml-1"
                        data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
