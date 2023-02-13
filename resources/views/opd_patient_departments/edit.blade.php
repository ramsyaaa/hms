@extends('layouts.app')
@section('title')
    {{ __('messages.opd_patient.edit_opd_patient') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{route('opd.patient.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column livewire-table">
            <div class="row">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                {{Form::hidden('patientCasesUrl',route('patient.cases.list'),['id'=>'editOpdPatientCasesUrl','class'=>'opdPatientCasesUrl'])}}
                {{Form::hidden('doctorOpdChargeUrl',route('getDoctor.OPDcharge'),['id'=>'editDoctorOpdChargeUrl','class'=>'doctorOpdChargeUrl'])}}
                {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}
                {{Form::hidden('lastVisit',false,['id'=>'editOpdLastVisit','class'=>'lastVisit'])}}

                <div class="card-body">
                    {{ Form::model($opdPatientDepartment, ['route' => ['opd.patient.update', $opdPatientDepartment->id], 'method' => 'patch', 'id' => 'editOpdPatientDepartmentForm']) }}

                    @include('opd_patient_departments.edit_fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
{{--    </div>--}}
@endsection
@section('scripts')
    {{--   assets/js/opd_patients/create.js --}}
@endsection
