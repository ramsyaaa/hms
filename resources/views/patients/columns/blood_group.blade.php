<div class="d-flex align-items-center mt-2">
    @if(empty($row->user->blood_group))
        N/A
    @else
        <span class="badge bg-light-success">{{ $row->user->blood_group }}</span>
    @endif    
</div>

