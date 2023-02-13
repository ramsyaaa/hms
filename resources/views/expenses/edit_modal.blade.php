<div id="edit_expenses_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.expense.edit_expense') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editExpensesForm', 'files' => true]) }}
            {{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
            <div class="modal-body">
                                <div class="alert alert-danger display-none hide" id="editExpenseErrorsBox"></div>
                <div class="row">
                    {{ Form::hidden('id',null,['id'=>'editExpenseId']) }}
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('expense_head', __('messages.expense.expense_head').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('expense_head', $expenseHeads, null, ['class' => 'form-select select2Selector', 'required', 'id' => 'editExpenseHeadId', 'data-control' => 'select2']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('name', __('messages.incomes.name').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', null, ['class' => 'form-control','required', 'id' => 'editExpenseName']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('date', __('messages.incomes.date').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'required', 'id' => 'editExpenseDate', 'autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('invoice_number', __('messages.incomes.invoice_number').(':'), ['class' => 'form-label']) }}
                        {{ Form::text('invoice_number', null, ['class' => 'form-control', 'id' => 'editExpenseInvoiceNumber']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('amount', __('messages.incomes.amount').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('amount', null, ['id'=>'editExpenseAmount','class' => 'form-control price-input', 'autocomplete' => 'off', 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('attachment', __('messages.incomes.attachment').':', ['class' => 'fs-5 fw-bold mb-2 d-block']) }}
                        <div class="d-block">
                            <?php
                            $style = 'style=';
                            $background = 'background-image:';
                            ?>
                            <div class="image-picker">
                                <div class="image previewImage" id="editExpensePreviewImage"
                                {{$style}}"{{$background}} url('{{ asset('assets/img/default_image.jpg') }}')">
                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                      title="Change attachment">
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        <input type="file" id="editExpenseAttachment" name="attachment"
                                               class="image-upload d-none profileImage"
                                               accept=".png, .jpg, .jpeg, .gif"/>
                                        <input type="hidden" name="avatar_remove"/>
                                    </label>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('description', __('messages.incomes.description').(':'),['class' => 'form-label']) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'id' => 'editExpenseDescription']) }}
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'editExpenseSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
