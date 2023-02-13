<div id="AddSmsModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.sms.new_sms') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addSmsForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5 mySmsClass">
                        {{ Form::label('Phone', __('messages.sms.phone_number').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {!! Form::tel('phone', null, ['class' => 'form-control phoneNumber','id' => 'smsPhoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) !!}
                        {!! Form::hidden('prefix_code',null,['class'=>'prefix_code']) !!}
                        <span class="text-success valid-msg d-none fw-400 fs-small mt-2">✓ &nbsp; Valid</span>
                        <span class="text-danger error-msg d-none fw-400 fs-small mt-2"></span>
                    </div>
                    <div class="form-group col-sm-12 mb-5 role">
                        {{ Form::label('role', __('messages.sms.role').(':'),['class' => 'form-label required']) }}
                        {{ Form::select('role', $roles, null, ['class' => 'form-control', 'required','id'=>'smsRoleId','placeholder' => 'Select Role','data-control'=> 'select2']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-3 flex-row-reverse">
                        <div class="form-check form-switch fv-row">
                            <input name="number" class="form-check-input w-35px h-20px smsNumber" value="0"
                                   type="checkbox">
                            <label class="form-check-label" for="allowmarketing"></label>
                            {{ Form::label('number',  __('messages.sms.send_sms_by_number_directly'),['class' => 'form-label']) }}
                        </div>
                    </div>
                    <div class="form-group col-sm-12 mb-5 send">
                        {{ Form::label('send_to', __('messages.sms.send_to').':',['class' => 'form-label required']) }}
                        <span><strong>{{__('messages.sms.only_user_with_registered_phone_will_display')}}</strong></span>
                        {{ Form::select('send_to[]', [null], null, ['class' => 'form-select', 'required', 'id'=>'smsUserId', 'multiple' => true,'disabled', 'data-control'=> 'select2']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('message', __('messages.sms.message').':',['class' => 'form-label required']) }}
                        {!! Form::textarea('message', null, ['class' => 'form-control', 'id' => 'smsMessageId', 'required', 'rows' => 6, 'maxlength'=>"160"]) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'smsBtnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
