<div class="dropdown">
    @if(getLoggedInUser()->hasRole('Doctor'))
    <a href="#" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
        <i class="fa fa-chevron-down"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li>
            <a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal"
               data-bs-target="#add_consulatation_modal">{{ __('messages.live_consultation.new_live_consultation') }}</a>
        </li>
        <li>
            <a href="javascript:void(0)"
               class="dropdown-item add-credential">{{ __('messages.live_consultation.add_credential') }}</a>
        </li>
    </ul>
    @elseif(!Auth::user()->hasRole('Patient'))
        <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal"
           data-bs-target="#add_consulatation_modal">{{__('messages.live_consultation.new_live_consultation')}}</a>
    @endif
</div>
