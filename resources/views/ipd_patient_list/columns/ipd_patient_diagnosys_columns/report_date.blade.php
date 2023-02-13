@if ($row->report_date === null)
    {{ __('messages.common.n/a') }}
@else
    {{ \Carbon\Carbon::parse($row->report_date)->isoFormat('Do MMM, YYYY')}}  {{ \Carbon\Carbon::parse($row->report_date)->format('h:i A')}}
@endif
