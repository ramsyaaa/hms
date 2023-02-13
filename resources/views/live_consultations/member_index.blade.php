@extends('layouts.app')
@section('title')
    {{ __('messages.live_meetings') }}
@endsection
@section('content')
    @include('flash::message')
    <div class="container-fluid">
        {{Form::hidden('liveMeetingUrl',route('live.meeting.index'),['id'=>'indexLiveMeetingUrl'])}}
        {{Form::hidden('liveMeetingCreateUrl',route('live.meeting.store'),['id'=>'indexLiveMeetingCreateUrl'])}}
        {{Form::hidden('doctorRole',getLoggedInUser()->hasRole('Doctor')?true:false,['id'=>'indexMeetingDoctorRole'])}}
        {{Form::hidden('adminRole',getLoggedInUser()->hasRole('Admin')?true:false,['id'=>'indexMeetingAdminRole'])}}
        {{ Form::hidden('live-meeting', __('messages.live_meeting'), ['id' => 'LiveMeeting']) }}
        
        <div class="d-flex flex-column">
            <livewire:live-meeting-table/>
        </div>
        @include('live_consultations.templates.templates')
        @include('live_consultations.add_meeting_modal')
        @include('live_consultations.edit_meeting_modal')
        @include('live_consultations.start_meeting_modal')
        @include('live_consultations.show_meeting_modal')
    </div>
@endsection
@section('scripts')
    {{--    assets/js/live_consultations/live_meetings.js
    {{--    assets/js/custom/new-edit-modal-form.js --}}
@endsection
