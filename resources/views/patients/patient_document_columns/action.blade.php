@if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager|Nurse|Receptionist'))
        @if (!empty($row->document_url))
            <a class="btn px-1 text-info fs-3 ps-0"
               href="{{url('document-download',$row->id)}}" target="_blank">
                <i class="fa fa-download" aria-hidden="true"></i>
            </a>
        @endif
        @include('partials.modal.delete_action_component_for_modal', ['id' => $row->id, 'deleteUrl' => route('documents.index'), 'message' => __('messages.document.document')])
@endif
