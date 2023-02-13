@extends('layouts.app')
@section('title')
    {{ __('messages.doctor_opd_charges') }}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('doctorOPDChargeUrl', url('doctor-opd-charges'), ['id' => 'doctorOPDChargeURLID']) }}
            {{ Form::hidden('doctorOPDChargeCreateUrl', route('doctor-opd-charges.store'), ['id' => 'doctorOPDCreateChargeURLID']) }}
            {{ Form::hidden('doctorShowUrl', url('doctors'), ['id' => 'doctorShowURLID']) }}
            {{ Form::hidden('doctor_opd_charges', __('messages.doctor_opd_charge.doctor_opd_charge'), ['id' => 'doctorOPDCharges']) }}
            <livewire:doctor-o-p-d-charge-table/>
            @include('doctor_opd_charges.create_modal')
            @include('doctor_opd_charges.edit_modal')
        </div>
    </div>
@endsection
{{--   assets/js/custom/input_price_format.js --}}
{{--   assets/js/doctor_opd_charges/doctor_opd_charges.js --}}
