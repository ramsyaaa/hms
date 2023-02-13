@if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager'))
@include('layouts.action-component-for-detail', ['id' => $row->id, 'url' => route('appointments.edit', $row->id), 'deleteUrl' => url('appointments'), 'message' => __('messages.web_menu.appointment')])
@endif
