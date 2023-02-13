@extends('layouts.app')
@section('title')
    {{ __('messages.bed_assign.new_bed_assign') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('bed-assigns.index') }}"
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
                    {{ Form::open(['route' => 'bed-assigns.store','id' => 'createBedAssign']) }}
                    {{ Form::hidden('ipd_patient_list_url', route('ipd.patient.list'), ['id' => 'ipdPatientListUrl']) }}
                    {{ Form::hidden('isEdit', false, ['class' => 'isEdit']) }}
                    @include('bed_assigns.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let isEdit = false;
    </script>
    {{--   assets/js/bed_assign/create-edit.js --}}
@endsection
