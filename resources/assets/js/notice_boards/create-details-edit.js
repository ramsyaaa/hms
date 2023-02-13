'use strict';

listenClick('.editNoticeboardBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let noticeBoardId = $(event.currentTarget).attr('data-id');
    renderNoticeBoardDetailData(noticeBoardId);
});

window.renderNoticeBoardDetailData = function (id) {
    $.ajax({
        url: $('#showNoticeBoardUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#noticeBoardId').val(result.data.id);
                $('#editNoticeBoardTitle').val(result.data.title);
                $('#editNoticeBoardDescription').val(result.data.description);
                $('#edit_notice_boards_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

listenSubmit('#editNoticeBoardForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#editNoticeBoardSave');
    loadingButton.button('loading');
    let id = $('#noticeBoardId').val();
    $.ajax({
        url: $('#showNoticeBoardUrl').val() + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_notice_boards_modal').modal('hide');
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            }
        },
        error: function (result) {
            manageAjaxErrors(result)
        },
        complete: function () {
            loadingButton.button('reset')
        },
    });
});

