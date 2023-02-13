<div class="alert alert-danger d-none" id="adminErrorBox"></div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('first_name',__('messages.user.first_name').(':'), ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('first_name', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('last_name',__('messages.user.last_name').(':'), ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('last_name', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('email',__('messages.user.email').(':'), ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::email('email', null, ['class' => 'form-control','required','id'=>'createAdminEmail']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('phone',__('messages.user.phone').(':'), ['class' => 'form-label']) }}
            <br>
            {{ Form::tel('phone', getCountryCode(), ['class' => 'form-control phoneNumber','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
            {{ Form::hidden('prefix_code',null,['class'=>'prefix_code']) }}
            <span class="valid-msg text-success d-none fw-400 fs-small mt-2">✓ &nbsp; {{__('messages.valid')}}</span>
            <span class="error-msg text-danger d-none fw-400 fs-small mt-2"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('dob', __('messages.user.dob').':', ['class' => 'form-label']) }}
            {{ Form::text('dob', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'id' => 'adminBirthDate','autocomplete' => 'off']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('gender',__('messages.user.gender').(':'), ['class' => 'form-label']) }}
            <span class="required"></span> &nbsp;<br>
            <div class="d-flex align-items-center">
                <div class="form-check me-10">
                    <label class="form-label" for="accountantGenderMale">{{ __('messages.user.male') }}</label>
                    {{ Form::radio('gender', '0', true, ['class' => 'form-check-input','id'=>'adminGenderMale']) }}
                </div>
                <div class="form-check me-10">
                    <label class="form-label" for="accountantGenderFemale">{{ __('messages.user.female') }}</label>&nbsp;
                    {{ Form::radio('gender', '1',false, ['class' => 'form-check-input','id'=>'adminGenderFemale']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('status',__('messages.common.status').(':'), ['class' => 'form-label']) }}
            <br>
            <div class="form-check form-switch">
                <input class="form-check-input is-active" name="status" type="checkbox" value="1"
                       tabindex="8" checked>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('password',__('messages.user.password').(':'), ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::password('password', ['class' => 'form-control','required','min' => '6','max' => '10']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('password_confirmation',__('messages.user.password_confirmation').(':'), ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::password('password_confirmation', ['class' => 'form-control','required','min' => '6','max' => '10']) }}
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
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" title="{{__('messages.common.profile')}}">
                        <label>
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="adminProfileImage" name="image"
                                   class="image-upload d-none profileImage adminProfileImage"
                                   accept=".png, .jpg, .jpeg, .gif"/>
{{--                                        <input type="hidden" name="avatar_remove"/>--}}
                        </label>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('admins.index') }}"
           class="btn btn-secondary">{{__('messages.common.cancel')}}</a>
    </div>
</div>
