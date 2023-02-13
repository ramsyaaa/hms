@if($row->user->dob )
    {{ \Carbon\Carbon::parse($row->user->dob)->isoFormat('Do MMM, Y')}}
@else
    {{ __('messages.common.n/a')}}
@endif
