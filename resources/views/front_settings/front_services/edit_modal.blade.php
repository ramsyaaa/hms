<div id="edit_front_service_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.service.edit_service') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editFrontServiceForm','files' => true]) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editFrontServiceErrorsBox"></div>
                <div class="row">
                    {{ Form::hidden('id',null,['id'=>'frontServiceId']) }}
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name', __('messages.common.name').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', null, ['class' => 'form-control','id' => 'editFrontServiceName','required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('short_description', __('messages.short_description').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::textarea('short_description', null, ['class' => 'form-control','id' => 'editFrontServiceDescription','rows' => 6]) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <div class="row2" io-image-input="true">
                            {{ Form::label('image',__('messages.icon').(':'), ['class' => 'form-label']) }}
                            <span class="required"></span>
                            <div class="d-block">
                                <?php
                                $style = 'style=';
                                $background = 'background-image:';
                                ?>

                                <div class="image-picker">
                                    <div class="image previewImage" id="editFrontServicePreviewImage">
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small" title="Change icon">
                                            <label>
                                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                {{ Form::file('icon',['id'=>'editFrontServiceIcon','class' => 'image-upload d-none document-file']) }}
                                                <input type="hidden" name="avatar_remove"/>
                                            </label>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="modal-footer pt-0">
        {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary','id' => 'editFrontServiceSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <button type="button" class="btn btn-secondary"
                data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
    </div>
    {{ Form::close() }}
</div>
</div>

