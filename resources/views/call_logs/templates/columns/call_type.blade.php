<div class="d-flex align-items-center mt-2">
    @if ($row->call_type == App\Models\CallLog::INCOMING)
        <span class="badge bg-light-info fs-7">{{ __('messages.call_log.incoming') }}</span>
    @else
        <span class="badge bg-light-primary fs-7">{{ __('messages.call_log.outgoing') }}</span>
    @endif    
</div>

