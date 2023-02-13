<div class="d-flex align-items-center mt-2">
    @if ($row->user != null)
        <a href="javascript:void(0)" class="show-sms-btn text-decoration-none" data-id="{{ $row->id }}">{{ $row->user->full_name }}</a>
    @else
        N/A
    @endif    
</div>


