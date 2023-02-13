<div class="card-toolbar">
    <div class="d-flex align-items-center py-1">
        @if(Auth::user()->hasRole('Case Manager'))
            <div class="dropdown">
                <a href="javascript:void(0)" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a href="{{ route('ambulance-calls.create') }}"
                           class="dropdown-item  px-5">{{ __('messages.ambulance_call.new_ambulance_call') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('ambulance.calls.excel') }}"
                           class="dropdown-item  px-5">{{ __('messages.common.export_to_excel') }}</a>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('ambulance-calls.create') }}"
               class="btn btn-primary"> {{ __('messages.ambulance_call.new_ambulance_call') }}</a>
        @endif
    </div>
</div>
