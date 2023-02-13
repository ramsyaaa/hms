<div class="badge bg-light-info">
    <div class="mb-2">{{ \Carbon\Carbon::parse($row->report_date)->format('g:i A') }}</div>
    <div>{{ \Carbon\Carbon::parse($row->report_date)->translatedFormat('jS M, Y') }}</div>
</div>
