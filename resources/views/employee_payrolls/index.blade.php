@extends('layouts.app')
@section('title')
    {{ __('messages.employee_payroll.employee_payrolls') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            {{Form::Hidden('employeePayrollUrl',url('employee-payrolls'),['id'=>'indexEmployeePayrollUrl'])}}
            {{Form::Hidden('employeePayroll',__('messages.employee_payroll.employee_payroll'),['id'=>'employeePayroll'])}}
            {{Form::Hidden('editMessage',url('employee-payrolls'),['id'=>'indexPayrollEditMessage'])}}
            {{Form::Hidden('deleteMessage',url('employee-payrolls'),['id'=>'indexPayrollDeleteMessage'])}}
            {{ Form::hidden('employee-payrolls.modal', url('employee-payrolls-show'), ['id' => 'employeesPayrollShowModal']) }}
            {{ Form::hidden('employee_payroll_status_paid', __('messages.employee_payroll.paid'), ['id' => 'employeesPayrollStatusPaid']) }}
            {{ Form::hidden('employee_payroll_status_unpaid', __('messages.employee_payroll.not_paid'), ['id' => 'employeesPayrollStatusUnPaid']) }}
            <livewire:employee-payroll-table/>
            @include('partials.page.templates.templates')
            @include('employee_payrolls.show_modal')
        </div>
    </div>
@endsection
@section('scripts')
    {{--   assets/js/custom/input_price_format.js --}}
    {{--   assets/js/employee_payrolls/employee_payrolls.js --}}
@endsection
