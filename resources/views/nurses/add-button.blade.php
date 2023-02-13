<div class="dropdown">
    <a href="#" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
        <i class="fas fa-chevron-down"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li>
            <a href="{{ route('nurses.create') }}"
               class="dropdown-item  px-5">{{ __('messages.nurse.new_nurse') }}</a>
        </li>
        <li>
            <a href="{{ route('nurses.excel') }}" data-turbo="false"
               class="dropdown-item  px-5">{{ __('messages.common.export_to_excel') }}</a>
        </li>
    </ul>
</div>
