@if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Nurse'))
@include('layouts.action-component-for-detail', ['id' => $row->id, 'url' => route('patient-cases.edit', $row->id), 'deleteUrl' => url('patient-cases'), 'message' => __('messages.case.case')])
@endif
