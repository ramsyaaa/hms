@if($row->doctorUser->phone !== null)
    {{$row->doctorUser->phone}}
@else
    {{ __('messages.common.n/a')}}
@endif
