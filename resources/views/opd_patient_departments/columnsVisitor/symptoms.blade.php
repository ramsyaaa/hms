@if($row->symptoms)
    {{$row->symptoms}}
@else
    {{__('messages.common.n/a')}}
@endif
