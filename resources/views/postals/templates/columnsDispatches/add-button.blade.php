<div class="dropdown">
    <a href="#" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        {{ __('messages.common.actions') }}
        <i class="fas fa-chevron-down"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li>
            <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#add_postal_dispatch_modal" class="dropdown-item px-5">
                {{ __('messages.postal.new_dispatch') }}
            </a>
        </li>
        <li>
{{--            <a href="{{ route('dispatches.excel') }}" data-turbo="false" class="dropdown-item  px-5">--}}
            <a href="{{ route('dispatches.excel') }}" target="_blank" class="dropdown-item  px-5">
                {{ __('messages.common.export_to_excel') }}
            </a>
        </li>
    </ul>
</div>
