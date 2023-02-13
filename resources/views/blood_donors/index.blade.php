@extends('layouts.app')
@section('title')
    {{ __('messages.blood_donor.blood_donors') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('bloodDonorCreateUrl', route('blood-donors.store'), ['id' => 'bloodDonorCreateUrl']) }}
            {{ Form::hidden('bloodDonorUrl', url('blood-donors'), ['id' => 'bloodDonorUrl']) }}
            {{ Form::hidden('blood_donor', __('messages.blood_donor.blood_donor'), ['id' => 'bloodDonor']) }}
            <livewire:blood-donor-table/>
            {{--            @include('accountants.table')--}}
            @include('blood_donors.modal')
            @include('blood_donors.edit_modal')
            @include('partials.modal.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{--   assets/js/blood_donors/blood_donors.js --}}
@endsection
