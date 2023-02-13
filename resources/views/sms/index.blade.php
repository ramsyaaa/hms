@extends('layouts.app')
@section('title')
    {{__('messages.sms.sms')}}
@endsection
@section('page_css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}"/>--}}
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    @include('flash::message')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            {{Form::hidden('smsUrl',url('sms'),['id'=>'smsUrl'])}}
            {{Form::hidden('createSmsUrl',route('sms.store'),['id'=>'createSmsUrl'])}}
            {{Form::hidden('getUsersListUrl',route('sms.users.lists'),['id'=>'getUsersListUrl'])}}
            {{Form::hidden('utilsScript',asset('assets/js/int-tel/js/utils.min.js'),['class'=>'utilsScript'])}}
            {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}
            {{ Form::hidden('sms.show.modal', url('sms-show-modal'), ['id' => 'SMSShowModal']) }}
            {{ Form::hidden('sms-language', getCurrentLoginUserLanguageName(),['id' => 'smsLanguage']) }}
            {{ Form::hidden('sms', __('messages.sms.sms'), ['id' => 'SMS']) }}
            <livewire:sms-table/>
        </div>
        @include('sms.templates.templates')
        @include('sms.create_modal')
        @include('sms.show_modal')
    </div>
@endsection
{{-- JS File :-assets/js/sms/sms.js --}}
@section('page_scripts')
    {{--  assets/js/int-tel/js/intlTelInput.min.js --}}
    {{-- assets/js/int-tel/js/utils.min.js --}}
@endsection
@section('scripts')
    {{--  assets/js/custom/delete.js --}}
    {{--  assets/js/sms/sms.js --}}
    {{--  assets/js/custom/phone-number-country-code.js --}}
@endsection
