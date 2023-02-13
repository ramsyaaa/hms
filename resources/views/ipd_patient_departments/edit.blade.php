@extends('layouts.app')
@section('title')
    {{ __('messages.ipd_patient.edit_ipd_patient') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('ipd.patient.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column livewire-table">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                {{Form::hidden('patientCasesUrl',route('patient.cases.list'),['id'=>'editPatientCasesUrl','class'=>'patientCasesUrl'])}}
                {{Form::hidden('patientBedsUrl',route('patient.beds.list'),['id'=>'editPatientBedsUrl','class'=>'patientBedsUrl'])}}
                {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}
                {{Form::hidden('ipdPatientCaseId',$ipdPatientDepartment->case_id,['id'=>'editIpdPatientCaseId','class'=>'editIpdPatientCaseId'])}}
                {{Form::hidden('ipdPatientBedId',$ipdPatientDepartment->bed_id,['id'=>'editIpdPatientBedId','class'=>'ipdPatientBedId'])}}
                {{Form::hidden('ipdPatientBedTypeId',$ipdPatientDepartment->bed_type_id,['id'=>'editIpdPatientBedTypeId','class'=>'ipdPatientBedTypeId'])}}

                <div class="card-body">
                    {{ Form::model($ipdPatientDepartment, ['route' => ['ipd.patient.update', $ipdPatientDepartment->id], 'method' => 'patch', 'id' => 'editIpdPatientDepartmentForm']) }}

                    @include('ipd_patient_departments.edit_fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{--  assets/js/ipd_patients/create.js --}}
@endsection
