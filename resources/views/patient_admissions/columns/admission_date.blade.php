@if ($row->admission_date === null)
    N/A
@endif
<div class="badge bg-light-info">
    <div class="mb-2">{{ \Carbon\Carbon::parse($row->admission_date)->format('h:i A')}}
    </div>
    <div>
        {{ \Carbon\Carbon::parse($row->admission_date)->isoFormat('Do MMM, YYYY')}}
    </div>
</div>
