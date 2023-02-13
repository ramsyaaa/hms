@extends('layouts.app')
@section('title')
    {{ __('messages.settings') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}">--}}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                    @include('flash::message')
                </div>
            </div>
    <div class="card">
        <div class="card-body">
            {{Form::hidden('setting',true,['id'=>'editSetting'])}}
            {{Form::hidden('utilsScript',asset('assets/js/int-tel/js/utils.min.js'),['class'=>'utilsScript'])}}
            {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}

            {{Form::hidden('moduleUrl',route('module.index'),['id'=>'editGeneralModuleUrl'])}}
            {{Form::hidden('imageValidation',__('messages.setting.image_validation'),['id'=>'editGeneralImageValidation'])}}
            {{Form::hidden('searchExist',false,['id'=>'editGeneralSearchExist'])}}
            @yield('section')
        </div>
    </div>
@endsection
{{-- JS File :-assets/js/settings/setting.js --}}
            
@section('page_scripts')
    {{--    <script src="{{ asset('assets/js/int-tel/js/intlTelInput.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/js/int-tel/js/utils.min.js') }}"></script>--}}
@endsection
@section('scripts')
    <script>
        {{--let utilsScript = "{{asset('assets/js/int-tel/js/utils.min.js')}}";--}}
        // let isEdit = true;
        {{--let moduleUrl = '{{ route('module.index') }}';--}}
        {{--let imageValidation = '{{  __('messages.setting.image_validation') }}';--}}
        // let searchExist = false;
    </script>
    {{--    <script src="{{ mix('assets/js/settings/setting.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>--}}
@endsection
