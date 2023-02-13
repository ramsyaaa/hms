@if(!empty($row->vaccination_serial_number))
    <span class="badge bg-light-info fs-7">{{$row->vaccination_serial_number}}</span>
@else
    <span class="badge bg-light-danger fs-7">{{ __('messages.common.n/a')}}</span>
@endif
