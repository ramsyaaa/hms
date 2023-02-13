@if (getLoggedInUser()->hasRole('Pharmacist'))
    <a data-turbo="false" href="{{ route('employee.prescriptions.excel') }}"
       class="btn btn-primary">{{ __('messages.common.export_to_excel') }}</a>
@endif
