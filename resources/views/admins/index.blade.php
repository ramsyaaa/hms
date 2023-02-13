@extends('layouts.app')
@section('title')
    {{__('messages.admin')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('adminUrl', url('admins'), ['id' => 'adminURL']) }}
            {{ Form::hidden('admin', __('messages.admins'), ['id' => 'admin']) }}
            <livewire:admin-table/>
        </div>
    </div>
@endsection

