listen('click', '.notice-board-delete-btn', function (event) {
    let noticeBoardId = $(event.currentTarget).attr('data-id')
    deleteItem(
        $('#indexNoticeBoardUrl').val() + '/' + noticeBoardId,
        '',
        $('#noticeBoard').val(),
    )
})
