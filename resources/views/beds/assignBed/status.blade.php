<span
        class="badge bg-light-{{!empty($row->status) ? 'success' : 'danger'}}">{{ ($row->status) ? __('messages.bed_assign.assigned') : __('messages.bed_assign.not_assigned') }}</span>
