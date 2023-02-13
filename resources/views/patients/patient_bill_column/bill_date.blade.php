<div class="badge bg-light-info">
    <div class="mb-2">{{ \Carbon\Carbon::parse($row->bill_date)->format('g:i A') }}</div>
    <div>{{ \Carbon\Carbon::parse($row->bill_date)->translatedFormat('jS M, Y') }}</div>
</div>
