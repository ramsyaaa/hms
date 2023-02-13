<div class="d-flex align-items-center mt-3">
    <div class="badge bg-light-info">
        {{ \Carbon\Carbon::parse($row->date)->isoFormat('Do MMMM YYYY')}}
    </div>    
</div>

