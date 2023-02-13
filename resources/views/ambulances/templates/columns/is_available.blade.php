<?php $checked = $row->is_available == 0 ? '' : 'checked';?>

<label class="form-check form-switch form-switch-sm">
    <input name="status" data-id="{{$row->id}}" class="form-check-input ambulance-status" type="checkbox" value="1" {{$checked}} >
    <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
</label>
