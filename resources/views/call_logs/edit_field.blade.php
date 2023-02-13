<div class="alert alert-danger d-none hide" id="callLogErrorsBox"></div>
<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Name',__('messages.call_log.name').':', ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('name', null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Phone',__('messages.call_log.phone').':', ['class' => 'form-label']) }}
        <br>
        {!! Form::tel('phone',$callLog->phone ? '+'.$callLog->phone : getCountryCode(), ['class' => 'form-control phoneNumber','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) !!}
        {!! Form::hidden('prefix_code',null,['class'=>'prefix_code']) !!}
        {{ Form::hidden('country_iso',null,['class'=>'country_iso']) }}
        <span id="valid-msg" class="text-success valid-msg d-none fw-400 fs-small mt-2">✓ &nbsp; {{__('messages.valid')}}</span>
        <span id="error-msg" class="text-danger error-msg d-none fw-400 fs-small mt-2"></span>
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Date',__('messages.call_log.received_on').':', ['class' => 'form-label']) }}
        {{ Form::text('date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'autocomplete' => 'off','id' => 'callLogDate']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Follow-Up Date',__('messages.call_log.follow_up_date').':', ['class' => 'form-label']) }}
        {{ Form::text('follow_up_date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'autocomplete' => 'off','id' => 'callLogFollowUpDate']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Note',__('messages.call_log.note').':', ['class' => 'form-label']) }}
        {{ Form::textarea('note', null, ['class' => 'form-control','rows' => 5,'cols' => 5]) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Call Type',__('messages.call_log.call_type').':', ['class' => 'form-label']) }}
        <div class="d-flex align-items-center">
            <div class="form-check me-10">
                <label class="form-label" for="accountantGenderMale">{{ __('messages.call_log.incoming') }}</label>
                {{ Form::radio('call_type', \App\Models\CallLog::INCOMING, true, ['class' => 'form-check-input']) }}
            </div>
            <div class="form-check me-10">
                <label class="form-label" for="accountantGenderFemale">{{ __('messages.call_log.outgoing') }}</label>&nbsp;
                {{ Form::radio('call_type', \App\Models\CallLog::OUTCOMING,false, ['class' => 'form-check-input']) }}
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3 btnSave','id' => 'callLogSave']) !!}
    <a href="{!! route('call_logs.index') !!}"
       class="btn btn-secondary me-2">{!! __('messages.common.cancel') !!}</a>
</div>

