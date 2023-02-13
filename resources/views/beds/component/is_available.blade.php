<div class="mt-3">
    @if($row->is_available)
        <span class="badge bg-light-info">{{ __('messages.common.yes') }}</span>
    @else
        <span class="badge bg-light-danger">{{ __('messages.common.no') }}</span>
    @endif    
</div>

    
