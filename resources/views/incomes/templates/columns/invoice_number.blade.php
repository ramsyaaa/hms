<div class="d-flex align-items-center mt-3">
    @if($row->invoice_number)
        <span class="badge bg-light-info text-decoration-none">{{$row->invoice_number}}</span>
    @else
        <span class="badge bg-light-info text-decoration-none">N/A</span>
    @endif

</div>
