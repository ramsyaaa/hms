<div class="d-flex align-items-center mt-2">
    @if ($row->user->dob === null)
        N/A
    @else
        {{ \Carbon\Carbon::parse($row->user->dob )->translatedFormat('jS M,Y')}}
    @endif    
</div>

