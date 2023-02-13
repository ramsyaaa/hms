<div id="addCredential" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.live_consultation.add_credential') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addZoomForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="credentialValidationErrorsBox"></div>
                {{ Form::hidden('user_id',getLoggedInUserId(),['id'=>'zoomUserId']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('zoom_api_key', __('messages.live_consultation.zoom_api_key').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('zoom_api_key', '', ['class' => 'form-control','required', 'id' => 'zoomApiKey', 'autocomplete' => 'off']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('zoom_api_secret', __('messages.live_consultation.zoom_api_secret').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('zoom_api_secret', '', ['class' => 'form-control','required', 'id' => 'zoomApiSecret', 'autocomplete' => 'off']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'btnZoomSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
