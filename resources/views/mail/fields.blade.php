<div class="alert alert-danger d-none hide" id="mailValidationErrorsBox"></div>
<div class="row">
    <div class="col-md-6 ">
        <div class="form-group mb-5">
            {{ Form::label('to', __('messages.email.to').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::email('to', null, ['class' => 'form-control','required', 'id' => 'mailEmailId', 'aria-describedby'=>'emailHelp']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('subject', __('messages.email.subject').':', ['class' => ' form-label']) }}
            <span class="required"></span>
            {{ Form::text('subject', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('message', __('messages.email.message').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::textarea('message', null, ['class' => 'form-control','rows' => 6,'required']) }}
        </div>
    </div>
    <div class="form-group col-md-4 mb-5">
        <div class="row2" io-image-input="true">
            {{ Form::label('image',__('messages.common.profile').(':'), ['class' => 'form-label']) }}


            <div class="d-block">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>
                    <div class="image-picker">
                        <div class="image previewImage" id="previewImage"
                        {{$style}}"{{$background}} url({{ asset('assets/img/avatar.png')}}">
                        <span class="picker-edit rounded-circle text-gray-500 fs-small" title="{{ __('messages.common.profile') }}">
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                           <input type="file" id="mailDocumentImage" name="profile_image"
                                                  class="image-upload d-none profileImage"
                                                  accept=".png, .jpg, .jpeg, .gif"/>
                                        <input type="hidden" name="avatar_remove"/>
                                        
                                    </label>
                                </span>
                    </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
    {{ Form::submit(__('messages.sms.send'), ['class' => 'btn btn-primary me-2']) }}
    <a href="{{ route('mail') }}"
       class="btn btn-secondary">{{ __('messages.common.cancel') }}</a>
</div>

