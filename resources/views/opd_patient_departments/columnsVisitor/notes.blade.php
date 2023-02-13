@if($row->notes)
    {{$row->notes}}
@else
    {{__('messages.common.n/a')}}
@endif
