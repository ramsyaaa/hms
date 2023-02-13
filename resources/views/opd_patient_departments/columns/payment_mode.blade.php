<div class="d-flex align-items-center mt-2">
    @if ($row->payment_mode == 1)
        <span class="badge bg-light-primary">{{ $row->payment_mode_name }}</span>
    @elseif ($row->payment_mode == 2)
        <span class="badge bg-light-success">{{ $row->payment_mode_name }}</span>
    @endif    
</div>

