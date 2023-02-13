<div class="dropdown">
    @if(Auth::user()->hasRole('Doctor'))
        <a href="#" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
            <i class="fa fa-chevron-down"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @if(count(checkDoctorSchedule()) != 1)
            <li>
                <a href="{{ route('schedules.create') }}"
                   class="dropdown-item  px-5">{{ __('messages.schedule.new') }}</a>
            </li>
            @endif
            <li>
                <a href="{{ route('schedules.excel') }}" data-turbo="false"
                   class="dropdown-item  px-5">{{ __('messages.common.export_to_excel') }}</a>
            </li>
        </ul>
    @else
        <a href="{{ route('schedules.create') }}"
           class="btn btn-primary">{{__('messages.schedule.new')}}</a>
    @endif
</div>
