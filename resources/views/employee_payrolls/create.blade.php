@extends('layouts.app')
@section('title')
    {{ __('messages.employee_payroll.new_employee_payroll') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('employee-payrolls.index') }}"
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
                <div class="card-body p-12">
                    {{ Form::open(['route' => 'employee-payrolls.store', 'id' => 'createPayroll']) }}
                    @include('employee_payrolls.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    {{Form::hidden('employeeUrl',route('employees.list'),['id'=>'CreateEmployeeUrl','class'=>'employeeUrl'])}}
    {{Form::hidden('isEdit',false,['class'=>'isEdit'])}}
@endsection
@section('page_scripts')
    {{--     assets/js/custom/input_price_format.js --}}
    {{--     assets/js/employee_payrolls/payrolls.js --}}
@endsection
