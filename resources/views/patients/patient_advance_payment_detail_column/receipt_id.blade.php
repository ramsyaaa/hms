@if(!Auth::user()->hasRole('Patient|Nurse|Case Manager|Accountant|Doctor|Receptionist'))
    <a href="{{url('advanced-payments', $row->id)}}"><span
                class="badge bg-light-info">{{ $row->receipt_no }}</span></a>
@else
    <span
            class="badge bg-light-info">{{ $row->receipt_no }}</span>
@endif
