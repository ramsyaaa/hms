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
                <a href="{{ route('ipd.patient.edit',['ipdPatientDepartment' => $ipdPatientDepartment->id]) }}"
                   class="btn btn-primary me-2">{{ __('messages.common.edit') }}</a>
                <a href="{{ url()->previous() }}"
                   class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')

    {{Form::hidden('ipdDiagnosisCreateUrl',route('ipd.diagnosis.store'),['id'=>'showIpdDiagnosisCreateUrl'])}}
    {{Form::hidden('ipdDiagnosisUrl',route('ipd.diagnosis.index'),['id'=>'showIpdDiagnosisUrl'])}}
    {{Form::hidden('ipdConsultantRegisterUrl',route('ipd.consultant.index'),['id'=>'showIpdConsultantRegisterUrl'])}}
    {{Form::hidden('ipdConsultantRegisterCreateUrl',route('ipd.consultant.store'),['id'=>'showIpdConsultantRegisterCreateUrl'])}}
    {{Form::hidden('ipdChargesUrl',route('ipd.charge.index'),['id'=>'showIpdChargesUrl'])}}

    {{Form::hidden('ipdChargesCreateUrl',route('ipd.charge.store'),['id'=>'showIpdChargesCreateUrl'])}}
    {{Form::hidden('defaultDocumentImageUrl',asset('assets/img/default_image.jpg'),['id'=>'showDefaultDocumentImageUrl', 'class' => 'showDefaultDocumentImageUrl'])}}
    {{Form::hidden('ipdPatientDepartmentId',$ipdPatientDepartment->id,['id'=>'showIpdPatientDepartmentId'])}}
    {{Form::hidden('ipdPatientCaseDate',$ipdPatientDepartment->patientCase->date,['id'=>'showIpdPatientCaseDate'])}}
    {{Form::hidden('doctorUrl',url('doctors'),['id'=>'showIpdDoctorUrl'])}}

    {{Form::hidden('doctors',json_encode($doctorsList),['id'=>'showIpdDoctors'])}}
    {{Form::hidden('uniqueId',2,['id'=>'showIpdUniqueId'])}}
    {{Form::hidden('chargeCategoryUrl',route('charge.category.list'),['id'=>'showIpdChargeCategoryUrl'])}}
    {{Form::hidden('chargeUrl',route('charge.list'),['id'=>'showIpdChargeUrl'])}}
    {{Form::hidden('chargeStandardRateUrl',route('charge.standard.rate'),['id'=>'showIpdChargeStandardRateUrl'])}}

    {{Form::hidden('ipdPrescriptionUrl',route('ipd.prescription.index'),['id'=>'showIpdPrescriptionUrl'])}}
    {{Form::hidden('ipdPrescriptionCreateUrl',route('ipd.prescription.store'),['id'=>'showIpdPrescriptionCreateUrl'])}}

    {{Form::hidden('medicineCategories',json_encode($medicineCategoriesList),['id'=>'showMedicineCategories'])}}
    {{Form::hidden('medicinesListUrl',route('medicine.list'),['id'=>'showMedicinesListUrl'])}}
    {{Form::hidden('ipdTimelineCreateUrl',route('ipd.timelines.store'),['id'=>'showIpdTimelineCreateUrl'])}}

    {{Form::hidden('ipdTimelinesUrl',route('ipd.timelines.index'),['id'=>'showIpdTimelinesUrl'])}}
    {{Form::hidden('ipdPaymentCreateUrl',route('ipd.payments.store'),['id'=>'showIpdPaymentCreateUrl'])}}
    {{Form::hidden('ipdPaymentUrl',route('ipd.payments.index'),['id'=>'showIpdPaymentUrl'])}}

    {{Form::hidden('ipdPaymentModes',json_encode($paymentModes),['id'=>'showIpdPaymentModes'])}}
    {{Form::hidden('ipdBillSaveUrl',route('ipd.bills.store'),['id'=>'showIpdBillSaveUrl'])}}

    {{Form::hidden('downloadDiagnosisDocumentUrl',url('ipd-diagnosis-download'),['id'=>'showIpdDownloadDiagnosisDocumentUrl'])}}
    {{Form::hidden('downloadPaymentDocumentUrl',url('ipd-payment-download'),['id'=>'showIpdDownloadPaymentDocumentUrl'])}}
    {{Form::hidden('downloadTimelineDocumentUrl',url('ipd-timeline-download'),['id'=>'showIpdDownloadTimelineDocumentUrl'])}}
    {{Form::hidden('isEditBill',($ipdPatientDepartment->bill)?1:'',['id'=>'showIsEditBill'])}}
    {{Form::hidden('bootstrapUrl',asset('assets/css/bootstrap.min.css'),['id'=>'showIpdBootstrapUrl'])}}
    {{Form::hidden('billStatus',$ipdPatientDepartment->bill_status,['id'=>'showIpdBillStatus'])}}
    {{Form::hidden('ipdActionVisible',($ipdPatientDepartment->bill_status) ? false : true,['id'=>'showIpdActionVisible'])}}

    {{Form::hidden('ipd_diagnosis',__('messages.ipd_diagnosis'),['id'=>'ipdDiagnosisDelete'])}}
    {{Form::hidden('ipd_consultant_register',__('messages.ipd_consultant_register'),['id'=>'ipdConsultantRegister'])}}
    {{Form::hidden('ipd_charge',__('messages.ipd_charges'),['id'=>'ipdCharge'])}}
    {{Form::hidden('ipd_prescription',__('messages.ipd_prescription'),['id'=>'ipdPrescription'])}}
    {{Form::hidden('ipd_timeline',__('messages.ipd_timelines'),['id'=>'ipdTimeline'])}}
    {{Form::hidden('ipd_payment',__('messages.ipd_payment'),['id'=>'ipdPaymentButton'])}}
    {{ Form::hidden('deleteVariable', __('messages.common.delete'), ['class' => 'deleteVariable']) }}
    {{ Form::hidden('yesVariable', __('messages.common.yes'), ['class' => 'yesVariable']) }}
    {{ Form::hidden('noVariable', __('messages.common.no'), ['class' => 'noVariable']) }}
    {{ Form::hidden('cancelVariable', __('messages.common.cancel'), ['class' => 'cancelVariable']) }}
    {{ Form::hidden('confirmVariable', __('messages.common.are_you_sure_want_to_delete_this'), ['class' => 'confirmVariable']) }}
    {{ Form::hidden('deletedVariable', __('messages.common.deleted'), ['class' => 'deletedVariable']) }}
    {{ Form::hidden('hasBeenDeletedVariable', __('messages.common.has_been_deleted'), ['class' => 'hasBeenDeletedVariable']) }}


    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            @include('ipd_patient_departments.show_fields')
            @include('ipd_diagnoses.add_modal')
            @include('ipd_diagnoses.edit_modal')
            @include('ipd_consultant_registers.add_modal')
            @include('ipd_consultant_registers.edit_modal')
            @include('ipd_charges.add_modal')
            @include('ipd_charges.edit_modal')
            @include('ipd_prescriptions.add_modal')
            @include('ipd_prescriptions.edit_modal')
            @include('ipd_prescriptions.show_modal')
            @include('ipd_timelines.add_modal')
            @include('ipd_timelines.edit_modal')
            @include('ipd_diagnoses.templates.templates')
            @include('ipd_consultant_registers.templates.templates')
            @include('ipd_charges.templates.templates')
            @include('ipd_prescriptions.templates.templates')
            @include('ipd_payments.add_modal')
            @include('ipd_payments.edit_modal')
            @include('ipd_payments.templates.templates')
        </div>
    </div>
@endsection
@section('page_scripts')
    {{--    <script src="{{ asset('assets/js/moment.min.js') }}"></script>--}}
@endsection
@section('scripts')
    <script>
       
        $('#IPDtab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        // store the currently selected tab in the hash value
        $('ul.nav-tabs > li > a').on('shown.bs.tab', function (e) {
            var id = $(e.target).attr('href').substr(1)
            window.location.hash = id
        })
        // on load of the page: switch to the currently selected tab
        // var hash = window.location.hash;
        // $('#IPDtab a[href="' + hash + '"]').tab('show');
    </script>
    {{--  assets/js/ipd_diagnosis/ipd_diagnosis.js --}}
    {{--  assets/js/ipd_consultant_register/ipd_consultant_register.js --}}
    {{--  assets/js/ipd_charges/ipd_charges.js --}}
    {{--  assets/js/ipd_prescriptions/ipd_prescriptions.js' --}}
    {{--  assets/js/ipd_timelines/ipd_timelines.js --}}
    {{--  assets/js/custom/new-edit-modal-form.js --}}
    {{--  assets/js/ipd_payments/ipd_payments.js --}}
    {{--  assets/js/ipd_bills/ipd_bills.js --}}
@endsection
