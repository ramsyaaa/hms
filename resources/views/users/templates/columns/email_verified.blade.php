<div class="d-flex align-items-center mt-2">
    @php
        $checked = $row->email_verified_at == null
         ? ''
         : 'checked disabled'
    @endphp
{{--    @if ($row->department->name != 'Admin')--}}
        <label class="form-check form-switch d-flex justify-content-start cursor-pointer">
            <input name="status" data-id="{{$row->id}}" class="form-check-input is-user-verified cursor-pointer"
                   type="checkbox"
                   value="1" {{$checked}}>
            <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
        </label>
{{--    @else--}}
{{--        N/A--}}
{{--    @endif    --}}
</div>

