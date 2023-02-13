<div class="badge bg-light-info mt-1">
    <div class="mb-2">{{ \Carbon\Carbon::parse($row->admission_date)->format('g:i A') }}</div>
    <div>{{ \Carbon\Carbon::parse($row->admission_date)->format('jS M, Y') }}</div>
</div>
