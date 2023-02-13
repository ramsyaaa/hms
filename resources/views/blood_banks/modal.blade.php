<div id="add_blood_banks_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.hospital_blood_bank.new_blood_group') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addBloodBankForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="bloodBankErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('blood_group', __('messages.hospital_blood_bank.blood_group').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('blood_group', '', ['id'=>'bloodGroup','class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('remained_bags', __('messages.hospital_blood_bank.remained_bags').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::number('remained_bags', '', ['id'=>'bloodBankRemainedBags','class' => 'form-control','required','min' => 1]) }}
                    </div>

                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'bloodBankSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
