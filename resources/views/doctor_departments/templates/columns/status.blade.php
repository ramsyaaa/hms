<span
    class="badge bg-light-{{($row->doctorUser->status == 1) ? 'success' : 'danger'}}">{{ ($row->doctorUser->status) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
