@if($row->medical_history)
    {{$row->medical_history}}
@else
    {{__('messages.common.n/a')}}
@endif
