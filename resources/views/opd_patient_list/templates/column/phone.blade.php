@if ($row->patient->patientUser->phone != '')
    <span>{{$row->patient->patientUser->phone}}</span>
@else
    {{__('messages.common.n/a')}}
@endif
