@if(empty($row->description))
    {{ __('messages.common.n/a') }}
@else
    @if(strlen($row->description) >= 50)
        {{ substr($row->description, 0, 50). '...' }}
    @else
        {{ $row->description}}
    @endif
@endif
