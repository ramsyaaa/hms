<div id="add_documents_modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.document.new_document') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addDocumentForm', 'files' => true, 'class' => 'addDocumentForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="documentErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('title', __('messages.document.title').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('title', null, ['class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('document_type', __('messages.document.document_type').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('document_type_id', $documentType, null, ['class' => 'form-select','required', 'id' => 'documentTypeId','placeholder' => __('messages.document.select_document_type'), 'data-control' => 'select2']) }}
                    </div>
                    @if(getLoggedInUser()->hasRole('Patient'))
                        <input type="hidden" name="patient_id" value="{{ getLoggedInUser()->owner_id }}">
                    @else
                        <div class="form-group col-sm-6 mb-5">
                            <div>
                                {{ Form::label('patient', __('messages.document.patient').(':'), ['class' => 'form-label']) }}
                                <span class="required"></span>
                                {{ Form::select('patient_id', $patients, null, ['class' => 'form-select','required', 'id' => 'documentPatientId', 'placeholder' => __('messages.document.select_patient'), 'data-control' => 'select2']) }}
                            </div>
                        </div>
                    @endif
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('file', __('messages.document.attachment').(':'), ['class' => 'form-label required']) }}
                        <br>
                        <div class="d-block">
                            <?php
                            $style = 'style=';
                            $background = 'background-image:';
                            ?>

                            <div class="image-picker">
                                <div class="image previewImage" id="documentPreviewImage"
                                {{$style}}"{{$background}} url({{ asset('assets/img/default_image.jpg')}}">
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small" title="{{ __('messages.document.attachment') }}">
                                        <label>
                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            {{ Form::file('file',['id'=>'','class' => 'd-none image-upload profileImage']) }}
                                            <input type="hidden" name="avatar_remove"/>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('notes', __('messages.document.notes').(':'), ['class' => 'form-label']) }}
                        {{ Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 5]) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'documentSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
    </div>
    </div>
</div>

