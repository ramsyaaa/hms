@extends('layouts.app')
@section('title')
    {{ __('messages.doctor_department.doctor_department_details') }}
@endsection
@section('page_css')
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">{{__('messages.doctor_department.doctor_department_details')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                @if (!Auth::user()->hasRole('Doctor|Patient|Receptionist'))
                    <a class="btn btn-primary me-2 doctor-department-edit-btn"
                       data-id="{{ $doctorDepartment->id }}">{{ __('messages.common.edit') }}</a>
                @endif
                <a href="{{ url()->previous() }}"
                   class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            @include('doctor_departments.show_fields')
            @include('doctor_departments.edit_modal')
        </div>
    </div>
    @include('doctor_departments.edit_modal')
    {{Form::hidden('showDoctorDepartmentUrl',Request::fullUrl(),['id'=>'showDoctorDepartmentUrl'])}}
    {{Form::hidden('doctorDepartmentUrl',url('doctor-departments'),['id'=>'indexDoctorDepartmentUrl'])}}
@endsection
@section('scripts')
    {{--    assets/js/doctors_departments/doctors_departments-details-edit.js') }}"></script>--}}
@endsection
