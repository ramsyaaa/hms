@if ($row->date === null)
N/A
@else
    <div class="badge bg-light-info">
    <div>{{ \Carbon\Carbon::parse($row->date)->isoFormat('Do MMMM YYYY')}}

    </div>
</div>
    @endif
