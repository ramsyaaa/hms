<div id="add_item_categories_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.item_category.new_item_category') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addItemCategoryForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="itemCatErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('name', __('messages.item_category.name').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', '', ['id'=>'itemCategoryName','class' => 'form-control','required']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'itemCategorySave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" aria-label="Close" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
