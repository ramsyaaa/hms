@extends('layouts.app')
@section('title')
    {{ __('messages.users') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        {{Form::hidden('user_url',route('users.index'),['id'=>'indexUserUrl'])}}
        {{Form::hidden('user_show_url',route('users.show'),['id'=>'indexUserShowUrl'])}}
        {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}
        {{ Form::hidden('users.show.modal', url('users-details-modal'), ['id' => 'usersShowModal']) }}
        {{ Form::hidden('user-language', getCurrentLoginUserLanguageName(),['id' => 'userLanguage']) }}
        {{ Form::hidden('user_active', __('messages.common.active'), ['id' => 'userActive']) }}
        {{ Form::hidden('user_de_active', __('messages.common.de_active'), ['id' => 'userDeActive']) }}
        <div class="d-flex flex-column">
            <livewire:user-table/>
        </div>
        @include('users.templates.templates')
        @include('users.templates.templates')
        @include('users.show_modal')
    </div>
@endsection
{{-- JS File :-assets/js/users/user.js --}}
