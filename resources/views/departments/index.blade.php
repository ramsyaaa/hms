@extends('layouts.app')
@section('title')
    {{ __('messages.roles') }}
@endsection
@section('page_css')
    {{--    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>--}}
    {{--    <link href="{{ asset('assets/css/jquery.toast.min.css') }}" rel="stylesheet" type="text/css"/>--}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="page-header">
                <h3 class="page__heading">{{ __('messages.roles') }}</h3>
                <div class="filter-container">
                    {{ Form::hidden('department_create_url', route('departments.store'), ['id' => 'departmentCreateUrl']) }}
                    {{ Form::hidden('department_url', route('departments.index'), ['id' => 'departmentUrl']) }}
                    <div class="mr-2">
                        <label for="filter_active" class="lbl-block"><b>{{ __('messages.common.active') }}</b></label>
                        {{ Form::select('is_active',$activeArr,null,['id'=>'filter_active','class'=>'form-control status-filter']) }}
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary filter-container__btn" data-toggle="modal"
                       data-target="#add_departments_modal">
                        {{ __('messages.role.new_role') }}
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @include('departments.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('departments.add_modal')
        @include('departments.edit_modal')
        @include('departments.templates.templates')
        {{ Form::hidden('departmentCreateUrl', route('departments.store'), ['id' => 'indexDepartmentCreateUrl']) }}
        {{ Form::hidden('departmentUrl', route('departments.index'), ['id' => 'indexDepartmentUrl']) }}
    </div>
@endsection
{{--    <script src="{{mix('assets/js/departments/departments.js')}}"></script>--}}
{{--    <script src="{{ mix('assets/js/custom/reset_models.js') }}"></script>--}}

