<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('title', __('messages.investigation_report.title').(':'), ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('title', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('patient_id', __('messages.investigation_report.patient').(':'), ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('patient_id',$patients, null, ['class' => 'form-select','required','id' => 'editInvestigationPatientId','placeholder'=>'Select Patient','data-control' => 'select2']) }}
        </div>
    </div>
    @if(Auth::user()->hasRole('Doctor'))
        <input type="hidden" name="doctor_id" value="{{ Auth::user()->owner_id }}">
    @else
        <div class="col-md-4">
            <div class="form-group mb-5">
                {{ Form::label('doctor_id', __('messages.investigation_report.doctor').(':'), ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::select('doctor_id',$doctors, null, ['class' => 'form-select','required','id' => 'editInvestigationDoctorId','placeholder'=>'Select Doctor','data-control' => 'select2']) }}
            </div>
        </div>
    @endif
    <div class="col-md-4">
        <div class="form-group investigation-report-date mb-5">
            {{ Form::label('date', __('messages.investigation_report.date').(':'), ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'id' => 'editInvestigationDate','required','autocomplete' => 'off']) }}
        </div>
    </div>
    <div class="form-group col-md-4 mb-5">
        <div class="row2" io-image-input="true">
            {{ Form::label('image',__('messages.common.profile').(':'), ['class' => 'form-label']) }}
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="editInvestigationPreviewImage"
                         style="background-image: url('{{ $investigationReport->attachment_url ?? asset('assets/img/default_image.jpg')}}')">
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" title="{{ __('messages.investigation_report.attachment') }}">
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        <input type="file" id="editAccountantProfileImage" name="attachment"
                                               class="image-upload d-none profileImage"
                                               accept=".png, .jpg, .jpeg, .gif, .pdf, .doc, .docx"/>
                                        <input type="hidden" name="avatar_remove"/>
                                    </label>
                                </span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-5">
                {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::select('status', $status, null, ['id' => 'editInvestigationStatus','class' => 'form-select','required','data-control' => 'select2']) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-5">
                {{ Form::label('description', __('messages.investigation_report.description').(':'), ['class' => 'form-label']) }}
                {{ Form::textarea('description', null, ['class' => 'form-control col-sm-6 d-flex flex-column mb-md-10 mb-5']) }}
            </div>
        </div>
        <div class="d-flex justify-content-end">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
            <a href="{{ route('investigation-reports.index') }}"
               class="btn btn-secondary me-2">{{ __('messages.common.cancel') }}</a>
        </div>
    </div>
