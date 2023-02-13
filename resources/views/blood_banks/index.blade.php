@extends('layouts.app')
@section('title')
    {{ __('messages.hospital_blood_bank.blood_bank') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('bloodBankCreateUrl', route('blood-banks.store'), ['id' => 'bloodBankCreateUrl']) }}
            {{ Form::hidden('bloodBankUrl', url('blood-banks'), ['id' => 'bloodBankUrl']) }}
            {{ Form::hidden('blood_bank', __('messages.hospital_blood_bank.blood_bank'), ['id' => 'bloodBank']) }}
            <livewire:blood-bank-table/>
            @include('blood_banks.modal')
            @include('blood_banks.edit_modal')
            @include('partials.modal.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{--  assets/js/blood_banks/blood_banks.js --}}
@endsection
