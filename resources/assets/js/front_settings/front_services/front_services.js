
listenSubmit('#addFrontServiceForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#frontServiceSave');
    $('#frontServiceSave').attr('disabled', true);
    loadingButton.button('loading');
    let formData = new FormData($(this)[0]);
    $.ajax({
        url: $('#indexFrontServicesUrl').val(),
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function success(result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_front_service_modal').modal('hide');
                $('#frontServiceSave').attr('disabled', false);
                // $(tableName).DataTable().ajax.reload(null, false);
                livewire.emit('refresh')
            }
        },
        error: function error(result) {
            $('#frontServiceSave').attr('disabled', false);
            printErrorMessage('#frontServiceErrorsBox', result);
        },
        complete: function complete() {
            loadingButton.button('reset');
        },
    });

});

listen('click', '.editFrontServiceBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let frontServiceId = $(event.currentTarget).attr('data-id');
    renderFrontServiceData(frontServiceId);
});

function renderFrontServiceData(id) {
    $.ajax({
        url: $('#indexFrontServicesUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#frontServiceId').val(result.data.id);
                if (result.data.icon_url)
                    $('#editFrontServicePreviewImage').css('background-image',
                        'url("' + result.data.icon_url + '")');
                else
                    $('#editFrontServicePreviewImage').css('background-image',
                        'url("' + $('#indexServiceDefaultDocumentImageUrl').val() + '")');
                $('#editFrontServiceName').val(result.data.name);
                $('#editFrontServiceDescription').val(result.data.short_description);
                if (isEmpty(result.data.icon_url)) {
                    $('#frontServiceIconUrl').hide();
                    $('.btn-view').hide();
                } else {
                    $('#frontServiceIconUrl').show();
                    $('.btn-view').show();
                    $('#frontServiceIconUrl').attr('href', result.data.icon_url);
                }
                $('#edit_front_service_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

listenSubmit('#editFrontServiceForm', function (event) {
    event.preventDefault();
    // let loadingButton = jQuery(this).find('#btnEditSave');
    // loadingButton.button('loading');
    let loadingButton = jQuery(this).find('#editFrontServiceSave');
    $('#editFrontServiceSave').attr('disabled', true);
    loadingButton.button('loading');
    let id = $('#frontServiceId').val();
    let formData = new FormData($(this)[0]);
    $.ajax({
        url: $('#indexFrontServicesUrl').val() + '/' + id,
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editFrontServiceSave').attr('disabled', false);
                $('#edit_front_service_modal').modal('hide');
                livewire.emit('refresh')
            }
        },
        error: function (result) {
            $('#editFrontServiceSave').attr('disabled', false);
            manageAjaxErrors(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenHiddenBsModal('#add_front_service_modal', function () {
    resetModalForm('#addFrontServiceForm', '#add_front_service_modal #frontServiceErrorsBox');
    $('#frontServiceSave').attr('disabled', false);
    $('#frontServicePreviewImage').attr('src', $('#indexServiceDefaultDocumentImageUrl').val()).css('background-image', `url(${$('#indexServiceDefaultDocumentImageUrl').val()})`);
});

listenShownBsModal('#add_front_service_modal', function () {
    $('#add_front_service_modal #frontServiceErrorsBox').show();
    $('#add_front_service_modal #frontServiceErrorsBox').addClass('d-none');
});

listenHiddenBsModal('#edit_front_service_modal', function () {
    resetModalForm('#editFrontServiceForm', '#edit_front_service_modal #editFrontServiceErrorsBox');
    $('#editFrontServiceSave').attr('disabled', false);
    $('#editFrontServicePreviewImage').attr('src', $('#indexServiceDefaultDocumentImageUrl').val()).css('background-image', `url(${$('#indexServiceDefaultDocumentImageUrl').val()})`);
});

listenShownBsModal('#edit_front_service_modal', function () {
    $('#edit_front_service_modal #editFrontServiceErrorsBox').show();
    $('#edit_front_service_modal #editFrontServiceErrorsBox').addClass('d-none');
});

listen('click', '.deleteFrontServiceBtn', function (event) {
    let frontServiceId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexFrontServicesUrl').val() + '/' + frontServiceId, '', $('#frontService').val());
});
