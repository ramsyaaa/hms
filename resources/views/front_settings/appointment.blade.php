@extends('front_settings.index')
@section('title')
    {{ __('messages.front_settings') }}
@endsection
@section('section')
    <div class="card">
        <div class="card-header pb-0">
            <div class="card-title m-0">
                <h3>{{ __('messages.front_setting.appointment_details') }}</h3>
            </div>
        </div>
        <div class="card-body pt-3">
            {{ Form::open(['route' => ['front.settings.update'], 'method' => 'post', 'files' => true, 'id' => 'createAppointment']) }}
            {{ Form::hidden('sectionName', $sectionName) }}
            <div class="alert alert-danger d-none hide" id="appointmentErrorsBox"></div>
            <div class="row">
                <!-- About Us title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us_title', __('messages.front_setting.about_us_title').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::text('appointment_title', $frontSettings['appointment_title'], ['class' => 'form-control', 'required','onkeypress' => 'return avoidSpace(event);']) }}
                </div>
                <!-- About Us description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us_description', __('messages.front_setting.about_us_description').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::textarea('appointment_description', $frontSettings['appointment_description'], ['class' => 'form-control', 'required', 'rows' => 5,'onkeypress' => 'return avoidSpace(event);', 'maxlength'=>435]) }}
                </div>
            </div>
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

