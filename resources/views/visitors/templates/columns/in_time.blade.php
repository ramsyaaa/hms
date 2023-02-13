@if ($row->in_time === null)
    {{ __('messages.common.n/a') }}
@else
    {{ $row->in_time}}
@endif
