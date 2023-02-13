<div class="alert alert-danger d-none hide" id="userValidationErrorsBox"></div>
<div class="row">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('first_name', __('messages.user.first_name').':', ['class' => 'form-label required']) }}
            {{ Form::text('first_name', null, ['class' => 'form-control', 'required', 'tabindex' => '1']) }}
        </div>
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('last_name',__('messages.user.last_name').':', ['class' => 'form-label required ']) }}
        {{ Form::text('last_name', null, ['class' => 'form-control', 'required', 'tabindex' => '2']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('email', __('messages.user.email').':', ['class' => 'form-label required']) }}
        {{ Form::email('email', null, ['class' => 'form-control', 'required', 'tabindex' => '3','id'=>'userEmail']) }}
    </div>
    @if(!$isEdit)
        <div class="col-lg-6 mb-5">
            {{ Form::label('department_id',__('messages.employee_payroll.role').':', ['class' => 'form-label']) }}
            <span class="text-danger">*</span>
            {{ Form::select('department_id', $role, null, ['class' => 'form-select fw-bold', 'required', 'id' => 'userRole', 'placeholder' => 'Select Role', 'data-control' => 'select2']) }}
        </div>
    @endif
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('phone',__('messages.visitor.phone').(':'), ['class' => 'form-label']) }}
            <span class="required"></span>
            <br>
            {{ Form::tel('phone', $user->phone ?? getCountryCode(), ['class' => 'form-control phoneNumber','id' => 'userPhoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'tabindex' => '5']) }}
            {{ Form::hidden('prefix_code',null,['class'=>'prefix_code']) }}
            {{ Form::hidden('country_iso',null,['class'=>'country_iso']) }}
            <span class="text-success valid-msg d-none fw-400 fs-small mt-2">✓ &nbsp; {{__('messages.valid')}}</span>
            <span class="text-danger error-msg d-none fw-400 fs-small mt-2"></span>
        </div>
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('dob',__('messages.user.dob').':', ['class' => 'form-label']) }}
        {{ Form::text('dob', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'), 'id' => 'userDob', 'autocomplete' => 'off', 'tabindex' => '10']) }}
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('gender',__('messages.user.gender').(':'), ['class' => 'form-label']) }}
            <span class="required"></span> &nbsp;<br>
            <div class="d-flex align-items-center">
                <div class="form-check me-10">
                    <label class="form-label" for="accountantGenderMale">{{ __('messages.user.male') }}</label>
                    {{ Form::radio('gender', '0', true, ['class' => 'form-check-input','tabindex' => '6','id'=>'usesMale']) }}
                </div>
                <div class="form-check me-10">
                    <label class="form-label">{{ __('messages.user.female') }}</label>&nbsp;
                    {{ Form::radio('gender', '1',false, ['class' => 'form-check-input', 'tabindex' => '7','id'=>'usesFemale']) }}
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
                       tabindex="11" id="userAllowMarketing" @if($isEdit) {{(isset($user) && ($user->status)) ? 'checked' : ''}} @else
                    {{ 'checked' }} @endif ">
                <label class="form-check-label" for="allowmarketing"></label>
            </div>
        </div>
    </div>
    @if(!$isEdit)
        <div class="col-lg-6 mb-5">
            {{ Form::label('password', __('messages.user.password').':', ['class' => 'form-label required']) }}
            {{ Form::password('password', ['class' => 'form-control', 'required','min' => '6','max' => '10', 'tabindex' => '8']) }}
        </div>
    @endif
    @if(!$isEdit)
        <div class="col-lg-6 mb-5">
            {{ Form::label('password_confirmation', __('messages.user.password_confirmation').':', ['class' => 'form-label required mb-3']) }}
            {{ Form::password('password_confirmation', ['class' => 'form-control','required','min' => '6','max' => '10', 'tabindex' => '9']) }}
        </div>
@endif
<!-- Facebook URL Field -->
    <div class="col-lg-6 mb-5">
        {{ Form::label('facebook_url', __('messages.facebook_url').':', ['class' => 'form-label']) }}
        {{ Form::text('facebook_url', null, ['class' => 'form-control','id'=>'userFacebookUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>

    <!-- Instagram URL Field -->
    <div class="col-lg-6 mb-5">
        {{ Form::label('instagram_url', __('messages.instagram_url').':', ['class' => 'form-label']) }}
        {{ Form::text('instagram_url', null, ['class' => 'form-control', 'id'=>'userInstagramUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>
    <!-- Twitter URL Field -->
    <div class="col-lg-6 mb-5">
        {{ Form::label('twitter_url', __('messages.twitter_url').':', ['class' => 'form-label']) }}
        {{ Form::text('twitter_url', null, ['class' => 'form-control','id'=>'userTwitterUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>
    <!-- LinkedIn URL Field -->
    <div class="col-lg-6 mb-5">
        {{ Form::label('linkedIn_url', __('messages.linkedIn_url').':', ['class' => 'form-label']) }}
        {{ Form::text('linkedIn_url', null, ['class' => 'form-control','id'=>'userLinkedInUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>
    <div class="form-group col-md-4 mb-5">
        <div class="row2" io-image-input="true">
            {{ Form::label('image',__('messages.common.profile').(':'), ['class' => 'form-label']) }}


            <div class="d-block">
                @php
                    if($isEdit){
                        $image = isset($user->media[0]) ? $user->image_url : asset('assets/img/avatar.png');
                    }else{
                        $image = asset('assets/img/avatar.png');
                    }
                @endphp

                <div class="image-picker">
                    <div class="image previewImage" id="userPreviewImage"
                         style="background-image: url({{ $image }})">
                            <span class="picker-edit rounded-circle text-gray-500 fs-small" title="{{ $isEdit ? 'Change profile' : __('messages.common.profile') }}">
                                
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        <input type="file" id="userProfileImage" name="image"
                                               class="image-upload d-none profileImage" ,
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
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary btn-save me-3']) }}
        <a href="{!! route('users.index') !!}"
           class="btn btn-secondary">{{__('messages.common.cancel')}}</a>
    </div>
</div>
