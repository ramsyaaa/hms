@extends('layouts.app')
@section('title')
    {{ __('messages.ipd_patient.ipd_patient_details') }}
@endsection

@section('page_css')
@endsection

@section('css')
{{--    <link href="{{ asset('assets/css/timeline.css') }}" rel="stylesheet" type="text/css"/>--}}
@endsection

@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a href="{{  url()->previous() }}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                {{Form::hidden('ipdPrescriptionUrl',route('ipd.prescription.index'),['id'=>'showListIpdPrescriptionUrl'])}}
                {{Form::hidden('bootStrapUrl',asset('assets/css/bootstrap.min.css'),['id'=>'showListBootstrapUrl'])}}
                {{Form::hidden('ipdPatientDepartmentId',$ipdPatientDepartment->id,['id'=>'showListIpdPatientDepartmentId'])}}
                {{Form::hidden('ipdTimelinesUrl',route('ipd.timelines.index'),['id'=>'showListIpdTimelinesUrl'])}}
                {{Form::hidden('ipdStripePaymentUrl',url('stripe-charge'),['id'=>'showListIpdStripePaymentUrl'])}}
                {{Form::hidden('ipdPrescriptionUrl',route('ipd.prescription.index'),['id'=>'showIpdPrescriptionUrl'])}}
                {{Form::hidden('stripeConfigKey',config('services.stripe.key'),['id' => 'stripeConfigKey'])}}

                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
                @include('ipd_patient_list.show_fields')
        </div>
    </div>
    @include('ipd_prescriptions.show_modal')
@endsection
@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
 
    {{--  assets/js/ipd_patients_list/ipd_diagnosis.js --}}
    {{--  assets/js/ipd_patients_list/ipd_consultant_register.js --}}
    {{--  assets/js/ipd_patients_list/ipd_charges.js --}}
    {{--  assets/js/ipd_patients_list/ipd_prescriptions.js --}}
    {{--  assets/js/ipd_patients_list/ipd_timelines.js --}}
    {{--  ssets/js/custom/input_price_format.js -}}
    {{--  assets/js/ipd_patients_list/ipd_payments.js --}}
    {{--  assets/js/ipd_patients_list/ipd_stripe_payment.js --}}
@endsection
