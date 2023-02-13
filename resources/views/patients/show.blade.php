@extends('layouts.app')
@section('title')
    {{ __('messages.patient.patient_details') }}
@endsection
@section('page_css')
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                @if (!Auth::user()->hasRole('Doctor|Accountant|Case Manager|Nurse|Patient'))
                    <a href="{{ route('patients.edit',['patient' => $data->id]) }}"
                       class="btn btn-primary me-2">{{ __('messages.common.edit') }}</a>
                @endif
                <a href="{{ url()->previous() }}"
                   class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        {{Form::hidden('advancedPaymentUrl',url('advanced-payments'),['id'=>'showPatientAdvancedPaymentUrl'])}}
        {{Form::hidden('advancePaymentCreateUrl',route('advanced-payments.store'),['id'=>'showPatientAdvancePaymentCreateUrl'])}}
        {{Form::hidden('patientUrl',url('patients'),['id'=>'showPatientUrl'])}}
        {{Form::hidden('vaccinatedPatientUrl',route('vaccinated-patients.index'),['id'=>'showVaccinatedPatientUrl'])}}
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                    @include('patients.show_fields')
                </div>
            </div>
            @include('patients.advanced_payments.edit_modal')
            @include('patients.vaccinations.edit_modal')
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/patients/patients_data_listing.js --}}
