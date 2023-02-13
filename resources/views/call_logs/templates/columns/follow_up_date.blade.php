<div class="d-flex align-items-center mt-2">
    @if ($row->follow_up_date === null)
        N/A
    @else
        <div class="badge bg-light-info">
            <div>
                {{ \Carbon\Carbon::parse($row->follow_up_date)->translatedFormat('jS M,Y')}}
            </div>
        </div>
    @endif    
</div>

