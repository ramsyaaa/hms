<div class="mt-2">
    @if ($row->payment_date === null) {
    N/A
    @else
        <div class="badge bg-light-info">
            <div>{{ \Carbon\Carbon::parse($row->payment_date)->translatedFormat('jS M, Y')}}</div>
        </div>
    @endif    
</div>

