<div class="d-flex align-items-center mt-2">
    @if ($row->remained_bags <= 0)
        <span class="badge bg-light-danger">{{ $row->blood_group }}</span>
    @else
        <span class="badge bg-light-success">{{ $row->blood_group }}</span>
    @endif    
</div>

