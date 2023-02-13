<div class="d-flex align-items-center mt-2">
    <span class="badge bg-light-info">
        @if ($row->created_at === null)
            'N/A'
        @endif
        {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('jS M,Y')}}
    </span>    
</div>


