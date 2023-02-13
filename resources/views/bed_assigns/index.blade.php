@extends('layouts.app')
@section('title')
    {{ __('messages.bed_assign.bed_assigns') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('bedAssignUrl', url('bed-assigns'), ['id' => 'bedAssignUrl']) }}
            {{ Form::hidden('bedUrl', url('beds'), ['id' => 'bedUrl']) }}
            {{ Form::hidden('patientUrl', url('patients'), ['id' => 'patientUrl']) }}
            {{ Form::hidden('caseUrl', url('patient-cases'), ['id' => 'caseUrl']) }}
            {{ Form::hidden('bed_assign', __('messages.bed_assign.bed_assign'), ['id' => 'bedAssign']) }}
            <livewire:bed-assign-table/>
            @include('bed_assigns.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    
    {{-- assets/js/bed_assign/bed_assign.js --}}
@endsection
