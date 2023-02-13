<div id="edit_bed_types_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.bed_type.edit_bed_type') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'BedTypeEditForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editValidationErrorsBox"></div>
                {{ Form::hidden('bed_type_id',null,['id'=>'bedTypeId']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('title', __('messages.bed.bed_type').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('title', null, ['id'=>'BedTypeEditTitle','class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.bed_type.description').(':'),['class' => 'form-label']) }}
                        {{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => 3, 'id' => 'BedTypeEditDescription']) }}
                    </div>

                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'BedTyeBtnEditSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
