<div class="d-flex align-items-center mt-2">
    <label class="form-check form-switch form-switch-sm">
        <input name="status" data-id="{{$row->id}}" class="form-check-input patientStatus" type="checkbox"
               value="1" {{$row->patientUser->status == 0 ? '' : 'checked'}} >
        <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
    </label>    
</div>

