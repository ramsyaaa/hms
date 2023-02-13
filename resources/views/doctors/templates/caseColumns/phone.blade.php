@if($row->phone !== null)
    {{$row->phone}}
@else
    {{ __('messages.common.n/a')}}
@endif
