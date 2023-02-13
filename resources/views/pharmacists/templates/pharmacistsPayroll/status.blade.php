<span
        class="badge fs-6 bg-light-{{($row->status == 1 ) ? 'success' : 'danger'}}">{{ ($row->status) ? __('messages.employee_payroll.paid') : __('messages.employee_payroll.not_paid') }}</span>
