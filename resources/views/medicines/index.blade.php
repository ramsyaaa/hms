@extends('layouts.app')
@section('title')
    {{ __('messages.medicine.medicines') }}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        {{Form::hidden('medicineUrl',route('medicines.index'),['id'=>'indexMedicineUrl'])}}
        {{ Form::hidden('medicines-show-modal', url('medicines-show-modal'), ['id'=>'medicinesShowModal']) }}
        {{ Form::hidden('medicine-language', getCurrentLoginUserLanguageName(),['id' => 'medicineLanguage']) }}
        {{ Form::hidden('medicine', __('messages.medicine.medicine'), ['id' => 'Medicine']) }}
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:medicine-table/>
            {{--            @include('medicines.table')--}}
        </div>
        @include('partials.page.templates.templates')
        @include('medicines.show_modal')
    </div>
@endsection
@section('page_scripts')
{{-- assets/js/moment.min.js --}}
@endsection
@section('scripts')
    {{-- assets/js/custom/input_price_format.js --}}
    {{-- assets/js/medicines/medicines.js --}}
@endsection

