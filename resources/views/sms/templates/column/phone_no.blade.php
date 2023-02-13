<div class="d-flex align-items-center mt-2">
    {{ empty($row->region_code) ? $row->phone_number:'+'.$row->region_code.$row->phone_number}}    
</div>

