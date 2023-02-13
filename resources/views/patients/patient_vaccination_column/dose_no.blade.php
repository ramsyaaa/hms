@if(!empty($row->dose_number))
    <span class="badge bg-light-info fs-7">{{$row->dose_number}}</span>
@else
    <span class="badge bg-light-danger fs-7">{{ __('messages.common.n/a')}}</span>
@endif
