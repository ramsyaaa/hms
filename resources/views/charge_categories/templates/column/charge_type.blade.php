@if($row->charge_type == 1)
    <span class="badge bg-light-primary">Investigations</span>
@elseif($row->charge_type == 2)
    <span class="badge bg-light-info">Operation Theatre</span>
@elseif($row->charge_type == 3)
    <span class="badge bg-light-success">Others</span>
@elseif($row->charge_type == 4)
    <span class="badge bg-light-danger">Procedures</span>
@else
    <span class="badge bg-light-warning">Supplier</span>
@endif 
