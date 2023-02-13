<div class="mt-2">
    @if (empty($row->insurance_id))
        {{ __('messages.common.n/a') }}
    @else
        <a href="{{ url('insurances').'/'.$row->insurance->id }}" class="text-decoration-none">{{ $row->insurance->name }}</a>
    @endif    
</div>

