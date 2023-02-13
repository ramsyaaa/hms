'use strict';

document.addEventListener('turbo:load', loadBloodIssuesCreateEdit)

function loadBloodIssuesCreateEdit () {

    if (!$('#addBloodIssueForm').length && !$('#editBloodIssueForm').length) {
        return false;
    }

    const bloodIssueDoctorNameElement = $('#bloodIssueDoctorName')
    const bloodIssuePatientNameElement = $('#bloodIssuePatientName')
    const donorNameElement = $('#donorName')
    const issuedBloodGroupElement = $('#issuedBloodGroup')
    const editBloodIssueDoctorNameElement = $('#editBloodIssueDoctorName')
    const editBloodIssuePatientNameElement = $('#editBloodIssuePatientName')
    const editDonorNameElement = $('#editDonorName')
    const editIssuedBloodGroupElement = $('#editIssuedBloodGroup')
    const bloodIssueDateElement = $('#bloodIssueDate')

    if(bloodIssueDoctorNameElement.length){
        $('#bloodIssueDoctorName').select2({
            width: '100%',
            dropdownParent: $('#add_blood_issues_modal')
        });
    }

    if(bloodIssuePatientNameElement.length){
        $('#bloodIssuePatientName').select2({
            width: '100%',
            dropdownParent: $('#add_blood_issues_modal')
        });
    }

    if(donorNameElement.length){
        $('#donorName').select2({
            width: '100%',
            dropdownParent: $('#add_blood_issues_modal')
        });
    }

    if(issuedBloodGroupElement.length){
        $('#issuedBloodGroup').select2({
            width: '100%',
            dropdownParent: $('#add_blood_issues_modal')
        });
    }

    if(editBloodIssueDoctorNameElement.length){
        $('#editBloodIssueDoctorName').select2({
            width: '100%',
            dropdownParent: $('#edit_blood_issues_modal')
        });
    }

    if(editBloodIssuePatientNameElement.length){
        $('#editBloodIssuePatientName')
        .select2({
            width: '100%',
            dropdownParent: $('#edit_blood_issues_modal')
        });
    }

    if(editDonorNameElement.length){
        $('#editDonorName')
        .select2({
            width: '100%',
            dropdownParent: $('#edit_blood_issues_modal')
        });
    }

    if(editIssuedBloodGroupElement.length){
        $('#editIssuedBloodGroup')
        .select2({
            width: '100%',
            dropdownParent: $('#edit_blood_issues_modal')
        });
    }
    
    if(bloodIssueDateElement.length){
         $('#bloodIssueDate').flatpickr({
            enableTime: true,
            defaultDate: new Date(),
            maxDate: new Date(),
            dateFormat: 'Y-m-d H:i',
             locale : $('.userCurrentLanguage').val(),
        });
    }   

}

listenSubmit('#addBloodIssueForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#bloodIssueSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#bloodIssueCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_blood_issues_modal').modal('hide');
                livewire.emit('refresh')
                setTimeout(function () {
                    loadingButton.button('reset');
                }, 2500);
            }
        },
        error: function (result) {
            printErrorMessage('#bloodIssueErrorsBox', result);
            setTimeout(function () {
                loadingButton.button('reset');
            }, 2000);
        },
    });
});

listenChange('#donorName', function () {
    changeBloodGroup('#issuedBloodGroup', $(this).val());
});

listenChange('#editDonorName', function () {
    changeBloodGroup('#editIssuedBloodGroup', $(this).val());
});

function changeBloodGroup(selector, id) {
    $.ajax({
        url: $('#bloodGroupUrl').val(),
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: function (data) {
            $(selector).empty();
            $.each(data.data, function (i, v) {
                $(selector).append($('<option></option>').attr('value', i).text(v));
            });
        },
    });
}

listenSubmit('#editBloodIssueForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#editBloodIssueSave');
    loadingButton.button('loading');
    let id = $('#bloodIssueId').val();
    $.ajax({
        url: $('#bloodIssueUrl').val() + '/' + id,
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_blood_issues_modal').modal('hide');
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

listenHiddenBsModal('#add_blood_issues_modal', function () {
    resetModalForm('#addBloodIssueForm', '#bloodIssueErrorsBox');
    $('#bloodIssueDoctorName').val(null).trigger('change');
    $('#bloodIssuePatientName').val(null).trigger('change');
    $('#donorName').val(null).trigger('change');
    $('#issuedBloodGroup').val(null).trigger('change');
});

listenHiddenBsModal('#edit_blood_issues_modal', function () {
    resetModalForm('#editBloodIssueForm', '#editBloodIssueErrorsBox');
});

listenShownBsModal('#add_blood_issues_modal,#edit_blood_issues_modal', function () {
    $('#bloodIssueDoctorName,#bloodIssuePatientName,#donorName,#issuedBloodGroup').select2({
        width: '100%',
        dropdownParent: $('#add_blood_issues_modal')
    })
    
    $('#editBloodIssueDoctorName,#editBloodIssuePatientName,#editDonorName,#editIssuedBloodGroup').select2({
        width: '100%',
        dropdownParent: $('#edit_blood_issues_modal')
    })
});


function renderBloodIssuesData(id) {
    $.ajax({
        url: $('#bloodIssueUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let bloodIssue = result.data;
                $('#bloodIssueId').val(bloodIssue.id);
                let editBloodIssueDate = $('#editBloodIssueDate').flatpickr({
                    enableTime: true,
                    maxDate: new Date(),
                    dateFormat: 'Y-m-d H:i',
                    locale : $('.userCurrentLanguage').val(),
                });
                editBloodIssueDate.setDate(bloodIssue.issue_date);
                $('#editBloodIssueDoctorName')
                .val(bloodIssue.doctor_id)
                .trigger('change');
                $('#editBloodIssuePatientName')
                .val(bloodIssue.patient_id)
                .trigger('change');
                $('#editDonorName')
                .val(bloodIssue.donor_id)
                .trigger('change', [{isEdit: true}]);
                $('#editBloodIssueAmount').val(bloodIssue.amount);
                $('.price-input').trigger('input');
                $('#editBloodIssueRemarks').val(bloodIssue.remarks);
                $('#edit_blood_issues_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listen('click', '.blood-issues-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let bloodIssueId = $(event.currentTarget).attr('data-id');
    renderBloodIssuesData(bloodIssueId);
});

listen('click', '.blood-issues-delete-btn', function (event) {
    let bloodIssueId = $(event.currentTarget).attr('data-id');
    deleteItem(
        $('#bloodIssueUrl').val() + '/' + bloodIssueId,
        '',
        $('#bloodIssue').val(),
    );
});

 
