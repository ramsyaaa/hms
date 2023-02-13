@if(Auth::user()->hasRole('Lab Technician'))
    <div class="dropdown">
        <a href="javascript:void(0)" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
            <i class="fa fa-chevron-down"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
                <a href="{{ route('pathology.test.create') }}"
                   class="dropdown-item  px-5">{{ __('messages.pathology_test.new_pathology_test') }}</a>
            </li>
            <li>
                <a href="{{ route('pathology.tests.excel') }}"
                   data-turbo="false" class="dropdown-item  px-5">{{ __('messages.common.export_to_excel') }}</a>
            </li>
        </ul>
    </div>
@else
    <a href="{{ route('pathology.test.create') }}"
       class="btn btn-primary">{{ __('messages.pathology_test.new_pathology_test') }}</a>
@endif
