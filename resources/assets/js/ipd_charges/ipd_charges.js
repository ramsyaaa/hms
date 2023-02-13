document.addEventListener('turbo:load', loadIpdChargesData)

function loadIpdChargesData() {
    if (!$('#editIpdChargesForm').length && !$('#addIpdChargeNewForm').length) {
        return
    }

    $('#btnIpdChargeSave,#btnEditCharges').prop('disabled', true);
    $('#ipdChargeDate, #ipdEditChargeDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        sideBySide: true,
        minDate: $('#showIpdPatientCaseDate').val(),
        locale : $('.userCurrentLanguage').val(),
    });
    $('#ipdChargeTypeId, #ipdChargeCategoryId, #ipdChargeId').select2({
        dropdownParent: $('#addIpdChargesModal')
    });
    $('#editIpdChargeTypeId, #editIpdChargeCategoryId, #editIpdChargeId').select2({
        dropdownParent: $('#editIpdChargesModal')
    });
    
}

let editIpdChargeCategoryId = null;
let editIpdChargeId = null;
let editIpdStandardRate = null;
let editAppliedIpdCharge = null;

function renderIpdChargesData(id) {
    $.ajax({
        url: $('#showIpdChargesUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                editIpdChargeCategoryId = result.data.charge_category_id;
                editIpdChargeId = result.data.charge_id;
                editIpdStandardRate = result.data.standard_charge;
                editAppliedIpdCharge = result.data.applied_charge;
                $('#ipdChargesId').val(result.data.id);
                document.querySelector('#ipdEditChargeDate')._flatpickr.setDate(moment(result.data.date).format());
                $('#editIpdChargeTypeId').val(result.data.charge_type_id).trigger('change', [{onceOnEditRender: true}]);
                $('.price-input').trigger('input');
                $('#appliedChargeId').text(editAppliedIpdCharge);
                $('#editIpdChargesModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listen('click', '.edit-charges-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let ipdChargesId = $(event.currentTarget).attr('data-id');
    renderIpdChargesData(ipdChargesId);
});

listen('click', '.ipd-charge-delete-btn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('#showIpdChargesUrl').val() + '/' + id, '', $('#ipdCharge').val());
});

listenChange('#ipdChargeTypeId, #editIpdChargeTypeId', function (e, onceOnEditRender) {
    let isChargeEdit = $(this).data('is-charge-edit');
    if ($(this).val() !== '') {
        $.ajax({
            url: $('#showIpdChargeCategoryUrl').val(),
            type: 'get',
            dataType: 'json',
            data: {id: $(this).val()},
            beforeSend: function () {
                makeIpdChargesBtnDisabled(isChargeEdit);
            },
            success: function (data) {
                if (data.data.length !== 0) {
                    $((!isChargeEdit)
                        ? '#ipdChargeCategoryId'
                        : '#editIpdChargeCategoryId').empty();
                    $((!isChargeEdit)
                        ? '#ipdChargeCategoryId'
                        : '#editIpdChargeCategoryId').removeAttr('disabled');
                    $.each(data.data, function (i, v) {
                        $((!isChargeEdit)
                            ? '#ipdChargeCategoryId'
                            : '#editIpdChargeCategoryId').append($('<option></option>').attr('value', i).text(v));
                    });
                    if (!isChargeEdit)
                        $('#ipdChargeCategoryId').trigger('change');
                    else {
                        if (typeof onceOnEditRender == 'undefined')
                            $('#editIpdChargeCategoryId').trigger('change');
                        else {
                            $('#editIpdChargeCategoryId').val(editIpdChargeCategoryId).trigger('change', onceOnEditRender);
                        }
                    }
                    $((!isChargeEdit)
                        ? '#btnIpdChargeSave'
                        : '#btnEditCharges').prop('disabled', false);
                } else {
                    $((!isChargeEdit)
                        ? '#ipdChargeCategoryId, #ipdChargeId'
                        : '#editIpdChargeCategoryId, #editIpdChargeId').empty();
                    $((!isChargeEdit)
                        ? '#ipdStandardCharge, #ipdAppliedCharge'
                        : '#editIpdStandardCharge, #editIpdAppliedCharge').val('');
                    $((!isChargeEdit)
                        ? '#ipdChargeCategoryId, #ipdChargeId, #btnIpdChargeSave'
                        : '#editIpdChargeCategoryId, #editIpdChargeId, #btnEditCharges').prop('disabled', true);
                }
            },
        });
    }
    $((!isChargeEdit)
        ? '#ipdChargeCategoryId, #ipdChargeId'
        : '#editIpdChargeCategoryId, #editIpdChargeId').empty();
    $((!isChargeEdit)
        ? '#ipdStandardCharge, #ipdAppliedCharge'
        : '#editIpdStandardCharge, #editIpdAppliedCharge').val('');
    $((!isChargeEdit)
        ? '#ipdChargeCategoryId, #ipdChargeId'
        : '#editIpdChargeCategoryId, #editIpdChargeId').prop('disabled', true);
    $('#ipdChargeCategoryId ,#ipdChargeId').select2({
        width: '100%',
        placeholder: 'Choose Case',
        dropdownParent: $('#addIpdChargesModal')
    });
    $('#editIpdChargeCategoryId, #editIpdChargeId').select2({
        width: '100%',
        placeholder: 'Choose Case',
        dropdownParent: $('#editIpdChargesModal')
    })
});

listenHiddenBsModal('#addIpdChargesModal,#editIpdChargesModal', function () {
    $('#ipdChargeCategoryId ,#ipdChargeId,#editIpdChargeCategoryId, #editIpdChargeId').attr('disabled',true);
})

listenChange('#ipdChargeCategoryId, #editIpdChargeCategoryId', function (e, onceOnEditRender) {
    let isChargeEdit = $(this).data('is-charge-edit');
    if ($(this).val() !== '') {
        $.ajax({
            url: $('#showIpdChargeUrl').val(),
            type: 'get',
            dataType: 'json',
            data: {id: $(this).val()},
            beforeSend: function () {
                makeIpdChargesBtnDisabled(isChargeEdit);
            },
            success: function (data) {
                if (data.data.length !== 0) {
                    $((!isChargeEdit) ? '#ipdChargeId' : '#editIpdChargeId').empty();
                    $((!isChargeEdit) ? '#ipdChargeId' : '#editIpdChargeId').removeAttr('disabled');
                    $.each(data.data, function (i, v) {
                        $((!isChargeEdit)
                            ? '#ipdChargeId'
                            : '#editIpdChargeId').append($('<option></option>').attr('value', i).text(v));
                    });
                    if (!isChargeEdit)
                        $('#ipdChargeId').trigger('change');
                    else {
                        if (typeof onceOnEditRender == 'undefined')
                            $('#editIpdChargeId').trigger('change');
                        else
                            $('#editIpdChargeId').val(editIpdChargeId).trigger('change', onceOnEditRender);
                    }
                } else {
                    $((!isChargeEdit) ? '#ipdChargeId' : '#editIpdChargeId').prop('disabled', true);
                }
            },
        });
    }
    $((!isChargeEdit) ? '#ipdChargeId' : '#editIpdChargeId').empty();
    $((!isChargeEdit) ? '#ipdChargeId' : '#editIpdChargeId').prop('disabled', true);
});

listenChange('#ipdChargeId, #editIpdChargeId', function (e, onceOnEditRender) {
    let isChargeEdit = $(this).data('is-charge-edit');
    $.ajax({
        url: $('#showIpdChargeStandardRateUrl').val(),
        type: 'get',
        dataType: 'json',
        data: {
            id: $(this).val(),
            isEdit: isChargeEdit,
            onceOnEditRender: onceOnEditRender,
            ipdChargeId: $('#ipdChargesId').val(),
        },
        beforeSend: function () {
            makeIpdChargesBtnDisabled(isChargeEdit);
        },
        success: function (data) {
            if (!isChargeEdit) {
                $('#ipdStandardCharge, #ipdAppliedCharge').val(data.data);
                $('#btnIpdChargeSave').prop('disabled', false);
            } else {
                if (data.data != null) {
                    $('#editIpdStandardCharge').val(data.data.standard_charge);
                    $('#appliedChargeId').text(data.data.applied_charge);
                    $('#editIpdAppliedCharge').val(data.data.applied_charge);
                    $('.price-input').trigger('input');
                    $('#btnEditCharges').prop('disabled', false);
                }
                else {
                    console.log('from else')
                }
            }

        },
    });
});

listen('keypress', '#editIpdAppliedCharge', function (){
    let ipdAppliedChargeVal = $('#editIpdAppliedCharge').val()
    $('#appliedChargeId').text(ipdAppliedChargeVal)
})

listenSubmit('#addIpdChargeNewForm', function (event) {
    event.preventDefault();
    $('#btnIpdChargeSave').attr('disabled', true);

    var formData = new FormData($(this)[0]);
    $.ajax({
        url: $('#showIpdChargesCreateUrl').val(),
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function success(result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addIpdChargesModal').modal('hide');
                livewire.emit('refresh');
                $('#btnIpdChargeSave').attr('disabled', false);
            }
        },
        error: function error(result) {
            printErrorMessage('#ipdChargevalidationErrorsBox', result);
            $('#btnIpdChargeSave').attr('disabled', false);
        },
    });

});


listenSubmit('#editIpdChargesForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditCharges');
    loadingButton.button('loading');
    let id = $('#ipdChargesId').val();
    let url = $('#showIpdChargesUrl').val() + '/' + id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'POST',
    };
    editRecord(data, loadingButton, '#editIpdChargesModal',
        '#btnEditCharges');
});

listenHiddenBsModal('#addIpdChargesModal', function () {
    $('#addIpdChargeNewForm')[0].reset();
    $('#ipdChargeTypeId, #ipdChargeCategoryId, #ipdChargeId, #ipdStandardCharge, #ipdAppliedCharge').val('');
    $('#ipdChargeCategoryId, #ipdChargeId').empty();
    $('#ipdChargeCategoryId').append($('<option>Select Charge Category</option>'));
    $('#ipdChargeId').append($('<option>Select Code</option>'));
    $('#ipdChargeTypeId').trigger('change.select2');
    $('#btnIpdChargeSave').prop('disabled', true);
    $("#ipdChargeDate").flatpickr().clear();
});
listenHiddenBsModal('#editIpdChargesModal', function () {
    $('#btnEditCharges').prop('disabled', true);
});

function makeIpdChargesBtnDisabled(isChargeOnEdit) {
    $((!isChargeOnEdit) ? '#btnIpdChargeSave' : '#btnEditCharges').prop('disabled', true);
}
