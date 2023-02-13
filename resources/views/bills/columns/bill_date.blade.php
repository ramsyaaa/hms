@if ($row->bill_date === null) {
N/A
@else
    <div class="badge bg-light-info">
        <div class="mb-2">{{ \Carbon\Carbon::parse($row->bill_date)->format('h:i A')}}
            <div class="mt-2">
                {{ \Carbon\Carbon::parse($row->bill_date)->isoFormat('Do MMMM YYYY')}}
            </div>
        </div>
@endif
