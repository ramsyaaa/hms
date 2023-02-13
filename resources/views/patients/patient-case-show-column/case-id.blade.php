@if(!Auth::user()->hasRole('Patient|Nurse|Case Manager|Accountant'))
    <a href="{{ url('patient-cases', $row->id) }}"><span
                class="badge bg-light-info">{{ $row->case_id}}</span></a>
@else
    <span class="badge bg-light-info fs-7">{{ $row->case_id}}</span>
@endif
