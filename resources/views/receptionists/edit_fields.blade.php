<div class="alert alert-danger d-none hide" id="editReceptionistErrorsBox"></div>
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
            {{ Form::email('email', null, ['class' => 'form-control','required','id'=>'editReceptionistEmail']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('designation',__('messages.user.designation').(':'), ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('designation', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mobile-overlapping mb-5">
            {{ Form::label('phone',__('messages.user.phone').(':'), ['class' => 'form-label']) }}
            <br>
            {{ Form::tel('phone', $receptionist->user->phone ?? getCountryCode(), ['class' => 'form-control phoneNumber','id' => 'editReceptionistPhoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'tabindex' => '5']) }}
            {{ Form::hidden('prefix_code',null,['class'=>'prefix_code']) }}
            {{ Form::hidden('country_iso',null,['class'=>'country_iso']) }}
            <span class="text-success valid-msg d-none fw-400 fs-small mt-2">✓ &nbsp; {{__('messages.valid')}}</span>
            <span class="text-danger error-msg d-none fw-400 fs-small mt-2"></span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('gender',__('messages.user.gender').(':'), ['class' => 'form-label']) }}
            <span class="required"></span> &nbsp;<br>
            <span class="is-valid">
                <label class="form-label">{{ __('messages.user.male') }}</label>
            {{ Form::radio('gender', '0', true, ['class' => 'form-check-input','id'=>'editReceptionistMale']) }}
             <label class="form-label">{{ __('messages.user.female') }}</label>&nbsp;
            {{ Form::radio('gender', '1', false, ['class' => 'form-check-input','id'=>'editReceptionistFemale']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('status',__('messages.common.status').(':'), ['class' => 'form-label']) }}
            <br>
            <div class="form-check form-switch">
                <input class="form-check-input w-35px h-20px is-active" name="status" type="checkbox"
                       value="1" {{(isset($user) && ($user->status)) ? 'checked' : ''}}>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('qualification',__('messages.user.qualification').(':'), ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('qualification', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('dob',__('messages.user.dob').(':'), ['class' => 'form-label']) }}
            {{ Form::text('dob', null, ['id'=>'editReceptionistBirthDate', 'class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'autocomplete' => 'off']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('blood_group',__('messages.user.blood_group').(':'), ['class' => 'form-label']) }}
            {{ Form::select('blood_group', $bloodGroup, null, ['class' => 'form-select', 'id' => 'editReceptionistBloodGroup'
,'placeholder'=>__('messages.user.select_blood_group')]) }}
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
                    <div class="image previewImage" id="receptionistPreviewImage"
                    {{$style}}"{{$background}} url({{ isset($user->media[0]) ? $user->image_url : asset('assets/img/avatar.png')}}">
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" title="Change profile">
                        <label>
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="editReceptionistProfileImage" name="image"
                                   class="image-upload d-none profileImage editReceptionistProfileImage"
                                   accept=".png, .jpg, .jpeg, .gif"/>
                            <input type="hidden" name="avatar_remove"/>
                        </label>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12 mb-3">
        <h5>{{__('messages.user.address_details')}}</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address1',__('messages.user.address1').(':'), ['class' => 'form-label']) }}
            {{ Form::text('address1', isset($receptionist->address->address1) ? $receptionist->address->address1 : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address2',__('messages.user.address2').(':'), ['class' => 'form-label']) }}
            {{ Form::text('address2', isset($receptionist->address->address2) ? $receptionist->address->address2 : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('city',__('messages.user.city').(':'), ['class' => 'form-label']) }}
            {{ Form::text('city', isset($receptionist->address->city) ? $receptionist->address->city : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('zip',__('messages.user.zip').(':'), ['class' => 'form-label']) }}
            {{ Form::text('zip', isset($receptionist->address->zip) ? $receptionist->address->zip : null, ['class' => 'form-control', 'maxlength' => '6','minlength' => '6']) }}
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('receptionists.index') }}"
           class="btn btn-secondary me-2">{{__('messages.common.cancel')}}</a>
    </div>
</div>
