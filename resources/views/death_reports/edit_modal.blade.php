<div id="edit_death_reports_modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.death_report.edit_death_report') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editDeathReportForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editDeathReportErrorsBox"></div>
                <div class="row">
                    {{ Form::hidden('death_report_id',null,['id'=>'deathReportId']) }}
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('case_id', __('messages.case.case').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('case_id', $cases, null, ['class' => 'form-select','required','id' => 'editDeathCaseId','placeholder'=>'Select Case']) }}
                    </div>
                    @if(Auth::user()->hasRole('Doctor'))
                        <input type="hidden" name="doctor_id" value="{{ Auth::user()->owner_id }}">
                    @else
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('doctor_name', __('messages.case.doctor').(':'), ['class' => 'form-label']) }}
                            <span class="required"></span>
                            {{ Form::select('doctor_id',$doctors, null, ['class' => 'form-select','required','id' => 'editDeathDoctorId','placeholder'=>'Select Doctor']) }}
                        </div>
                    @endif
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('date', __('messages.death_report.date').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('date', null, ['id'=>'editDeathDate', 'class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'), 'required','autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.death_report.description').(':'), ['class' => 'form-label']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'id' => 'editDeathDescription']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'editDeathReportSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" aria-label="Close" class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    {{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
