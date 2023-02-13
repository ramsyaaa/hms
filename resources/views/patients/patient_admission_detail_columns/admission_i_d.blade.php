<div class="d-flex align-items-center mt-3">
@if(Auth::user()->hasRole('Admin|Doctor|Case Manager'))
    <a href="{{ url('patient-admissions',$row->id) }}"><span
                class="badge bg-light-info">{{ $row->patient_admission_id }}</span></a>
@else
    <span class="badge bg-light-info">{{ $row->patient_admission_id }}</span>
@endif
</div>
