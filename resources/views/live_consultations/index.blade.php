@extends('layouts.app')
@section('title')
    {{ __('messages.live_consultations') }}
@endsection
@section('content')
    @include('flash::message')
    <div class="container-fluid">
        {{Form::hidden('liveConsultationUrl',route('live.consultation.index'),['id'=>'indexLiveConsultationUrl'])}}
        {{Form::hidden('liveConsultationTypeNumber',route('live.consultation.list'),['id'=>'indexLiveConsultationTypeNumber'])}}
        {{Form::hidden('liveConsultationCreateUrl',route('live.consultation.store'),['id'=>'indexLiveConsultationCreateUrl'])}}
        {{Form::hidden('zoomCredentialCreateUrl',route('zoom.credential.create'),['id'=>'indexZoomCredentialCreateUrl'])}}
        {{Form::hidden('doctorRole',getLoggedInUser()->hasRole('Doctor')?true:false,['id'=>'indexConsultationDoctorRole'])}}
        {{Form::hidden('adminRole',getLoggedInUser()->hasRole('Admin')?true:false,['id'=>'indexConsultationAdminRole'])}}
        {{Form::hidden('patientRole',getLoggedInUser()->hasRole('Patient')?true:false,['id'=>'indexConsultationPatientRole'])}}
        {{ Form::hidden('live-consultation', __('messages.live_consultation.live_consultation'), ['id' => 'LiveConsultation']) }}
        <div class="d-flex flex-column">
            <livewire:live-consultation-table/>
            </div>
        @include('live_consultations.templates.templates')
        @include('live_consultations.add_modal')
        @include('live_consultations.edit_modal')
        @include('live_consultations.start_modal')
        @include('live_consultations.show_consultation_modal')
        @include('live_consultations.add_credential_modal')
    </div>
@endsection
@section('scripts')
    {{--    assets/js/live_consultations/live_consultations.js -}}
    {{--    assets/js/custom/new-edit-modal-form.js --}}
@endsection
