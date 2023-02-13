<div class="alert alert-danger d-none hide" id="editPharmacistErrorBox"></div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('first_name', __('messages.user.first_name').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('first_name', null, ['class' => 'form-control', 'required', 'tabindex' => '1']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('last_name', __('messages.user.last_name').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('last_name', null, ['class' => 'form-control', 'required', 'tabindex' => '2']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('email', __('messages.user.email').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::email('email', null, ['class' => 'form-control', 'required', 'tabindex' => '3','id'=>'editPharmacistEmail']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('designation', __('messages.user.designation').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('designation', null, ['class' => 'form-control', 'tabindex' => '4']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mobile-overlapping  mb-5">
            {{ Form::label('phone', __('messages.user.phone').':', ['class' => 'form-label']) }}
            <span class="required"></span><br>
            {{ Form::tel('phone', $pharmacist->user->phone ?? getCountryCode(), ['class' => 'form-control phoneNumber', 'id' => 'editPharmacistPhoneNumber', 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'tabindex' => '5']) }}
            {{ Form::hidden('prefix_code',null,['class'=>'prefix_code']) }}
            {{ Form::hidden('country_iso',null,['class'=>'country_iso']) }}
            <span class="text-success valid-msg d-none fw-400 fs-small mt-2">✓ &nbsp; {{__('messages.valid')}}</span>
            <span class="text-danger error-msg d-none fw-400 fs-small mt-2"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('qualification', __('messages.user.qualification').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('qualification', null, ['class' => 'form-control', 'tabindex' => '8']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('dob', __('messages.user.dob').':', ['class' => 'form-label']) }}
            {{ Form::text('dob', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light pharmacistBirthDate form-control' : 'bg-white pharmacistBirthDate form-control'), 'id' => 'editPharmacistBirthDate', 'autocomplete' => 'off', 'tabindex' => '9']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('blood_group', __('messages.user.blood_group').':', ['class' => 'form-label']) }}
            {{ Form::select('blood_group', $bloodGroup, null, ['class' => 'form-select pharmacistBloodGroup', 'id' => 'editPharmacistBloodGroup', 'placeholder' => 'Select Blood Group', 'data-control' => 'select2', 'tabindex' => "10"]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('gender', __('messages.user.gender').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            &nbsp;<br>
            <span class="is-valid">
                <label class="form-label">{{ __('messages.user.male') }}</label>&nbsp;&nbsp;
                {{ Form::radio('gender', '0', true, ['class' => 'form-check-input', 'tabindex' => '6','id'=>'editPharmacistGenderMale']) }} &nbsp;
                <label class="form-label">{{ __('messages.user.female') }}</label>
                {{ Form::radio('gender', '1', false, ['class' => 'form-check-input', 'tabindex' => '7','id'=>'editPharmacistGenderFemale']) }}
            </span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label']) }}
            <div class="form-check form-switch mt-3">
                <input class="form-check-input w-35px h-20px is-active" name="status" type="checkbox" value="1"
                       tabindex="11" {{ ($user->status === 1) ? 'checked' : '' }} >
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <div class="row2" io-image-input="true">
            {{ Form::label('image',__('messages.common.profile').(':'), ['class' => 'form-label']) }}
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="editPharmacistPreviewImage"
                         style="background-image: url('{{ isset($user->media[0]) ? $user->image_url : asset('assets/img/avatar.png') }}')">
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" title="Change profile">
                        <label>
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="editPharmacistProfileImage" name="image"
                                   class="image-upload d-none profileImage editPharmacistProfileImage" accept=".png, .jpg, .jpeg, .gif"/>
                            <input type="hidden" name="avatar_remove"/>
                        </label>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3 mb-5">
    <div class="col-md-12 mb-3">
        <h5>{{ __('messages.user.address_details') }}</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address1', __('messages.user.address1').':', ['class' => 'form-label']) }}
            {{ Form::text('address1', $pharmacist->address->address1 ?? null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address2', __('messages.user.address2').':', ['class' => 'form-label']) }}
            {{ Form::text('address2', $pharmacist->address->address2 ?? null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('city', __('messages.user.city').':', ['class' => 'form-label']) }}
            {{ Form::text('city', $pharmacist->address->city ?? null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('zip', __('messages.user.zip').':', ['class' => 'form-label']) }}
            {{ Form::text('zip', $pharmacist->address->zip ?? null, ['class' => 'form-control', 'maxlength' => '6','minlength' => '6']) }}
        </div>
    </div>
</div>

<div class="d-flex justify-content-end">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','id' => 'editPharmacistSave']) }}
    <a href="{{ route('pharmacists.index') }}" class="btn btn-secondary me-2">{!! __('messages.common.cancel') !!}</a>
</div>
