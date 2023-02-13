@if ($row->applied_date === null)
    {{ __('messages.common.n/a') }}
@else
    {{ \Carbon\Carbon::parse($row->applied_date)->isoFormat('Do MMM, YYYY')}}  {{ \Carbon\Carbon::parse($row->applied_date)->format('h:i A')}}
@endif
