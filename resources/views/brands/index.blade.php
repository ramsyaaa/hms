@extends('layouts.app')
@section('title')
    {{ __('messages.medicine.medicine_brands') }}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        {{Form::hidden('brandUrl',url('brands'),['id'=>'indexBrandUrl'])}}
        {{ Form::hidden('medicine_brand', __('messages.medicine.medicine'). ' ' . __('messages.medicine.brand') , ['id' => 'medicineBrand']) }}
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:medicine-brand-table/>
        </div>
        @include('partials.page.templates.templates')
    </div>
@endsection
@section('scripts')
    {{--    <script>--}}
    {{--let brandUrl = "{{url('brands')}}";--}}
    {{--    </script>--}}
    {{--    <script src="{{ mix('assets/js/brands/brands.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>--}}
@endsection
