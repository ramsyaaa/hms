@extends('layouts.app')
@section('title')
    {{ __('messages.prescription.edit_prescription') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('prescriptions.index') }}"
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
            {{ Form::hidden('createMedicineFromPrescriptionPost', route('prescription.medicine.store'), ['id' => 'createMedicineFromPrescriptionPost']) }}
            {{Form::hidden('uniqueId',2,['class'=>'prescriptionUniqueId'])}}
            {{Form::hidden('associateMedicines',json_encode($medicineList),['class'=>'associatePrescriptionMedicines'])}}
            {{Form::hidden('associateMeals',json_encode($mealList),['class'=>'associatePrescriptionMeals'])}}
            {{ Form::model($prescription, ['route' => ['prescriptions.update', $prescription->id], 'method' => 'patch', 'id' => 'editPrescription']) }}
            @csrf
            <div class="card">
                <div class="card-body">
                    @include('prescriptions.edit_fields')
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">
                    <h3>{{ __('messages.prescription.physical_information') }}</h3>
                </div>
                <div class="card-body">
                    @include('prescriptions.edit-physical-info-fields')
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">
                    <h3>{{ __('messages.medicines') }}</h3>
                    <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_new_medicine">
                        {{__('messages.prescription.new_medicine')}}
                    </a>
                </div>
                <div class="card-body">
                    @include('prescriptions.medical-table')
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-body">
                    @include('prescriptions.edit-other-fields')
                </div>
            </div>
            {{ Form::close() }}
            @include('prescriptions.add_new_medicine')
            @include('prescriptions.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
{{--  assets/js/prescriptions/create-edit.js --}}
@endsection
