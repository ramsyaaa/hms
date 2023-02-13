@extends('layouts.app')
@section('title')
    {{__('messages.accountant.accountants')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('accountantUrl', url('accountants'), ['id' => 'accountantURL']) }}
            {{ Form::hidden('accountant', __('messages.accountant.accountant'), ['id' => 'Accountant']) }}
            <livewire:accountant-table/>
            @include('accountants.templates.templates')
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{--  assets/js/accountants/accountants.js --}}
@endsection
