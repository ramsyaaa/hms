<div class="d-flex align-items-center mt-2">
    <label class="form-check form-switch form-switch-sm">
        <input name="status" data-id="{{ $row->id}}" class="form-check-input technicianStatus" type="checkbox"
               value="1" {{ $row->user->status ? 'checked' : ''}} >
        <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
    </label>    
</div>

