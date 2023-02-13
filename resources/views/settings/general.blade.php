@extends('settings.edit')
@section('title')
    {{ __('messages.general') }}
@endsection
@section('section')
        {{ Form::open(['route' => ['settings.update'], 'method' => 'post', 'files' => true, 'id' => 'createSetting']) }}
        <div class="alert alert-danger d-none hide generalValidationErrorsBox" id="generalValidationErrorsBox"></div>
        <div class="row">
            <!-- App Name Field -->
            <div class="col-md-6">
                <div class="form-group mb-5">
                    {{ Form::label('app_name',__('messages.setting.app_name').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::text('app_name', $settings['app_name'], ['class' => 'form-control','required']) }}
                </div>
            </div>
            <!-- Company Name Field -->
            <div class="col-md-6">
                <div class="form-group mb-5">
                    {{ Form::label('company_name', __('messages.setting.company_name').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::text('company_name',  $settings['company_name'], ['class' => 'form-control','required']) }}
                </div>
            </div>
            <!-- Hospital Email Field -->
            <div class="col-md-6">
                <div class="form-group mb-5">
                    {{ Form::label('hospital_email',__('messages.setting.hospital_email').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::email('hospital_email',  $settings['hospital_email'], ['class' => 'form-control','required','id'=>'createAccountantEmail']) }}
                </div>
            </div>
            <!-- Hospital Phone Field -->
            <div class="col-md-6">
                <div class="form-group mb-5">
                    {{ Form::label('hospital_phone',__('messages.setting.hospital_phone').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    <br>
                    {{ Form::tel('hospital_phone',  $settings['hospital_phone'] ?? getCountryCode(), ['class' => 'form-control phoneNumber','id' => 'generalPhoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'required']) }}
                    {{ Form::hidden('prefix_code',null,['class'=>'prefix_code']) }}
                    <span class="text-success valid-msg d-none fw-400 fs-small mt-2">✓ &nbsp; {{__('messages.valid')}}</span>
                    <span class="text-danger error-msg d-none fw-400 fs-small mt-2"></span>
                </div>
            </div>
            <!-- Hospital From Day Field -->
            <div class="col-md-6">
                <div class="form-group mb-5">
                    {{ Form::label('hospital_from_day', __('messages.setting.hospital_from_day').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::text('hospital_from_day',  $settings['hospital_from_day'], ['class' => 'form-control','required',  
                        'onkeypress' => 'return avoidSpace(event);']) }}
                </div>
            </div>
            <!-- Hospital From Time Field -->
            <div class="col-md-6">
                <div class="form-group mb-5">
                    {{ Form::label('hospital_from_time', __('messages.setting.hospital_from_time').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::text('hospital_from_time',  $settings['hospital_from_time'], ['class' => 'form-control','required',  
                        'onkeypress' => 'return avoidSpace(event);']) }}
                </div>
            </div>
            <!-- Address Field -->
            <div class="col-md-6">
                <div class="form-group mb-5">
                    {{ Form::label('hospital_address', __('messages.setting.address').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::text('hospital_address',  $settings['hospital_address'], ['class' => 'form-control','required',  
                        'onkeypress' => 'return avoidSpace(event);']) }}
                </div>
            </div>
            <!-- Currency Field -->
            <div class="col-md-6">
                <div class="form-group mb-5">
                    {{ Form::label('current_currency', __('messages.setting.currency').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    <select id="generalCurrencyType" data-show-content="true" class="form-select"
                            name="current_currency">
                        @foreach($currencies as $key => $currency)
                            <option value="{{$key}}" {{getCurrentCurrency() == $key ? 'selected' : ''}}>
                                {{$currency['symbol']}}&nbsp;&nbsp;&nbsp; {{$currency['name']}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-5 country-code">
                    {{ Form::label('country_phone', __('messages.setting.country_code').':', ['class' => 'form-label']) }}
                    {{ Form::text('country_phone', $settings['country_code'], ['class' => 'form-control', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'countryPhone']) }}
                    {{ Form::hidden('country_code', $settings['country_code'],['id'=>'countryCode']) }}
                    {{ Form::hidden('country_name',$settings['country_name'], ['id'=>'countryName']) }}
                    {{ Form::hidden('country_iso',null,['class'=>'country_iso']) }}
                    <span class="text-success valid-msg d-none fw-400 fs-small mt-2">✓ &nbsp; {{__('messages.valid')}}</span>
                    <span class="text-danger error-msg d-none fw-400 fs-small mt-2"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- About us Field -->
            <div class="col-md-12">
                <div class="form-group mb-5">
                    {{ Form::label('about_us',  __('messages.web_home.about_us').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::textarea('about_us',  $settings['about_us'], ['class' => 'form-control','required', 'rows' => 5, 
                        'onkeypress' => 'return avoidSpace(event);']) }}
                </div>
            </div>
        </div>
        
        <div class="row">
            {{--<!-- App Logo Field -->--}}
            <div class="col-md-6">
                <div class="row2" io-image-input="true">
                    {{ Form::label('app_logo',__('messages.setting.app_logo').(':'), ['class' => 'form-label required']) }}
                    <div class="d-block">
                        <?php
                        $style = 'style=';
                        $background = 'background-image:';
                        ?>
                        <div class="image-picker">
                            <div class="image previewImage" id="previewImage"
                            {{$style}}"{{$background}} url('{{ ($settings['app_logo']) ? $settings['app_logo'] : asset('assets/img/default_image.jpg') }}')">
                            <span class="picker-edit rounded-circle text-gray-500 fs-small" title="Change app logo">
                                        <label>
                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            <input type="file" id="generalAppLogo" name="app_logo"
                                                   class="image-upload d-none profileImage generalAppLogo"
                                                   accept=".png, .jpg, .jpeg, .gif"/>
                                            <input type="hidden" name="avatar_remove"/>
                                        </label>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Favicon Field -->
            <div class="col-md-6 mb-5">
                <div class="row2" io-image-input="true">
                    {{ Form::label('favicon',__('messages.setting.favicon').(':'), ['class' => 'form-label required']) }}
                    <div class="d-block">
                        <?php
                        $style = 'style=';
                        $background = 'background-image:';
                        ?>

                        <div class="image-picker">
                            <div class="image previewImage" id="previewImage"
                            {{$style}}"{{$background}}
                            url('{{ ($settings['favicon']) ? $settings['favicon'] : asset('web/img/favicon.png') }}')">
                            <span class="picker-edit rounded-circle text-gray-500 fs-small" title="Change favicon icon">
                                            <label>
                                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                <input type="file" id="generalFavicon" name="favicon"
                                                       class="image-upload d-none profileImage generalFavicon"
                                                       accept=".png, .jpg, .jpeg, .gif"/>
                                                <input type="hidden" name="avatar_remove"/>
                                            </label>
                                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <hr>
    <div class="row">
        <div class="col-md-12 mb-3">
            <h5>{{ __('messages.setting.social_details') }}</h5>
        </div>
        <!-- Facebook URL Field -->
        <div class="row">
            <div class="col-md-6 mb-5">
                <div class="form-group mb-5">
                    {{ Form::label('facebook_url', __('messages.facebook_url').':', ['class' => 'form-label']) }}
                    {{ Form::text('facebook_url',  $settings['facebook_url'], ['class' => 'form-control', 'id'=>'generalFacebookUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
                </div>
            </div>
            <!-- Twitter URL Field -->
            <div class="col-md-6 mb-5">
                <div class="form-group mb-5">
                    {{ Form::label('twitter_url', __('messages.twitter_url').':', ['class' => 'form-label']) }}
                    {{ Form::text('twitter_url',  $settings['twitter_url'], ['class' => 'form-control', 'id'=>'generalTwitterUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
                </div>
            </div>
            <!-- Instagram URL Field -->
            <div class="col-md-6 mb-5">
                <div class="form-group mb-5">
                    {{ Form::label('instagram_url', __('messages.instagram_url').':', ['class' => 'form-label']) }}
                    {{ Form::text('instagram_url',  $settings['instagram_url'], ['class' => 'form-control', 'id'=>'generalInstagramUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
                </div>
            </div>
            <!-- LinkedIn URL Field -->
            <div class="col-md-6 mb-5">
                <div class="form-group mb-5">
                    {{ Form::label('linkedIn_url', __('messages.linkedIn_url').':', ['class' => 'form-label']) }}
                    {{ Form::text('linkedIn_url',  $settings['linkedIn_url'], ['class' => 'form-control', 'id'=>'generalLinkedInUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- Submit Field -->
        <div class="d-flex justify-content-end">
                {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
                {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-secondary me-2']) }}
        </div>
    {{ Form::close() }}
@endsection
