@extends('layouts.app')
@section('title')
    {{ __('messages.opd_patient.opd_patient_details') }}
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
                {{Form::hidden('visitedOPDPatients',route('patient.opd'),['id'=>'showVisitedOPDPatientsList'])}}
                {{Form::hidden('patient_id',$opdPatientDepartment->patient_id,['id'=>'showVisitedOPDPatientsListshowVisitedOPDPatientsListshowVisitedOPDPatientsList'])}}
                {{Form::hidden('opdPatientDepartmentId',$opdPatientDepartment->id,['id'=>'showOpdListPatientDepartmentId'])}}
                {{Form::hidden('defaultDocumentImageUrl',asset('assets/img/default_image.jpg'),['id'=>'showOpdListDefaultDocumentImageUrl'])}}
                {{Form::hidden('opdDiagnosisUrl',route('opd.diagnosis.index'),['id'=>'showOpdListDiagnosisUrl'])}}
                {{Form::hidden('opdTimelinesUrl',route('opd.timelines.index'),['id'=>'showOpdListTimelinesUrl'])}}
                {{Form::hidden('downloadDiagnosisDocumentUrl',url('opd-diagnosis-download'),['id'=>'showOpdListDownloadDiagnosisDocUrl'])}}
                {{Form::hidden('downloadTimelineDocumentUrl',url('opd-timeline-download'),['id'=>'showOpdListDownloadTimelineDocUrl'])}}
                {{Form::hidden('downloadPaymentDocumentUrl',url('opdPayment-download'),['id'=>'showOpdListDownloadPaymentDocUrl'])}}
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
                @include('opd_patient_list.show_fields')
        </div>
    </div>
@endsection
@section('page_scripts')
    {{--    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>--}}
@endsection
@section('scripts')
    <script>
        // $('#OPDtab a').click(function (e) {
        //     e.preventDefault();
        //     $(this).tab('show');
        // });
        // store the currently selected tab in the hash value
        $('ul.nav-tabs > li > a').on('shown.bs.tab', function (e) {
            var id = $(e.target).attr('href').substr(1);
            window.location.hash = id;
        });
        // on load of the page: switch to the currently selected tab
        // var hash = window.location.hash;
        // $('#OPDtab a[href="' + hash + '"]').tab('show');

        {{--let visitedOPDPatients = "{{ route('patient.opd') }}";--}}
        {{--let patient_id = "{{ $opdPatientDepartment->patient_id }}";--}}
        {{--let opdPatientDepartmentId = "{{ $opdPatientDepartment->id }}";--}}
        {{--let defaultDocumentImageUrl = "{{ asset('assets/img/default_image.jpg') }}";--}}
        {{--        let opdDiagnosisUrl = "{{route('opd.diagnosis.index')}}";--}}
        {{--        let downloadDiagnosisDocumentUrl = "{{ url('opd-diagnosis-download')}}";--}}
        {{--        let opdTimelinesUrl = "{{route('opd.timelines.index')}}";--}}
        {{--        let downloadTimelineDocumentUrl = "{{ url('opd-timeline-download') }}";--}}
        {{--        let downloadPaymetDocumentUrl = "{{ url('opdPayment-download') }}";--}}
    </script>
    {{--    <script src="{{ mix('assets/js/opd_patients_list/visits.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/opd_patients_list/opd_diagnosis.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/opd_patients_list/opd_timelines.js') }}"></script>--}}
    {{--    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>--}}
@endsection
