@if($row->reference_no == null)
    N/A
@else
    <span class="badge bg-light-info fs-7">{{$row->reference_no}}</span>
@endif
