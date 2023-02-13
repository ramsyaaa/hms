@extends('layouts.app')
@section('title')
    {{ __('messages.doctor.doctor_details') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                @if (!Auth::user()->hasRole('Doctor|Accountant'))
                    <a href="{{route('doctors.edit',['doctor' => $doctorData->id]) }}"
                       class="btn btn-primary me-2">{{ __('messages.common.edit') }}</a>
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
            @include('doctors.show_fields')
        </div>  
    </div>
@endsection
{{-- JS File :- assets/js/jquery.dataTables.min.js --}}
