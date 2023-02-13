@extends('layouts.app')
@section('title')
    {{ __('messages.enquiries') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('accountantUrl', url('accountants'), ['id' => 'accountantURL']) }}
            <livewire:enquiry-table/>
            {{Form::hidden('enquiryUrl',url('enquiries'),['id'=>'indexEnquiryUrl'])}}
            {{Form::hidden('enquiryShowUrl',url('enquiry'),['id'=>'indexEnquiryShowUrl'])}}
        </div>
    </div>
@endsection
@section('page_scripts')
    {{-- assets/js/moment.min.js --}}
@endsection
@section('scripts')
    {{--    assets/js/enquiry/enquiry.js --}}
@endsection
