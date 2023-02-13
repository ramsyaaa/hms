<div class="d-flex align-items-center mt-2">
    @if(getLoggedinPatient())
        <a href="{{ url('employee/patient-admissions') . '/' .  $row->id }}"
           class="show-btn badge bg-light-info text-decoration-none">{{ $row->patient_admission_id  }}</a>
    @else
        <a href="javascript:void(0)" class="show-patient-admission-btn badge bg-light-info text-decoration-none"
           data-id="{{ $row->id }}">{{ $row->patient_admission_id  }}</a>
    @endif    
</div>

