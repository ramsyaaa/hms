listenSubmit('#add_vaccinations_form', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#vaccinationBtnSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#vaccination_createUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_vaccinations_modal').modal('hide');
                livewire.emit('refresh')
                setTimeout(function () {
                    loadingButton.button('reset');
                }, 2500);
            }
        },
        error: function (result) {
            printErrorMessage('#createValidationErrorsBox', result);
            setTimeout(function () {
                loadingButton.button('reset');
            }, 2000);
        },
    });
});

listenHiddenBsModal('#add_vaccinations_modal', function () {
    resetModalForm('#add_vaccinations_form', '#createValidationErrorsBox');
});

listenClick('.edit-vaccinations-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return
    }
    ajaxCallInProgress()
    let vaccinationId = $(event.currentTarget).attr('data-id')
    renderVaccinationData(vaccinationId)
})

function renderVaccinationData (id) {
    $.ajax({
        url: $('#vaccination_url').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let vaccination = result.data
                $('#vaccinationId').val(vaccination.id)
                $('#editVaccinationName').val(vaccination.name)
                $('#editVaccinationManufacturedBy').
                    val(vaccination.manufactured_by)
                $('#editVaccinationBrand').val(vaccination.brand)
                $('#edit_vaccinations_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenSubmit('#edit_vaccinations_form', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditVaccinationSave');
    loadingButton.button('loading');
    let id = $('#vaccinationId').val();
    $.ajax({
        url: $('#vaccination_url').val() + '/' + id + '/update',
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_vaccinations_modal').modal('hide');
                livewire.emit('refresh')
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenClick('.delete-vaccination-btn', function (event) {
    let vaccinationId = $(event.currentTarget).attr('data-id');
    deleteItem($('#vaccination_url').val() + '/' + vaccinationId, '',
        $('#Vaccination').val());
});
