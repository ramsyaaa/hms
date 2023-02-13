@extends('layouts.app')
@section('title')
    {{ __('messages.opd_patient.new_opd_patient') }}
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
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                {{Form::hidden('patientCasesUrl',route('patient.cases.list'),['id'=>'createOpdPatientCasesUrl','class'=>'opdPatientCasesUrl'])}}
                {{Form::hidden('doctorOpdChargeUrl',route('getDoctor.OPDcharge'),['id'=>'createDoctorOpdChargeUrl','class'=>'doctorOpdChargeUrl'])}}
                {{Form::hidden('isEdit',false,['class'=>'isEdit'])}}
                {{Form::hidden('lastVisit',(isset($data['last_visit'])) ? $data['last_visit']->patient_id : false,['id'=>'createOpdLastVisit','class'=>'lastVisit'])}}

                <div class="card-body">
                    {{ Form::open(['route' => ['opd.patient.store'], 'method'=>'post', 'id' => 'createOpdPatientForm']) }}
                    @include('opd_patient_departments.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
{{--   assets/js/moment.min.js --}}
@endsection
@section('scripts')
    {{--   assets/js/opd_patients/create.js --}}
@endsection
