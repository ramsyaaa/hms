@if ($row->appointment_date === null)
    N/A
@endif
<div class="badge bg-light-info">
    <div class="mb-2">{{ \Carbon\Carbon::parse($row->appointment_date)->format('h:i A')}}
    </div>
    <div>
        {{ \Carbon\Carbon::parse($row->appointment_date)->isoFormat('Do MMMM YYYY')}}
    </div>
</div>
