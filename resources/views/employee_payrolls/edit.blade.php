@extends('layouts.app')
@section('title')
    {{ __('messages.employee_payroll.edit_employee_payroll') }}
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
                <div class="card-body">
                    {{ Form::model($employeePayroll, ['route' => ['employee-payrolls.update', $employeePayroll->id], 'method' => 'patch','id' => 'editPayroll']) }}
                    @include('employee_payrolls.edit_fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    {{Form::hidden('employeeUrl',route('employees.list'),['id'=>'editEmployeeUrl','class'=>'employeeUrl'])}}
    {{Form::hidden('employeeOwnerId',$employeePayroll->owner_id,['id'=>'editEmployeeOwnerUrl','class'=>'employeeOwnerId'])}}
    {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}
@endsection
@section('scripts')
    <script>
        {{--let employeeUrl = "{{ route('employees.list') }}";--}}
        {{--let employeeOwnerId = "{{ $employeePayroll->owner_id }}";--}}
        // let isEdit = true;
    </script>
@endsection
@section('page_scripts')
    {{--    <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/employee_payrolls/edit.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/employee_payrolls/payrolls.js') }}"></script>--}}
@endsection
