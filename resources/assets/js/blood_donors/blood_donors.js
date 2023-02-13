'use strict';

document.addEventListener('turbo:load', loadBloodDonorCreateEdit)

function loadBloodDonorCreateEdit () {

    if (!$('#addBloodDonorForm').length && !$('#editBloodDonorForm').length) {
        return false;
    }

    const donorBloodGroupElement = $('#donorBloodGroup')
    const editDonorBloodGroupElement = $('#editDonorBloodGroup')
    const lastDonationDateElement = $('#lastDonationDate')
    if (donorBloodGroupElement.length) {
        $('#donorBloodGroup').select2({
            width: '100%',
            dropdownParent: $('#add_blood_donors_modal')
        });
    }

    if (editDonorBloodGroupElement.length) {
        $('#editDonorBloodGroup').select2({
            width: '100%',
            dropdownParent: $('#edit_blood_donors_modal')
        });
    }

    if (lastDonationDateElement.length) {
        $('#lastDonationDate').flatpickr({
            format: 'YYYY-MM-DD',
            useCurrent: false,
            sideBySide: false,
            locale : $('.userCurrentLanguage').val(),
        })
    }
}

    listenSubmit('#addBloodDonorForm', function (event) {
        event.preventDefault()
        var loadingButton = jQuery(this).find('#bloodDonorSave')
        loadingButton.button('loading')
        $.ajax({
            url: $('#bloodDonorCreateUrl').val(),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message)
                    $('#add_blood_donors_modal').modal('hide')
                    livewire.emit('refresh')
                }
            },
            error: function (result) {
                printErrorMessage('#bloodDonorErrorsBox', result)
            },
            complete: function () {
                loadingButton.button('reset')
            },
        })
    })

    listenSubmit('#editBloodDonorForm', function (event) {
        event.preventDefault()
        var loadingButton = jQuery(this).find('#editBloodDonorSave')
        loadingButton.button('loading')
        var id = $('#bloodDonorId').val()
        $.ajax({
            url: $('#bloodDonorUrl').val() + '/' + id,
            type: 'put',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message)
                    $('#edit_blood_donors_modal').modal('hide')
                    livewire.emit('refresh')
                }
            },
            error: function (result) {
                manageAjaxErrors(result)
            },
            complete: function () {
                loadingButton.button('reset')
            },
        })
    })

    listenHiddenBsModal('#add_blood_donors_modal', function () {
        resetModalForm('#addBloodDonorForm', '#bloodDonorErrorsBox')
    })

    listenHiddenBsModal('#edit_blood_donors_modal', function () {
        resetModalForm('#editBloodDonorForm', '#editBloodDonorErrorsBox')
    })

    function renderBloodDonorData (id) {
        $.ajax({
            url: $('#bloodDonorUrl').val() + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let bloodDonor = result.data
                    $('#bloodDonorId').val(bloodDonor.id)
                    $('#editBloodDonorName').val(bloodDonor.name)
                    $('#editBloodDonorAge').val(bloodDonor.age)
                    $('#editBloodDonorMale,#editBloodDonorFemale').
                        prop('checked', false)
                    if (bloodDonor.gender == 1) {
                        $('#editBloodDonorMale').prop('checked', true)
                    } else {
                        $('#editBloodDonorFemale').prop('checked', true)
                    }
                    $('#editDonorBloodGroup').val(bloodDonor.blood_group)
                    $('#editDonorBloodGroup').select2({
                        dropdownParent: $('#edit_blood_donors_modal')
                    })
                    $('#editDonorBloodGroup').trigger('change')
                    let editBloodDonorDate = $('#editLastDonationDate').flatpickr({
                        format: 'YYYY-MM-DD',
                        useCurrent: false,
                        sideBySide: false,
                        locale : $('.userCurrentLanguage').val(),
                    })
                    editBloodDonorDate.setDate(
                        format(result.data.last_donate_date, 'YYYY-MM-DD'))
                    $('#edit_blood_donors_modal').modal('show')
                    ajaxCallCompleted()
                }
            },
            error: function (result) {
                manageAjaxErrors(result)
            },
        })
    }

    listen('click', '.blood-donor-edit-btn', function (event) {
        if ($('.ajaxCallIsRunning').val()) {
            return
        }
        ajaxCallInProgress()
        let bloodDonorId = $(event.currentTarget).attr('data-id')
        renderBloodDonorData(bloodDonorId)
    })

    listen('click', '.blood-donor-delete-btn', function (event) {
        let bloodDonorId = $(event.currentTarget).attr('data-id')
        deleteItem(
            $('#bloodDonorUrl').val() + '/' + bloodDonorId,
            '',
            $('#bloodDonor').val(),
        )
    })

    listenShownBsModal('#add_blood_donors_modal', function () {
        $('#donorBloodGroup').select2({
            width: '100%',
            dropdownParent: $('#add_blood_donors_modal')
        })
    });

    




