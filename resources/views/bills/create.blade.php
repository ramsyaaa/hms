@extends('layouts.app')
@section('title')
    {{ __('messages.bill.new_bill') }}
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
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => 'bills.store', 'id' => 'billForm']) }}
                    @include('bills.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @include('bills.templates.templates')
    {{Form::hidden('billSaveUrl',route('bills.store'),['id'=>'createBillSaveUrl','class'=>'billSaveUrl'])}}
    {{Form::hidden('billUrl',route('bills.index'),['id'=>'createBillUrl','class'=>'billUrl'])}}
    {{Form::hidden('associateMedicines',json_encode($associateMedicines),['id'=>'createBillAssociateMedicines','class'=>'associateMedicines'])}}
    {{Form::hidden('uniqueId',2,['id'=>'createBillUniqueId','class'=>'uniqueId'])}}
    {{Form::hidden('patientAdmissionDetailUrl',url('patient-admission-details'),['id'=>'createBillPatientAdmissionDetailUrl','class'=>'patientAdmissionDetailUrl'])}}
    {{Form::hidden('isCreate',true,['id'=>'createBillIsCreate','class'=>'isCreate'])}}
    {{Form::hidden('isEdit',false,['id'=>'createBillIsEdit','class'=>'isEdit'])}}
@endsection
@section('page_scripts')
{{--   assets/js/moment.min.js  --}}
@endsection
@section('scripts')
    {{--    assets/js/bills/new.js --}}
    {{--    assets/js/custom/input_price_format.js --}}
@endsection
