@extends('layouts.app')
@section('title')
    {{ __('messages.blood_donations') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('bloodDonationCreateUrl', route('blood-donations.store'), ['id' => 'bloodDonationCreateUrl']) }}
            {{ Form::hidden('bloodDonationUrl', route('blood-donations.index'), ['id' => 'bloodDonationUrl']) }}
            {{ Form::hidden('blood_donation', __('messages.blood_donation.blood_donation'), ['id' => 'bloodDonation']) }}
            <livewire:blood-donation-table/>
            @include('blood_donations.add_modal')
            @include('blood_donations.edit_modal')
            @include('partials.modal.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{--    assets/js/blood_donations/blood_donations.js --}}
@endsection
