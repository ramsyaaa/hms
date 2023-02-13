<div class="row gx-10 mb-5">
    <div class="alert alert-danger d-none hide" id="scheduleErrorsBox"></div>
    @if(Auth::user()->hasRole('Doctor'))
        <input type="hidden" name="doctor_id" value="{{ Auth::user()->owner_id }}">
    @else
        <div class="form-group col-sm-8 mb-5">
            {{ Form::label('doctor_name', __('messages.case.doctor').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('doctor_id',$data['doctors'], null, ['class' => 'form-select','required','id' => 'doctorId','placeholder' => __('messages.schedule.select_doctor_name'),'data-control' => 'select2']) }}
        </div>
    @endif
    @if(Auth::user()->hasRole('Doctor'))
        <div class="form-group col-sm-12 mb-5">
            {{ Form::label('per_patient_time', __('messages.schedule.per_patient_time').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('per_patient_time', null, ['id'=>'perPatientTime', 'class' => 'form-control perPatientTime'.(getLoggedInUser()->thememode ? ' bg-light' : ' bg-white'), 'required','autocomplete' => 'off']) }}
        </div>
    @else
        <div class="form-group col-sm-4 mb-5">
            {{ Form::label('per_patient_time', __('messages.schedule.per_patient_time').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('per_patient_time', null, ['id'=>'perPatientTime', 'class' => 'form-control perPatientTime'.(getLoggedInUser()->thememode ? ' bg-light' : ' bg-white'), 'required']) }}
        </div>
    @endif

    <div class="col-lg-12 col-md-12 col-sm-12 schedulesCon">
        <table
            class="schedules-table schedules-table-bordered table table-striped">
            <thead class="schedules-table-theme text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th>{{ __('messages.schedule.available_on').':' }} <span class="required"></span></th>
            <th>{{ __('messages.schedule.available_from').':' }} <span class="required"></span></th>
            <th>{{ __('messages.schedule.available_to').':' }} <span class="required"></span></th>
            <th class="text-center">{{ __('messages.common.action') }}</th>
            </thead>
            <tbody class="schedule-container text-gray-600 fw-bold">
            @foreach($data['availableOn'] as $days)
                <tr>
                    <td class="schedules-table-td">
                        {{ Form::text('available_on[]', isset($scheduleDays)?$scheduleDays[$loop->iteration-1]->available_on:$days,
            ['class' => 'form-control availableOn','required','id' => 'availableOn-'.($loop->iteration-1),'readonly']) }}
                    </td>
                    <td class="schedules-table-td position-relative">
                        {{ Form::text('available_from[]', isset($scheduleDays)?$scheduleDays[$loop->iteration-1]->available_from:"00:00:00",['id'=>'availableFrom-'.($loop->iteration-1), 'class' => 'form-control availableFrom hospitalScheduleFrom-'.$loop->iteration.(getLoggedInUser()->thememode ? ' bg-light' : ' bg-white'), 'required','autocomplete' => 'off']) }}
                    </td>
                    <td class="schedules-table-td position-relative">
                        {{ Form::text('available_to[]', isset($scheduleDays)?$scheduleDays[$loop->iteration-1]->available_to:"00:00:00",
            ['id'=>'availableTo-'.($loop->iteration-1), 'class' => 'form-control availableTo hospitalScheduleTo-'.$loop->iteration.(getLoggedInUser()->thememode ? ' bg-light' : ' bg-white'), 'required','autocomplete' => 'off']) }}
                    </td>
                    <td class="text-center schedules-table-td">
                        {{--                        @if(!$loop->first)--}}
                        <a title="copy-previous"
                           class="btn action-btn btn-primary btn-sm copy-btn cpy-btn{{ $loop->iteration-1 }}" href="javascript:void(0)"
                           data-id="{{ $loop->iteration-1 }}">
                            <i class="fa fa-copy action-icon"></i>
                        </a>
                        {{--                        @endif--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-end">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','id' => 'scheduleSave']) !!}
    <a href="{!! route('schedules.index') !!}"
       class="btn btn-secondary">{!! __('messages.common.cancel') !!}</a>
</div>
