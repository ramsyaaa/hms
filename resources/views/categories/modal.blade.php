<div id="add_categories_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.medicine.new_medicine_category') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addMedicineCategoryForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="medicineCategoryErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name', __('messages.medicine.category').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', '', ['id'=>'medicineCategoryName','class' => 'form-control','required']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-2 col-md-2">
                        {{ Form::label('active', __('messages.common.status').':', ['class' => 'form-label']) }}
                        <div class="form-check form-switch">
                            <input class="form-check-input w-35px h-20px is-active" name="is_active" type="checkbox"
                                   value="1"
                                   {{(old('is_active'))?'checked':''}} checked>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-0">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'medicineCategorySave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" aria-label="Close" class="btn btn-secondary"
                            data-bs-dismiss="modal">{!! __('messages.common.cancel') !!}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
