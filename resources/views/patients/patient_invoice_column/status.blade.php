@if($row->status)
    <span class="badge bg-light-success">{{__('messages.invoice.paid')}}</span>
@else
    <span class="badge bg-light-danger">{{__('messages.invoice.not_paid') }}</span>
@endif
                     
