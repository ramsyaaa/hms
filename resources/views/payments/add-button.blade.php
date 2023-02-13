<div class="dropdown">
    <a href="#" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="true">
        {{ __('messages.common.actions') }}
        <i class="fas fa-chevron-down"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li>
            <a href="{{ route('payments.create') }}"
               class="dropdown-item text-left">{{ __('messages.payment.new_payment') }}</a>
        </li>
        <li>
            <a href="{{ route('payments.excel') }}"
               class="dropdown-item text-left" data-turbo="false">{{ __('messages.common.export_to_excel') }}</a>
        </li>
    </ul>
</div>
