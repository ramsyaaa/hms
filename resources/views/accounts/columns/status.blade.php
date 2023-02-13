<div class="d-flex align-items-center mt-3">
    <label class="form-check form-switch form-switch-sm">
        <input name="is-active" data-id="{{$row->id}}" class="form-check-input account-status" type="checkbox" value="1" {{$row->status == 0 ? '' : 'checked'}} >
        <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
    </label>    
</div>

