'use strict';

document.addEventListener('turbo:load', loadBloodDonationCreateEdit)

function loadBloodDonationCreateEdit () {

    if (!$('#addBloodDonationForm').length && !$('#editBloodDonationForm').length) {
        return false;
    }

    const donationDonorNameElement = $('#donationDonorName')
    const editDonationDonorNameElement = $('#editDonationDonorName')

    listenShownBsModal('#add_blood_donation_modal', function () {
        if (donationDonorNameElement.length) {
            $('#donationDonorName').select2({
                width: '100%',
                dropdownParent: $('#add_blood_donation_modal')
            });
        }
    })

    listenShownBsModal('#edit_blood_donation_modal', function () {
        if (editDonationDonorNameElement.length) {
            $('#editDonationDonorName').select2({
                width: '100%',
                dropdownParent: $('#edit_blood_donation_modal')
            });
        }
    })

}

listenSubmit('#addBloodDonationForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#bloodDonationSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#bloodDonationCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_blood_donation_modal').modal('hide');
                livewire.emit('refresh')
                setTimeout(function () {
                    loadingButton.button('reset');
                }, 2500);
            }
        },
        error: function (result) {
            printErrorMessage('#bloodDonationErrorsBox', result);
            setTimeout(function () {
                loadingButton.button('reset');
            }, 2000);
        },
    });
});

listenSubmit('#editBloodDonationForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#editBloodDonationSave');
    loadingButton.button('loading');
    let id = $('#bloodDonationId').val();
    $.ajax({
        url: $('#bloodDonationUrl').val() + '/' + id,
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_blood_donation_modal').modal('hide');
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

listenHiddenBsModal('#add_blood_donation_modal', function () {
    $('#donationDonorName').val('').trigger('change.select2');
    resetModalForm('#addBloodDonationForm', '#bloodDonationErrorsBox');
});

listenHiddenBsModal('#edit_blood_donation_modal', function () {
    resetModalForm('#editBloodDonationForm', '#editBloodDonationErrorsBox');
});

function renderBloodDonationData(id) {
    $.ajax({
        url: $('#bloodDonationUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let bloodDonation = result.data;
                $('#bloodDonationId').val(bloodDonation.id);
                $('#editDonationDonorName').val(bloodDonation.blood_donor_id);
                $('#editDonationDonorName').trigger('change');
                $('#editDonationBags').val(bloodDonation.bags);
                $('#edit_blood_donation_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

listen('click', '.blood-donation-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let bloodDonationId = $(event.currentTarget).attr('data-id');
    renderBloodDonationData(bloodDonationId);
});

listen('click', '.blood-donation-delete-btn', function (event) {
    let bloodDonationId = $(event.currentTarget).attr('data-id');
    deleteItem(
        $('#bloodDonationUrl').val() + '/' + bloodDonationId,
        '',
        $('#bloodDonation').val(),
    );
});

listenShownBsModal('#edit_blood_donation_modal', function () {
    $('#editDonationDonorName:first').focus();
});
