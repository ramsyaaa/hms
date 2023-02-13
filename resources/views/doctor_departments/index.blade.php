@extends('layouts.app')
@section('title')
    {{ __('messages.doctor_department.doctor_departments') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    @include('flash::message')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <livewire:doctor-department-table/>
        </div>
        @include('doctor_departments.create_modal')
        @include('doctor_departments.edit_modal')
        @include('partials.modal.templates.templates')
        {{Form::hidden('doctorDepartmentUrl',url('doctor-departments'),['id'=>'indexDoctorDepartmentUrl'])}}
        {{Form::hidden('doctorDepartmentCreateUrl',route('doctor-departments.store'),['id'=>'indexDoctorDepartmentCreateUrl'])}}
        {{ Form::hidden('doctor_department', __('messages.doctor_department.doctor_department'), ['id' => 'doctorDepartment']) }}
    </div>
@endsection
    {{--     assets/js/doctors_departments/doctors_departments.js --}}
