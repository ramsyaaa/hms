<div class="dropdown">
    <a href="#" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
        <i class="fas fa-chevron-down"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li>
            <a href="{{ route('pharmacists.create') }}"
               class="dropdown-item  px-5">{{ __('messages.pharmacist.new_pharmacist') }}</a>
        </li>
        <li>
            <a href="{{ route('pharmacists.excel') }}"
               data-turbo="false" class="dropdown-item  px-5">{{ __('messages.common.export_to_excel') }}</a>
        </li>
    </ul>
</div>

