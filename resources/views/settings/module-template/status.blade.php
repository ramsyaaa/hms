<?php $checked = $row->is_active == 0 ? '' : 'checked' ?>
<div class="d-flex justify-content-center p-3">
    <label class="form-check form-switch cursor-pointer">
        <input name="status" data-id="{{$row->id}}" class="form-check-input settingStatus cursor-pointer"
               type="checkbox"
               value="1" {{$checked}}>
        <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
    </label>    
</div>

