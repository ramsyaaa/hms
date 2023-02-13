
<span
        class="badge bg-light-{{($row->status == 1) ? 'success' : 'danger'}}">{{ ($row->status) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
