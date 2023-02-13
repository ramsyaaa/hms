@if($row->description)
    {{$row->description}}
@else
    {{ __('messages.common.n/a')}}
@endif
