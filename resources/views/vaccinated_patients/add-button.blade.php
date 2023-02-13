<div class="dropdown">
     <a href="#" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
         <i class="fas fa-chevron-down"></i>
     </a>
     <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
         <li>
             <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_vaccinated_patient_modal"
                class="dropdown-item  px-5">{{__('messages.vaccinated_patient.new_vaccinate_patient')}}</a>
         </li>
         <li>
             <a href="{{ route('vaccinated-patients.excel') }}"
                class="dropdown-item  px-5"
                target="_blank">{{ __('messages.common.export_to_excel') }}</a>
         </li>
     </ul>
 </div>
 
