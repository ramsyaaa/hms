'use strict';

listenSubmit('#addNoticeBoardForm', function (event) {
    event.preventDefault();
    $('#noticeBoardSave').attr('disabled',true)
    $.ajax({
        url: $('#indexNoticeBoardCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_notice_boards_modal').modal('hide');
                livewire.emit('refresh')
                $('#noticeBoardSave').attr('disabled',false)
            }
        },
        error: function (result) {
            printErrorMessage('#noticeBoardErrorsBox', result);
            $('#noticeBoardSave').attr('disabled',false)
        },
    });
});

listen('click', '.notice-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let noticeBoardId = $(event.currentTarget).attr('data-id');
    renderNoticeBoardUpdateData(noticeBoardId);
});

listen('click', '.notice-view-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return
    }
    ajaxCallInProgress()
    let noticeBoardId = event.currentTarget.dataset.id
    $.ajax({
        url: $('#indexNoticeBoardUrl').val() + '/' + noticeBoardId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showNoticeBoardTitle').html('')
                $('#showNoticeBoardDescription').html('')
                $('#showNoticeBoardTitle').append(result.data.title)
                $('#showNoticeBoardDescription').
                    append(result.data.description)
                $('#show_notice_boards_modal').appendTo('body').modal('show')
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
});

function renderNoticeBoardUpdateData(id) {
    $.ajax({
        url: $('#indexNoticeBoardUrl').val() + '/' + id + '/edit',
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

listenSubmit('#editNoticeBoardsForm', function (event) {
    event.preventDefault()
    $('#noticeBoardSave').attr('disabled',true)
    let id = $('#noticeBoardId').val()
    $.ajax({
        url: $('#indexNoticeBoardUrl').val() + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_notice_boards_modal').modal('hide');
                livewire.emit('refresh')
                $('#noticeBoardSave').attr('disabled',false)
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
            $('#noticeBoardSave').attr('disabled',false)
        },
    });
});

listenHiddenBsModal('#add_notice_boards_modal', function () {
    resetModalForm('#addNoticeBoardForm', '#noticeBoardErrorsBox');
    $('#noticeBoardSave').attr('disabled',false)
});

listenHiddenBsModal('#edit_notice_boards_modal', function () {
    resetModalForm('#editNoticeBoardsForm', '#editNoticeBoardErrorsBox')
});
