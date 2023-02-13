@extends('web.layouts.front')
@section('title')
    {{ __('messages.appointments') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ mix('web_front/css/appointment.css') }}">--}}
@endsection
@section('content')
    @php
        $settingValue = getSettingValue();
    @endphp

    <div class="appointment-page">
        <!-- start hero section -->
        <section
                class="hero-section position-relative p-t-60 border-bottom-right-rounded border-bottom-left-rounded bg-gray overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="hero-content">
                            <h1 class="mb-3 pb-1">
                                {{ __('messages.web_home.make_appointment') }}
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-lg-start justify-content-center mb-lg-0 mb-5">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('front') }}">{{ __('messages.web_home.home') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('messages.web_home.make_appointment') }}    
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center">
                        <img src="{{ asset('web_front/images/page-banner/make-appointment.png') }}" alt="Infy Care" class="img-fluid" />
                    </div>
                </div>  
            </div>
        </section>
        <!-- end hero section -->

        <section class="appointment-section p-t-120 position-relative">
            <div class="container">
                <div class="alert alert-danger" id="validationErrorsBox" style="display: none"></div>
{{--                {{Form::hidden('userCurrentLanguage',checkLanguageSession(),['class'=>'userCurrentLanguage'])}}--}}
                {{ Form::open(['id' => 'webAppointmentFormSubmit','class'=>'appointment-form']) }}
                @csrf
                    @include('web.home.appointment_fields')
                {{ Form::close() }}
            </div>
        </section>
        <!-- end appointment-form section -->
        
        <!-- start contact section -->
        <section class="contact-details-section p-t-120 p-b-120">
            <div class="container">
                <div class="row mt-xl-5">
                    <div class="col-lg-6">
                        <div class="text-lg-start text-center mb-lg-0 mb-5">
                            <h2 class="mb-3">{{ getFrontSettingValue(\App\Models\FrontSetting::APPOINTMENT,'appointment_title') }}</h2>
                            <p class="mb-0">
                                {!! getFrontSettingValue(\App\Models\FrontSetting::APPOINTMENT,'appointment_description') !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-6 contact-details-block d-flex align-items-stretch">
                                <div class="card text-center mx-xl-2 flex-fill">
                                    <div class="icon-details-box d-flex align-items-center justify-content-center mx-auto">
                                        <i class="fa-solid fa-phone fs-3"></i>
                                    </div>
                                    <div class="card-body text-center d-flex flex-column pb-4">
                                        <a href="tel:{{ $settingValue['hospital_phone']['value'] }}" class="text-decoration-none fs-5 text-success my-2">
                                            {{ $settingValue['hospital_phone']['value'] }}
                                        </a>
                                        <span class="text-secondary fw-light">
                                            {{ __('messages.web_appointment.call_now_and_get_a_free_consulting') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 contact-details-block d-flex align-items-stretch">
                                <div class="card text-center mx-xl-2 flex-fill">
                                    <div class="icon-details-box d-flex align-items-center justify-content-center mx-auto">
                                        <i class="fa-solid fa-envelope fs-3"></i>
                                    </div>
                                    <div class="card-body text-center d-flex flex-column pb-4">
                                        <a href="mailto:{{ $settingValue['hospital_email']['value'] }}"
                                           class="text-decoration-none fs-5 text-success my-2">
                                            {{$settingValue['hospital_email']['value'] }}
                                        </a>
                                        <span class="text-secondary fw-light">Contact Hospital</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="btn-group mt-4 mt-xl-5">
                        @if($settingValue['facebook_url']['value'] != '' && !empty($settingValue['facebook_url']['value']))
                            <a href="{{ $settingValue['facebook_url']['value'] }}" target="_blank" class="btn btn-primary fs-4">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        @endif
                        @if($settingValue['twitter_url']['value'] != '' && !empty($settingValue['twitter_url']['value']))
                            <a href="{{ $settingValue['twitter_url']['value'] }}" target="_blank" class="btn btn-primary fs-4">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        @endif
                        @if($settingValue['instagram_url']['value'] != '' && !empty($settingValue['instagram_url']['value']))
                            <a href="{{ $settingValue['instagram_url']['value'] }}" target="_blank" class="btn btn-primary fs-4">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        @endif
                        @if($settingValue['linkedIn_url']['value'] != '' && !empty($settingValue['linkedIn_url']['value']))
                            <a href="{{ $settingValue['linkedIn_url']['value'] }}" target="_blank" class="btn btn-primary fs-4">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- end  contact section -->

        @include('appointments.templates.appointment_slot')
        {{Form::hidden('doctorDepartmentUrl',route('appointment.doctor.list'),['id'=>'homeDoctorDepartmentUrl','class'=>'homeDoctorDepartmentUrl'])}}
        {{Form::hidden('doctorUrl',route('appointment.doctors.list'),['id'=>'homeDoctorUrl','class'=>'homeDoctorUrl'])}}
        {{Form::hidden('appointmentSaveUrl',route('web.appointments.store'),['id'=>'homeAppointmentSaveUrl','class'=>'homeAppointmentsSaveUrl'])}}
        {{Form::hidden('doctorScheduleList',url('appointment-doctor-schedule-list'),['id'=>'homeDoctorScheduleList','class'=>'homeDoctorScheduleList'])}}
        {{Form::hidden('isEdit',false,['id'=>'homeIsEdit','class'=>'isEdit'])}}
        {{Form::hidden('isCreate',true,['id'=>'homeIsCreate','class'=>'isCreate'])}}
        {{Form::hidden('getBookingSlot',route('appointment.get.booking.slot'),['id'=>'homeGetBookingSlot','class'=>'homeGetBookingSlot'])}}
    </div>
@endsection
@section('page_scripts')
    {{--    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/custom/helpers.js') }}"></script>--}}
{{--    <script src="{{ asset('backend/js/moment-round/moment-round.js') }}"></script>--}}
    {{--        <script src="{{mix('assets/js/web/appointment.js')}}"></script>--}}
@endsection
