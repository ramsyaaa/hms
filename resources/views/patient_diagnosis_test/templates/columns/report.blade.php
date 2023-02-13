<div class="d-flex align-items-center mt-2">
    @if(Auth::user()->hasRole('Patient'))
        <a href="{{ url('employee/patient-diagnosis-test'.'/'.$row->id) }}"
           class="badge bg-light-info text-decoration-none">{{$row->report_number}}</a>
    @else
        <a href="{{ url('patient-diagnosis-test'.'/'.$row->id) }}"
           class="badge bg-light-info text-decoration-none">{{$row->report_number}}</a>
    @endif
</div>
