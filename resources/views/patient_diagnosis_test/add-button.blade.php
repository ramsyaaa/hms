<div class="d-flex align-items-center py-1">
    @if(Auth::user()->hasRole('Receptionist|Lab Technician'))
        <div class="dropdown">
            <a href="javascript:void(0)" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
                <i class="fa fa-chevron-down"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                    <a href="{{ route('patient.diagnosis.test.create') }}"
                       class="dropdown-item  px-5">{{ __('messages.patient_diagnosis_test.new_patient_diagnosis_test') }}</a>
                </li>
                <li>
                    <a href="{{ route('patient.diagnosis.test.excel') }}"
                       class="dropdown-item  px-5" data-turbo="false">{{ __('messages.common.export_to_excel') }}</a>
                </li>
            </ul>
        </div>
    @else
        <a href="{{ route('patient.diagnosis.test.create') }}"
           class="btn btn-primary">{{ __('messages.patient_diagnosis_test.new_patient_diagnosis_test') }}</a>
    @endif
</div>
