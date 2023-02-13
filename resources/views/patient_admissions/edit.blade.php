@extends('layouts.app')
@section('title')
    {{ __('messages.patient_admission.edit_patient_admission') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('patient-admissions.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                {{Form::hidden('utilsScript',asset('assets/js/int-tel/js/utils.min.js'),['class'=>'utilsScript'])}}
                {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}
                <div class="card-body p-12">
                    {{ Form::model($patientAdmission, ['route' => ['patient-admissions.update', $patientAdmission->id], 'method' => 'patch', 'id' => 'editPatientAdmission']) }}

                    @include('patient_admissions.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/patient_admissions/create-edit.js --}}
