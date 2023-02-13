<div class="d-flex align-items-center mt-2">
    @if(getLoggedinPatient())
        @if($row->status)
            <span
                    class="badge bg-light-success">{{__('messages.common.active')}}</span>
        @else
            <span
                    class="badge bg-light-danger">{{ __('messages.common.de_active') }}</span>
        @endif
    @else
        <label class="form-check form-switch form-switch-sm">
            <input name="status" data-id="{{$row->id}}" class="form-check-input patientCaseStatus" type="checkbox"
                   value="1" {{ $row->status == 0 ? '' : 'checked'}} >
            <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
        </label>
    @endif    
</div>

