@extends('layouts.app')
@section('title')
    {{ __('messages.bed.beds') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('bedUrl', url('beds'), ['class' => 'bedUrl']) }}
            {{ Form::hidden('bedCreateUrl', route('beds.store'), ['id' => 'bedCreateUrl']) }}
            {{ Form::hidden('bedTypesUrl', url('bed-types'), ['id' => 'bedTypesUrl']) }}
            {{ Form::hidden('beds', __('messages.patient_admission.bed'), ['id' => 'Beds']) }}
            <livewire:bed-table/>
            @include('beds.create_modal')
            @include('beds.edit_modal')
            @include('partials.modal.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{--   assets/js/custom/input_price_format.js --}}
    {{--   assets/js/beds/beds.js --}}
    {{--   assets/js/beds/create-edit.js --}}
@endsection
