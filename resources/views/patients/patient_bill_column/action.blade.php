@if(!Auth::user()->hasRole('Patient|Doctor|Case Manager|Nurse|Receptionist'))
@include('layouts.action-component-for-detail', ['id' => $row->id, 'url' => route('bills.edit', $row->id), 'deleteUrl' => url('bills'), 'message' => __('messages.bills')])
@endif
