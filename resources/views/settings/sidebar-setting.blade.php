@extends('settings.edit')
@section('title')
    {{ __('messages.sidebar_setting') }}
@endsection
@section('content')
    {{Form::hidden('sidebarSetting',true,['id'=>'sidebarSetting'])}}
    {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}
    {{Form::hidden('moduleUrl',route('module.index'),['id'=>'sideBarModuleUrl'])}}
    {{Form::hidden('searchExist',true,['id'=>'sideBarSearchExist'])}}
    <div class="card-body table-striped">
        <livewire:module-table/>
    </div>
    @include('settings.templates.templates')
@endsection
{{-- JS File :-assets/js/settings/setting.js --}}
