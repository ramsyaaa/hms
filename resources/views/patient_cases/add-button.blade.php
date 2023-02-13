@if(Auth::user()->hasRole('Receptionist|Case Manager'))
    <div class="dropdown">
        <a href="javascript:void(0)" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
            <i class="fa fa-chevron-down"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
                <a href="{{ route('patient-cases.create') }}"
                   class="dropdown-item  px-5">{{ __('messages.case.new_case') }}</a>
            </li>
            <li>
                <a href="{{ route('patient.cases.excel') }}"
                   class="dropdown-item  px-5" target="_blank">{{ __('messages.common.export_to_excel') }}</a>
            </li>
        </ul>
    </div>
@else
    <a href="{{ route('patient-cases.create') }}"
       class="btn btn-primary">{{ __('messages.case.new_case') }}</a>
@endif
