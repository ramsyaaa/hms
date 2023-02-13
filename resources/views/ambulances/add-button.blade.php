<div class="dropdown">
    <a href="#" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
        <i class="fas fa-chevron-down"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li>
            <a href="{{ route('ambulances.create') }}"
               class="dropdown-item  px-5">{{ __('messages.ambulance.new_ambulance') }}</a>
        </li>
        <li>
            <a href="{{ route('ambulance.excel') }}" data-turbo="false"
               class="dropdown-item  px-5">{{ __('messages.common.export_to_excel') }}</a>
        </li>
    </ul>
</div>
