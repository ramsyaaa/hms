@if(Auth::user()->hasRole('Admin'))
    <a href="{{ url('bills',$row->id) }}">
        <span class="badge bg-light-info">{{ $row->patient_admission_id }}</span></a>
@elseif(Auth::user()->hasRole('Patient'))
    <a href="{{ url('employee/bills',$row->id) }}">
        <span class="badge bg-light-info">{{ $row->patient_admission_id }}</span></a>
@elseif(Auth::user()->hasRole('Accountant'))
    <a href="{{ url('bills',$row->id) }}">
        <span class="badge bg-light-info">{{ $row->patient_admission_id }}</span></a>
@else
    <span class="badge bg-light-info">{{ $row->patient_admission_id }}</span>
@endif
