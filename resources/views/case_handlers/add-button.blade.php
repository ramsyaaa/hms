<div class="dropdown">
    <a href="#" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
        <i class="fas fa-chevron-down"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li>
            <a href="{{ route('case-handlers.create') }}"
               class="dropdown-item  px-5">{{ __('messages.case_handler.new_case_handler') }}</a>
        </li>
        <li>
            <a href="{{ route('case.handler.excel') }}"
               class="dropdown-item  px-5" data-turbo="false">{{ __('messages.common.export_to_excel') }}</a>
        </li>
    </ul>
</div>
