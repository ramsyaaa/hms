<div class="modal fade" id="editProfileModal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">{{ __('messages.profile.edit_profile') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['class'=>'form','id'=>'editProfileForm','files'=>true]) }}
            <div class="modal-body">
{{--                <div class="alert alert-danger display-none" id="editProfileValidationErrorsBox"></div>--}}
                {{ Form::hidden('user_id',null,['id'=>'editUserId']) }}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6  mb-5">
                        {{ Form::label('first_name', __('messages.profile.first_name').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('first_name', null, ['id'=>'firstName','class' => 'form-control','required']) }}
                    </div>
                    <div class="col-md-6  mb-5">
                        {{ Form::label('last_name', __('messages.profile.last_name').':', ['class' => 'form-label']) }}<span
                                class="required"></span>
                        {{ Form::text('last_name', null, ['id'=>'lastName','class' => 'form-control','required']) }}
                    </div>
                    <div class="col-md-6  mb-5">
                        {{ Form::label('email', __('messages.profile.email').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::email('email', null, ['id'=>'email','class' => 'form-control','required']) }}
                    </div>
                    <div class="col-md-6  mb-5">
                        {{ Form::label('phone',__('messages.user.phone').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        <br>
                        {{ Form::tel('phone', getCountryCode(), ['class' => 'form-control phoneNumber','id' => 'phone', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                        {{ Form::hidden('prefix_code',null,['class'=>'prefix_code']) }}
                        <span class="valid-msg text-success d-none fw-400 fs-small mt-2">✓ &nbsp; {{__('messages.valid')}}</span>
                        <span class="error-msg text-danger d-none fw-400 fs-small mt-2"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6  mb-5">
                        {{ Form::label('image', __('messages.profile.profile').':', ['class' => 'form-label d-block']) }}
                        <div class="d-block">
                            <?php
                            $style = 'style=';
                            $background = 'background-image:';
                            ?>
                            <div class="image-picker">
                                <div class="image previewImage" id="editPhoto"></div>
                                <span class="picker-edit rounded-circle text-gray-500 fs-small" title="edit">
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        <input type="file" class="image-upload d-none" name="image" id="profileImage" accept=".png, .jpg, .jpeg, .gif"/>
                                        <input type="hidden" name="avatar_remove">
                                    </label>
                                </span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer pt-0">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnPrEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<div id="changeLanguageModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">{{ __('messages.profile.change_language')}}</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'changeLanguageForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editProfileValidationErrorsBox"></div>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-12">
                        {{ Form::label('language',__('messages.profile.language').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('language', \App\Models\User::LANGUAGES, Auth::user()->language, ['id'=>'language','class' => 'form-select','data-control'=>'select2','data-hide-search'=> 'true','data-placeholder'=> 'language','required']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnLanguageChange','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
