@extends('layouts.app')
@section('title')
    {{ __('messages.nurse.new_nurse') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}">--}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('nurses.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column livewire-table">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                {{ Form::hidden('utilsScript', asset('assets/js/int-tel/js/utils.min.js'), ['class' => 'utilsScript']) }}
                {{ Form::hidden('isEdit', false, ['class' => 'isEdit']) }}
                {{ Form::hidden('defaultAvatarImageUrl', asset('assets/img/avatar.png'), ['class' => 'defaultAvatarImageUrl']) }}
                <div class="card-body p-12">
                    {{ Form::open(['route' => 'nurses.store', 'files' => 'true', 'id' => 'createNurseForm']) }}

                    @include('nurses.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    {{--  assets/js/moment.min.js --}}
    {{--  assets/js/int-tel/js/intlTelInput.min.js --}}
    {{--  assets/js/int-tel/js/utils.min.js --}}
@endsection
@section('scripts')

    {{--   assets/js/nurses/create-edit.js --}}
    {{--   assets/js/custom/add-edit-profile-picture.js --}}
    {{--   assets/js/custom/phone-number-country-code.js --}}
@endsection

