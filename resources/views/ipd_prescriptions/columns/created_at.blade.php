@if ($row->created_at === null)
    N/A
@else
    <div class="badge bg-light-info">
        <div>
            {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('jS M,Y')}}
        </div>
    </div>
@endif
