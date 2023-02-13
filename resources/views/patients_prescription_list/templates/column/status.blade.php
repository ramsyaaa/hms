@if ($row->status == 1)
    <span class="badge bg-light-success fs-7">{{ __('messages.common.active')}}</span>
@else
    <span class="badge bg-light-danger fs-7">{{ __('messages.common.de_active')}}</span>
@endif
