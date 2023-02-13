<div class="dropdown">
    @if(Auth::user()->hasRole('Pharmacist'))
        <a href="#" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
            <i class="fa fa-chevron-down"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
                <a href="{{ route('brands.create') }}"
                   class="dropdown-item  px-5">{{ __('messages.medicine.new_medicine_brand') }}</a>
            </li>
            <li>
                <a href="{{ route('brands.excel') }}" data-turbo="false"
                   class="dropdown-item  px-5">{{ __('messages.common.export_to_excel') }}</a>
            </li>
        </ul>
    @else
        <a href="{{ route('brands.create') }}"
           class="btn btn-primary">{{ __('messages.medicine.new_medicine_brand') }}</a>
    @endif
</div>
