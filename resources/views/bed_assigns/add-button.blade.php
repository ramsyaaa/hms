<div class="dropdown d-flex align-items-center me-4 me-md-5">
    <button class="btn btn-primary" type="button"
            id="dropdownMenuButton1"
            data-bs-toggle="dropdown" aria-expanded="false">
        {{ __('messages.common.actions') }}
        <i class="fas fa-chevron-down"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <ul>
            <li>
                <a href="{{ route('bed-status') }}" class="dropdown-item">
                    {{ __('messages.bed_status.bed_status') }}
                </a>
            </li>
            <li>
                <a href="{{ route('bed-assigns.create') }}"
                   class="dropdown-item">{{ __('messages.bed_assign.new_bed_assign') }}</a>
            </li>
        </ul>
    </div>
</div>
