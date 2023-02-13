@if ($row->charge_type_id === 4)
Procedures
@elseif ($row->charge_type_id  === 1)
Investigations
@elseif ($row->charge_type_id  === 5)
Supplier
@elseif ($row->charge_type_id === 2)
Operation Theatre
@else
Others
@endif
