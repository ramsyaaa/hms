@if ($row->instruction_date === null)
    {{ __('messages.common.n/a') }}
@else
    {{ \Carbon\Carbon::parse($row->instruction_date)->isoFormat('Do MMM, YYYY')}}
@endif
