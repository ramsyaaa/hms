<div id="edit_accounts_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.account.edit_account') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editAccountForm']) }}
            <div class="modal-body">
                {{ Form::hidden('accountId',null,['id'=>'accountId']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name', __('messages.account.account').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', null, ['class' => 'form-control','id'=>'editName','required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.account.description').(':'),['class' => 'form-label']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control','id'=>'editDescription', 'rows' => 4]) }}
                    </div>
                    <div class="form-group mb-7 d-flex align-items-center">
                        {{ Form::label('status', __('messages.account.status').(':'),['class' => 'form-label me-5 mb-0 mb-1']) }}
                        <div class="form-check form-switch mb-0">
                            <input name="status" value="1" class="form-check-input w-35px h-20px"
                                   type="checkbox"
                                   id="editIsActive">
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        {{ Form::label('type', __('messages.account.type').(':'),['class' => 'form-label  me-5 mb-1']) }}
                        <div class="d-flex align-items-center">
                            <div class="form-check me-10 mb-0 mt-1">
                                <label class="form-label">{{ __('messages.account.debit') }}</label>&nbsp;&nbsp;
                                {{ Form::radio('type', '1', false, ['class' => 'form-check-input','id' => "editDebit"]) }} &nbsp;
                            </div>
                            <div class="form-check me-10 mb-0">
                                <label class="form-label">{{ __('messages.account.credit') }}</label>
                                {{ Form::radio('type', '2', true, ['class' => 'form-check-input', 'id' => 'editCredit']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'editAccountSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
