<div id="changePasswordModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">{{ __('messages.change_password.change_password') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['class'=>'form','id'=>'changePasswordForm']) }}
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="alert alert-danger d-none hide" id="editValidationErrorsBox"></div>
                {{ Form::hidden('user_id',null,['id'=>'pfUserId']) }}
                {{ Form::hidden('is_active',1) }}
                @csrf
                <div class="row">

                    <div class="col-12 mb-5">
                        <div class="mb-1">
                            {{ Form::label('current password', __('messages.change_password.current_password').':',['class' => 'form-label']) }}
                            <span class="required"></span>
                            <div class="position-relative mb-3">
                                <input class="form-control" id="pfCurrentPassword"
                                       type="password"
                                       name="password_current" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_current') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-5">

                        <div class="mb-1">
                            {{ Form::label('current password', __('messages.change_password.new_password').':',['class' => 'form-label']) }}
                            <span class="required"></span>
                            <div class="position-relative mb-3">
                                <input class="form-control" id="pfNewPassword"
                                       type="password"
                                       name="password" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-1">
                            {{ Form::label('password_confirmation', __('messages.change_password.confirm_password').':',['class' => 'form-label']) }}
                            <span class="required"></span>
                            <div class="position-relative mb-3">
                                <input class="form-control" id="pfNewConfirmPassword"
                                       type="password"
                                       name="password_confirmation" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnPrPasswordEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}
                </button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
