<div class="d-flex align-items-center mt-2">
    <a href="{{ getLoggedinPatient() ? url('employee/bills'). '/'. $row->id : route('bills.show',$row->id)  }}"
       class="badge bg-light-info  text-decoration-none">{{ $row->bill_id }} </a>    
</div>

