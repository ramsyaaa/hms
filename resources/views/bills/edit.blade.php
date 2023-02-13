@extends('layouts.app')
@section('title')
    {{ __('messages.bill.edit_bill') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('bills.index') }}"
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
                    <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::model($bill, ['route' => ['bills.update', $bill->id], 'id' => 'billForm']) }}
                    @include('bills.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @include('bills.templates.templates')
    {{Form::hidden('billSaveUrl',route('bills.update', $bill->id),['id'=>'editBillSaveUrl','class'=>'billSaveUrl'])}}
    {{Form::hidden('billUrl',route('bills.index'),['id'=>'editBillUrl','class'=>'billUrl'])}}
    {{Form::hidden('associateMedicines',json_encode($associateMedicines),['id'=>'editBillAssociateMedicines','class'=>'associateMedicines'])}}
    {{Form::hidden('uniqueId',$bill->billItems->count() + 1,['id'=>'editBillUniqueId','class'=>'uniqueId'])}}
    {{Form::hidden('billDate',$bill->bill_date->format('Y-m-d h:i A'),['id'=>'editBillDate','class'=>'billDate'])}}
    {{Form::hidden('patientAdmissionDetailUrl',url('patient-admission-details'),['id'=>'editBillPatientAdmissionDetailUrl','class'=>'patientAdmissionDetailUrl'])}}
    {{Form::hidden('patientAdmissionId',$bill->patient_admission_id,['id'=>'editBillPatientAdmissionId','class'=>'patientAdmissionId'])}}
    {{Form::hidden('billId',$bill->id,['id'=>'editBillId','class'=>'billId'])}}
    {{Form::hidden('isEdit',true,['id'=>'editBillIsEdit','class'=>'isEdit'])}}
@endsection
@section('page_scripts')
{{--     assets/js/moment.min.js --}}
@endsection
@section('scripts')
    {{--  assets/js/bills/edit.js --}}
    {{--  assets/js/custom/input_price_format.js --}}
    {{--  assets/js/bills/new.js --}}
@endsection
