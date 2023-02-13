<div class="d-flex align-items-center mt-2">
    <?php $checked = $row->status == 0 ? '' : 'checked'; ?>
{{--    @if ($row->department->name != 'Admin')--}}
        <label class="form-check form-switch d-flex justify-content-start cursor-pointer">
            <input name="status" data-id="{{$row->id}}" class="form-check-input user-status cursor-pointer"
                   type="checkbox"
                   value="1" {{$checked}}>
            <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
        </label>
{{--    @else--}}
{{--        N/A--}}
{{--    @endif    --}}
</div>

