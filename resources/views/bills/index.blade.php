@extends('layouts.app')
@section('title')
    {{ __('messages.bill.bills') }}
@endsection

@section('content')
    @include('flash::message')
    <div class="container-fluid">

        {{Form::hidden('billUrl',route('bills.index'),['id'=>'indexBillUrl','class'=>'billUrl'])}}
        {{Form::hidden('patientUrl',url('patients'),['id'=>'indexPatientUrl','class'=>'patientUrl'])}}
        {{ Form::hidden('bill', __('messages.bill.bill'), ['id' => 'Bill']) }}
        <div class="d-flex flex-column">
            <livewire:bill-table/>
        </div>
    </div>
@endsection
@section('scripts')
    {{--   assets/js/custom/input_price_format.js --}}
    {{--   assets/js/bills/bill.js -}}
    {{--   assets/js/custom/new-edit-modal-form.js -}}
    {{--   assets/js/custom/reset_models.js --}}
@endsection
