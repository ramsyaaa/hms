@if($row->charge_type == 4)
    <span class="badge bg-light-primary">Procedures</span>
@elseif($row->charge_type == 1)
    <span class="badge bg-light-info">Investigations</span>
@elseif($row->charge_type == 5)
    <span class="badge bg-light-success">Supplier</span>
@elseif($row->charge_type == 2)
    <span class="badge bg-light-danger">Operation Theatre</span>
@elseif($row->charge_type == 3)
    <span class="badge bg-light-warning">Others</span>
@endif

