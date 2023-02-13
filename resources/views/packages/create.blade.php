@extends('layouts.app')
@section('title')
    {{ __('messages.package.new_package') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('packages.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                {{Form::hidden('packageSaveUrl',route('packages.store'),['class'=>'packageSaveUrl','id'=>'createPackageSaveUrl'])}}
                {{Form::hidden('packageUrl',route('packages.index'),['class'=>'packageUrl','id'=>'createPackageUrl'])}}
                {{Form::hidden('uniqueId',2,['class'=>'packageUniqueId'])}}
                {{Form::hidden('associateServices',json_encode($services),['class'=>'associateServices'])}}
                <div class="card-body p-12">
                    {{ Form::open(['route' => 'packages.store', 'id'=>'packageForm', 'class'=>'packageForm']) }}

                    @include('packages.fields')

                    {{ Form::close() }}
                </div>
            </div>
            @include('packages.templates.templates')
        </div>
    </div>
@endsection
{{--
    JS File :- assets/js/custom/input_price_format.js
               assets/js/packages/create-edit.js
--}}
