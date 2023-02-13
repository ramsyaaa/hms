<div class="d-flex align-items-center mt-2">
    <span class="badge bg-light-info">{{getLoggedinPatient()  ?  $row->visits  : count($row->patient->opd)}}</span>    
</div>


