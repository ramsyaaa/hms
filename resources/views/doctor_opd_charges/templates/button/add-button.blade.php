@if(Auth::user()->hasRole('Receptionist'))
    <div class="dropdown">
        <a href="javascript:void(0)" class="btn btn-primary dropdown-toggl" id="dropdownMenuButton" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
            <i class="fa fa-chevron-down"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
                <a href="javascript:void(0)"
                   class="dropdown-item  px-5" data-bs-toggle="modal"
                   data-bs-target="#add_doctor_opd_charges_modal">{{ __('messages.doctor_opd_charge.new_doctor_opd_charge') }}</a>
            </li>
            <li>
                <a href="{{ route('doctor.opd.charges.excel') }}"
                   class="dropdown-item  px-5" data-turbo="false">{{ __('messages.common.export_to_excel') }}</a>
            </li>
        </ul>
    </div>
@else
    <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal"
       data-bs-target="#add_doctor_opd_charges_modal">{{ __('messages.doctor_opd_charge.new_doctor_opd_charge') }}</a>
@endif
