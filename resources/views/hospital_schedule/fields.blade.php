<table class="table table-striped mt-lg-4">
    <tbody>
    @foreach($weekDay as $day => $shortWeekDay) 
        @php($isValid = $hospitalSchedules->where('day_of_week',$day)->count() != 0)
    <tr>
        <td style="width: 1%;" class="py-1">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="chkShortWeekDay_{{$shortWeekDay}}" value="{{$day}}"
                       name="checked_week_days[]"
                       @if($isValid) checked="checked" @endif>
            </div>
        </td>
        <td style="width: 1%;" class="py-1">
            <label class="form-check-label" for="chkShortWeekDay_{{$shortWeekDay}}">
            <span class="fs-5 fw-bold d-md-block d-none">{{$shortWeekDay}}</span></label></span>
        </td>
        <td style="width: 25%;" class="py-1">
            <div class="session-times">
                @if($hospitalSchedule = $hospitalSchedules->where('day_of_week',$day)->first())
                    @include('hospital_schedule.slot',['slot' => $slots,'day' => $day,'hospitalSchedule' => $hospitalSchedule])
                @else
                    @include('hospital_schedule.slot',['slot' => $slots,'day' => $day])
                @endif
            </div>
        </td>
    </tr> 
    @endforeach 
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary', 'id' => 'hospitalScheduleBtnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
</div>
