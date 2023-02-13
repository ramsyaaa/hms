@if(!empty($row->patient->user->phone))
    {{$row->patient->user->phone}}
@else
    {{ __('messages.common.n/a') }}
@endif
