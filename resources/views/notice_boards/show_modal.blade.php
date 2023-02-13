<div id="show_notice_boards_modal" class="modal fade side-fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.common.view') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-12 mb-5">
                        {{ Form::label('title', __('messages.notice_board.title').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                        <br>
                        <span id="showNoticeBoardTitle" class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-12 mb-5">
                        {{ Form::label('description', __('messages.notice_board.description').(':'),['class' => 'pb-2 fs-5 text-gray-600']) }}
                        <br>
                        <span id="showNoticeBoardDescription" class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
