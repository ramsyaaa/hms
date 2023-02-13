document.addEventListener('turbo:load', loadIpdConsultantData)

function loadIpdConsultantData() {
    if (!$('#showIpdConsultantRegisterUrl').length) {
        return
    }

    $('.doctorId',).select2({
        width: '100%',
        dropdownParent: $('#addConsultantInstructionModal')
    });

    $('#editConsultantDoctorId').select2({
        width: '100%',
        dropdownParent: $('#editIpdConsultantInstructionModal')
    })
    
    addDateTimePicker();
}
const removeReadOnlyAttrInDate = (selector) => {
    $(selector).attr('readonly', false);
};

removeReadOnlyAttrInDate('.appliedDate');
removeReadOnlyAttrInDate('.instructionDate');

const addDateTimePicker = () => {
    $('.appliedDate').flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        useCurrent: false,
        sideBySide: true,
        allowInput: false,
        widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom',
        },
        minDate: $('#showIpdPatientCaseDate').val(),
        locale : $('.userCurrentLanguage').val(),
    });

    $('.instructionDate').flatpickr({
        enableTime: false,
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom',
        },
        minDate: $('#showIpdPatientCaseDate').val(),
    });
};



const dropdownToSelect2 = (selector) => {
    $(selector).select2({
        placeholder: 'Select Doctor',
        width: '100%',
        dropdownParent: $('#addConsultantInstructionModal')
    });
};

listen('click', '#addIpdConsultantItem', function () {
    let uniqueId = $('#showIpdUniqueId').val();
    let data = {
        'doctors': JSON.parse($('#showIpdDoctors').val()),
        'uniqueId': uniqueId,
    };
    let ipdConsultantItemHtml = prepareTemplateRender(
        '#ipdConsultantInstructionItemTemplate', data);
    $('.ipd-consultant-item-container').append(ipdConsultantItemHtml);

    dropdownToSelect2('.doctorId');
    addDateTimePicker();
    // removeReadOnlyAttrInDate('.appliedDate');
    // removeReadOnlyAttrInDate('.instructionDate');
    uniqueId++;

    resetIpdConsultantItemIndex();
});

const resetIpdConsultantItemIndex = () => {
    let index = 1;
    let uniqueId = $('#showIpdUniqueId').val();

    $('.ipd-consultant-item-container>tr').each(function () {
        $(this).find('.item-number').text(index);
        index++;
    });
    if (index - 1 == 0) {
        let data = {
            'doctors': JSON.parse($('#showIpdDoctors').val()),
            'uniqueId': uniqueId,
        };
        let ipdConsultantItemHtml = prepareTemplateRender(
            '#ipdConsultantInstructionItemTemplate', data);
        $('.ipd-consultant-item-container').append(ipdConsultantItemHtml);
        dropdownToSelect2('.doctorId');
        addDateTimePicker();
        uniqueId++;
    }
};

listen('click', '.deleteIpdConsultantInstruction', function () {
    $(this).parents('tr').remove();
    resetIpdConsultantItemIndex();
});

listen('click', '.delete-consultant-btn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('#showIpdConsultantRegisterUrl').val() + '/' + id, '',
        $('#ipdConsultantRegister').val());
});

listenSubmit('#addIpdConsultantNewForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnIpdConsultantSave');
    loadingButton.button('loading');
    let data = {
        'formSelector': $(this),
        'url': $('#showIpdConsultantRegisterCreateUrl').val(),
        'type': 'POST',
        // 'tableSelector': tableName,
    };
    newRecord(data, loadingButton, '#addConsultantInstructionModal');
    loadingButton.attr('disabled', false);
});

listen('click', '.edit-consultant-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let ipdConsultantId = $(event.currentTarget).attr('data-id');
    renderIpdConsultantData(ipdConsultantId);
});

function renderIpdConsultantData(id) {
    $.ajax({
        url: $('#showIpdConsultantRegisterUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#ipdEditConsultantId').val(result.data.id);
                document.querySelector('#editConsultantAppliedDate')._flatpickr.setDate(moment(result.data.applied_date).format());
                $('#editConsultantDoctorId').val(result.data.doctor_id).trigger('change.select2');
                $('#editConsultantDoctorId').select2({
                    width: '100%',
                    dropdownParent: $('#editIpdConsultantInstructionModal')
                })
                document.querySelector('#editConsultantInstructionDate')._flatpickr.setDate(moment(result.data.instruction_date).format());
                $('#editConsultantInstruction').val(result.data.instruction);
                $('#editIpdConsultantInstructionModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenSubmit('#editIpdConsultantNewForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#editConsultantSave');
    loadingButton.button('loading');
    let id = $('#ipdEditConsultantId').val();
    let url = $('#showIpdConsultantRegisterUrl').val() + '/' + id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'POST',
        // 'tableSelector': tableName,
    };
    editRecord(data, loadingButton, '#editIpdConsultantInstructionModal');
});

listenHiddenBsModal('#addConsultantInstructionModal', function () {
    resetModalForm('#addIpdConsultantNewForm', '#ipdConsultantErrorsBox');
    $('#ipdConsultantInstructionTbl').find('tr:gt(1)').remove();
    $('.doctorId').val('');
    $('.doctorId').trigger('change');
});
