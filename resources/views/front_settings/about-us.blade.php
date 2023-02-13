@extends('front_settings.index')
@section('title')
    {{ __('messages.front_settings') }}
@endsection
@section('section')
    <div class="card">
        <div class="card-header pb-0">
            <div class="card-title m-0">
                <h3>{{ __('messages.front_setting.about_us_details') }}</h3>
            </div>
        </div>
        <div class="card-body pt-3">
            {{ Form::open(['route' => ['front.settings.update'], 'method' => 'post', 'files' => true, 'id' => 'createAboutUs']) }}
            {{ Form::hidden('sectionName', $sectionName) }}
            <div class="alert alert-danger d-none hide" id="aboutUsErrorsBox"></div>
            <div class="row">
                <!-- About Us title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us_title', __('messages.front_setting.about_us_title').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::text('about_us_title', $frontSettings['about_us_title'], ['class' => 'form-control', 'required','id'=>'aboutUsTitle']) }}
                </div>
                <!-- About Us description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us_description', __('messages.front_setting.about_us_description').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::textarea('about_us_description', $frontSettings['about_us_description'], ['class' => 'form-control', 'required', 'rows' => 5,'id'=>'aboutUsDes']) }}
                </div>
                <!-- About Us mission Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us_mission', __('messages.front_setting.about_us_mission').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::textarea('about_us_mission', $frontSettings['about_us_mission'], ['class' => 'form-control', 'required', 'rows' => 5,'id'=>'aboutUsMission']) }}
                </div>
                <!-- About US Image Field -->
                <div class="form-group col-sm-6 mb-5">
                    <div class="row2" io-image-input="true">
                        {{ Form::label('about_us_image', __('messages.front_setting.about_us_image').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        <div class="d-block">
                            <div class="image-picker">
                                <div class="image previewImage" id="aboutUsPreviewImage"
                                     style="background-image: url({{ ($frontSettings['about_us_image']) ? $frontSettings['about_us_image'] : asset('assets/img/default_image.jpg') }})">
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small" title="Change about us image">
                                        <label>
                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            {{ Form::file('about_us_image',['id'=>'aboutUsImage','class' => 'image-upload d-none homePageImage','accept' => '.png, .jpg, .jpeg']) }}
                                            <input type="hidden" name="avatar_remove"/>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <!-- Submit Field -->
                <div class="form-group col-sm-12 mb-5 d-flex justify-content-end">
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
                    {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-secondary']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
