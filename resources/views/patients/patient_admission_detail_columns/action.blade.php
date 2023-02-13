<div class="min-w-100px">
@if(!Auth::user()->hasRole('Patient|Accountant|Nurse'))
@include('layouts.action-component-for-detail', ['id' => $row->id, 'url' => route('patient-admissions.edit', $row->id), 'deleteUrl' => url('patient-admissions'), 'message' => __('messages.patient_admission.patient_admission')])
@endif
</div>
