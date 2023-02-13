<span
        class="badge bg-light-{{($row->patient->patientUser->status == 1) ? 'success' : 'danger'}}">{{ (!empty($row->patient->patientUser->status)) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
