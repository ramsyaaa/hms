<div class="mt-2">
    @if (empty($row->package_id))
        {{ __('messages.common.n/a') }}
    @else
        <a href="{{ url('packages').'/'.$row->package->id }}" class="text-decoration-none">{{ $row->package->name }}</a>
    @endif    
</div>

