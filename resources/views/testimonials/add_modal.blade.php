<div id="add_testimonials" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.testimonial.new_testimonial') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addTestimonialForm','files' => true]) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="testimonialErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name', __('messages.testimonial.name').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', null, ['class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.testimonial.description').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::textarea('description', null, ['class' => 'form-control testimonialDescription','rows' => 6]) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <div class="row2" io-image-input="true">
                            {{ Form::label('image',__('messages.common.profile').(':'), ['class' => 'form-label']) }}
                            <div class="d-block">
                                <?php
                                $style = 'style=';
                                $background = 'background-image:';
                                ?>

                                <div class="image-picker">
                                    <div class="image previewImage" id="testimonialPreviewImage"
                                    {{$style}}"{{$background}} url({{ asset('assets/img/default_image.jpg')}}">
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small" title="{{ __('messages.common.profile') }}">
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        {{ Form::file('profile',['id'=>'testimonialProfile','class' => 'image-upload d-none document-file profileImage']) }}
                                        <input type="hidden" name="avatar_remove"/>
                                    </label>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-text">{{ __('messages.allow_file_type') }}</div>
                </div>
            </div>
        </div>
        <div class="modal-footer pt-0">
            {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0 btnSave','id' => 'testimonialSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
            <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
</div>
