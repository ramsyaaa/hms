@extends('layouts.app')
@section('title')
    {{ __('messages.account.accounts') }}
@endsection
@section('content')
    @include('flash::message')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            {{Form::Hidden('accountCreateUrl',route('accounts.store'),['id'=>'indexAccountCreateUrl'])}}
            {{Form::Hidden('accountUrl',route('accounts.index'),['class'=>'indexAccountUrl', 'id' => 'indexAccountUrl'])}}
            {{ Form::hidden('account', __('messages.account.account'), ['id' => 'Account']) }}
            <livewire:account-table/>
        </div>
        @include('accounts.add_modal')
        @include('accounts.edit_modal')
        @include('accounts.templates.templates')
        @include('partials.modal.templates.templates')
    </div>
@endsection
@section('scripts')
    {{--    assets/js/accounts/accounts.js  --}}
@endsection

