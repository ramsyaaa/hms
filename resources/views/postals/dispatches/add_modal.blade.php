<div id="add_postal_dispatch_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{__('messages.postal.new_dispatch')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addDispatchForm','class'=>'addPostalForm','files' => true]) }}
            <div class="modal-body">
                {{ Form::hidden('type',\App\Models\Postal::POSTAL_DISPATCH,['id'=>'type']) }}
                <div class="alert alert-danger d-none hide validationErrorsBox" id="dispatchErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('To Title',__('messages.postal.to_title').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('to_title', null, ['class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('Reference Number',__('messages.postal.reference_no').':', ['class' => 'form-label']) }}
                        {{ Form::text('reference_no', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('date', __('messages.postal.date').':', ['class' => 'form-label']) }}
                        {{ Form::text('date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light date form-control' : 'bg-white date form-control'),'id' => 'dispatchDate',  'autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('From Title',__('messages.postal.from_title').':', ['class' => 'form-label']) }}
                        {{ Form::text('from_title', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-md-8 mb-5">
                        <div class="row2" io-image-input="true">
                            {{ Form::label('image',__('messages.document.attachment').(':'), ['class' => 'form-label']) }}
                            <div class="d-block">
                                <?php
                                $style = 'style=';
                                $background = 'background-image:';
                                ?>

                                <div class="image-picker">
                                    <div class="image previewImage" id="dispatchPreviewImage"
                                    {{$style}}"{{$background}} url({{ asset('assets/img/default_image.jpg')}}">
                                        <span class="picker-edit rounded-circle text-gray-500 fs-small" title="{{__('messages.document.attachment')}}">
                                            <label>
                                                <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                <input type="file" id="dispatchAttachment" name="attachment"
                                                       class="image-upload d-none postalAttachment" accept=".png, .jpg, .jpeg, .gif"/>
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
                        {{  Form::textarea('address', null, ['class' => 'form-control', 'rows' => 4])  }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button( __('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0 btnPostalSave','id'=>'dispatchSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" aria-label="Close" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
