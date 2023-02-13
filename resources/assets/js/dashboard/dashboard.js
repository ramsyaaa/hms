'use strict'
listenClick('.notice-board-view-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let noticeBoardId = $(event.currentTarget).attr('data-id');
    $.ajax({
        url: $('.noticeBoardUrl').val() + '/' + noticeBoardId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showNoticeBoardTitle').html('')
                $('#showNoticeBoardDescription').html('')
                $('#showNoticeBoardTitle').append(result.data.title)
                $('#showNoticeBoardDescription').
                    append(result.data.description)
                $('#show_notice_boards_modal').appendTo('body').modal('show')
                ajaxCallCompleted()
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
});

 
