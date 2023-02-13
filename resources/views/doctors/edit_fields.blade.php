<div class="alert alert-danger d-none hide" id="editDoctorErrorsBox"></div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('first_name', __('messages.user.first_name').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('first_name', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('last_name', __('messages.user.last_name').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('last_name', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('department_name', __('messages.doctor_department.doctor_department').':', ['class' => 'form-label ']) }}
        <span class="required"></span>
        {{ Form::select('doctor_department_id', $doctorsDepartments, $doctor->doctor_department_id, ['class' => 'form-select', 'id' => 'editDoctorsDepartmentId', 'placeholder' => 'Select Department', 'data-control' => 'select2','required']) }}
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('email', __('messages.user.email').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::email('email', null, ['class' => 'form-control', 'required','id'=>'editDoctorEmail']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('designation', __('messages.user.designation').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('designation', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mobile-overlapping mb-5">
            {{ Form::label('phone', __('messages.user.phone').':', ['class' => 'form-label']) }}
            <br>
            {{ Form::tel('phone', $user->phone ?? getCountryCode(), ['class' => 'form-control phoneNumber', 'id' => 'editDoctorPhoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
            {{ Form::hidden('prefix_code',null,['class'=>'prefix_code']) }}
            {{ Form::hidden('country_iso',null,['class'=>'country_iso']) }}
            <span id="valid-msg" class="text-success d-none fw-400 fs-small mt-2 valid-msg">✓ &nbsp; {{__('messages.valid')}}</span>
            <span id="error-msg" class="text-danger d-none fw-400 fs-small mt-2 error-msg"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('qualification', __('messages.user.qualification').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('qualification', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('dob', __('messages.user.dob').':', ['class' => 'form-label']) }}
            {{ Form::text('dob', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light birthDate form-control' : 'bg-white birthDate form-control'),'id' => 'editDoctorBirthDate','autocomplete' => 'off']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('blood_group', __('messages.user.blood_group').':', ['class' => 'form-label']) }}
            {{ Form::select('blood_group', $bloodGroup, null, ['class' => 'form-select', 'id' => 'editDoctorBloodGroup', 'placeholder' => 'Select Blood Group', 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('gender', __('messages.user.gender').':', ['class' => 'form-label']) }}
            <span class="required"></span> &nbsp;<br>
            <span class="is-validm">
                <label class="form-label">{{ __('messages.user.male') }}</label>&nbsp;&nbsp;
                {{ Form::radio('gender', '0', true, ['class' => 'form-check-input','id'=>'editDoctorMale']) }} &nbsp;
                <label class="form-label">{{ __('messages.user.female') }}</label>
                {{ Form::radio('gender', '1', false, ['class' => 'form-check-input','id'=>'editDoctorFemale']) }}
            </span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label']) }}
            <br>
            <div class="form-check form-switch form-check-custom">
                <input class="form-check-input w-35px h-20px is-active" name="status" type="checkbox"
                       value="1" {{(isset($user) && ($user->status)) ? 'checked' : ''}}>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6 col-md-6 mb-5">
        <div class="row2" io-image-input="true">
            {{ Form::label('image',__('messages.common.profile').(':'), ['class' => 'form-label']) }}
            <div class="d-block">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>

                <div class="image-picker">
                    <div class="image previewImage" id="editDoctorPreviewImage"
                    {{$style}}"{{$background}}
                    url({{ isset($user->media[0]) ? $user->image_url : asset('assets/img/avatar.png') }}">
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" title="Change Profile">
                        <label>
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="editDoctorProfileImage" name="image"
                                   class="image-upload d-none profileImage editDoctorProfileImage"
                                   accept=".png, .jpg, .jpeg, .gif"/>
                            <input type="hidden" name="avatar_remove"/>
                        </label>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group mb-5">
        {{ Form::label('specialist', __('messages.doctor.specialist').':', ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('specialist', (isset($doctor) ? $doctor->specialist : ''), ['class' => 'form-control','required']) }}
    </div>
</div>
</div>
<hr>
<div class="row mt-3">
    <div class="col-md-12 mb-3">
        <h5>{{ __('messages.user.address_details') }}</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address1', __('messages.user.address1').':', ['class' => 'form-label']) }}
            {{ Form::text('address1', isset($doctor->address->address1) ? $doctor->address->address1 : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address2', __('messages.user.address2').':', ['class' => 'form-label']) }}
            {{ Form::text('address2', isset($doctor->address->address2) ? $doctor->address->address2 : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('city', __('messages.user.city').':', ['class' => 'form-label']) }}
            {{ Form::text('city', isset($doctor->address->city) ? $doctor->address->city : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('zip', __('messages.user.zip').':', ['class' => 'form-label']) }}
            {{ Form::text('zip', isset($doctor->address->zip) ? $doctor->address->zip : null, ['class' => 'form-control', 'maxlength' => '6','minlength' => '6']) }}
        </div>
    </div>
</div>
<hr>
<div class="row mt-3 mb-5">
    <div class="col-md-12 mb-3">
        <h5>{{ __('messages.setting.social_details') }}</h5>
    </div>

    <!-- Facebook URL Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('facebook_url', __('messages.facebook_url').':', ['class' => 'form-label']) }}
        {{ Form::text('facebook_url', null, ['class' => 'form-control facebookUrl','id'=>'editDoctorFacebookUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>

    <!-- Twitter URL Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('twitter_url', __('messages.twitter_url').':', ['class' => 'form-label']) }}
        {{ Form::text('twitter_url', null, ['class' => 'form-control twitterUrl','id'=>'editDoctorTwitterUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>

    <!-- Instagram URL Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('instagram_url', __('messages.instagram_url').':', ['class' => 'form-label']) }}
        {{ Form::text('instagram_url', null, ['class' => 'form-control instagramUrl', 'id'=>'editDoctorInstagramUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>

    <!-- LinkedIn URL Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('linkedIn_url', __('messages.linkedIn_url').':', ['class' => 'form-label']) }}
        {{ Form::text('linkedIn_url', null, ['class' => 'form-control linkedInUrl','id'=>'editDoctorLinkedInUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>

</div>
<div class="d-flex justify-content-end">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
    <a href="{{ route('doctors.index') }}"
       class="btn btn-secondary me-2">{{ __('messages.common.cancel') }}</a>
</div>
