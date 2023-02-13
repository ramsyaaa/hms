<div id="addOpdTimelineModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_patient_timeline.new_ipd_timeline') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addOpdTimelineNewForm', 'files'=>true]) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="timeLinevalidationErrorsBox"></div>
                {{ Form::hidden('opd_patient_department_id',$opdPatientDepartment->id, ['id'=>'opdPatientDepartmentId']) }}
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('title', __('messages.ipd_patient_timeline.title').':',['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('title', null, ['class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-md-6 mb-5">
                        <div class="form-group">
                            {{ Form::label('date', __('messages.ipd_patient_timeline.date').':',['class' => 'form-label']) }}
                            <span class="required"></span>
                            {{ Form::text('date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light timelineDate form-control' : 'bg-white timelineDate form-control'),'id' => 'opdTimelineDate','autocomplete' => 'off', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-5">
                        <div class="form-group">
                            {{ Form::label('description', __('messages.ipd_patient_timeline.description').':',['class' => 'form-label']) }}
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) }}
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-5">
                        {{ Form::label('visible_to_person', __('messages.ipd_patient_timeline.visible_to_person').(':'),['class' => 'form-label']) }}
                        <div class="form-check form-switch">
                            <input class="form-check-input w-35px h-20px switch-input" name="visible_to_person"
                                   type="checkbox"
                                   value="1" tabindex="8" checked>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('document', __('messages.ipd_patient_timeline.document').':',['class' => 'fs-5 fw-bolder text-gray-600 mb-2 d-block']) }}
                        <div class="d-block">
                            <div class="image-picker">
                                <div class="image previewImage" id="opdPreviewTimelineImage"
                                     style="background-image: url({{ asset('assets/img/default_image.jpg') }})">
                                </div>
                                <span class="picker-edit rounded-circle text-gray-500 fs-small" title="{{ __('messages.ipd_patient_timeline.document') }}"> 
                                    <label> 
                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        <input type="file" id="opdTimelineDocumentImage" name="attachment"
                                               class="image-upload d-none" accept="image/*"/>  
                                         <input type="hidden" name="avatar_remove"> 
                                    </label> 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-0">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnOpdTimelineSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
