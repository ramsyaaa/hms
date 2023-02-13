<div id="edit_postal_receives_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{__('messages.postal.edit_receive')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editReceiveForm','class'=>'editPostalForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide editValidationErrorsBox1"
                     id="editReceiveErrorsBox1"></div>
                {{ Form::hidden('id',null,['id'=>'editReceiveId']) }}
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('From Title',__('messages.postal.from_title').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('from_title', null, ['class' => 'form-control editFromTitle','required','id' => 'editReceiveFromTitle']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('Reference Number',__('messages.postal.reference_no').':', ['class' => 'form-label']) }}
                        {{ Form::text('reference_no', null, ['class' => 'form-control editReferenceNumber','id' => 'editReceiveReferenceNumber']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('date', __('messages.postal.date').':', ['class' => 'form-label']) }}
                        {{ Form::text('date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light editPostalDate form-control' : 'bg-white editPostalDate form-control'),'autocomplete' => 'off','id' => 'editReceiveDate']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('To Title',__('messages.postal.to_title').':', ['class' => 'form-label']) }}
                        {{ Form::text('to_title', null, ['class' => 'form-control editToTitle','id' => 'editReceiveToTitle']) }}
                    </div>
                    <div class="form-group col-md-6 mb-5">
                        <div class="row2" io-image-input="true">
                            {{ Form::label('image',__('messages.document.attachment').(':'), ['class' => 'form-label']) }}
                            <div class="d-block">
                                <?php
                                $style = 'style=';
                                $background = 'background-image:';
                                ?>

                                <div class="image-picker">
                                    <div class="image previewImage editPreviewImage" id="editReceivePreviewImage"
                                    {{$style}}"{{$background}} url({{ asset('assets/img/default_image.jpg')}}">
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small" title="Change Attachment">
                                            <label>
                                                <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                <input type="file" id="editReceiveAttachment" name="attachment"
                                                       class="image-upload d-none editAttachment"
                                                       accept=".png, .jpg, .jpeg, .gif"/>
                                                <input type="hidden" name="avatar_remove"/>
                                            </label>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('Address', __('messages.postal.address').':', ['class' => 'form-label']) }}
                    {{ Form::textarea('address', null, ['class' => 'form-control editAddress', 'rows' => 4, 'id' => 'editReceiveAddress']) }}
                </div>
            </div>
        </div>
        <div class="modal-footer pt-0">
            {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary btnEditSave','id'=>'editReceiveSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
            <button type="button" aria-label="Close" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
</div>

