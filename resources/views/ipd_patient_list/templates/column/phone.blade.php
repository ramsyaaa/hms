@if($row->patient->patientUser->phone)
    {{$row->patient->patientUser->phone}}
@else
    {{__('messages.common.n/a')}}
@endif
