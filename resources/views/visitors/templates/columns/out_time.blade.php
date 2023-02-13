@if ($row->out_time === null)
    {{ __('messages.common.n/a') }}
@else
    {{$row->out_time}}
@endif
