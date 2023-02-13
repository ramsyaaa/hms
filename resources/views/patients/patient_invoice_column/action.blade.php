@if(!Auth::user()->hasRole('Patient|Doctor|Case Manager|Nurse|Receptionist'))
@include('layouts.action-component-for-detail', ['id' => $row->id, 'url' => route('invoices.edit', $row->id), 'deleteUrl' => url('invoices'), 'message' => __('messages.invoices')])
@endif
