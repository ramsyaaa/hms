<div class="d-flex justify-content-center mt-2">
    @if ($row->discharge_date === null)
            N/A
    @else
        <div class="badge bg-light-info">
            <div class="mb-2">{{ \Carbon\Carbon::parse($row->discharge_date)->format('h:i A')}}
            </div>
            <div>
                {{ \Carbon\Carbon::parse($row->discharge_date)->isoFormat('Do MMM, YYYY')}}
            </div>
        </div>
    @endif
</div>
