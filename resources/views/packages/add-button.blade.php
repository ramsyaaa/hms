<div class="card-toolbar">
    <div class="d-flex align-items-center py-1">
        @if(Auth::user()->hasRole('Receptionist'))
            <div class="dropdown">
                <a href="javascript:void(0)" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
                    <i class="fa fa-chevron-down"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a href="{{ route('packages.create') }}"
                           class="dropdown-item  px-5">{{ __('messages.package.new_package') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('packages.excel') }}"
                           class="dropdown-item  px-5">{{ __('messages.common.export_to_excel') }}</a>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('packages.create') }}"
               class="btn btn-primary">{{ __('messages.package.new_package') }}</a>
        @endif
    </div>
</div>
