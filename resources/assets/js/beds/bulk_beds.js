'use strict';

document.addEventListener('turbo:load', loadBedsBulkCreate)

function loadBedsBulkCreate () {

    if (!$('#bulkBedsForm').length) {
        return false;
    }

    dropdownToSelect2('.bedType');

}

function dropdownToSelect2 (selector) {
    $(selector).select2({
        placeholder: 'Select Bed Type',
        width: '100%',
    })
}

listenClick('#addNewBedItem', function () {
    let uniqueId = $('#uniqueId').val()
    let data = {
        'bedTypes': JSON.parse($('#bedTypes').val()),
        'uniqueId': uniqueId,
    }
    let bulkBedItemHtml = prepareTemplateRender(
        '#bulkBedActionTemplate', data)
    $('.bulk-beds-item-container').append(bulkBedItemHtml)
    dropdownToSelect2('.bedType');
    uniqueId++;
    $('#uniqueId').val(uniqueId);
    resetBulkBedItemIndex();
});

function resetBulkBedItemIndex(){
    let index = 1;
    $('.bulk-beds-item-container>tr').each(function () {
        $(this).find('.item-number').text(index);
        index++;
    });
    if (index - 1 == 0) {
        let uniqueId = $('#uniqueId').val();
        let data = {
            'services': JSON.parse($('#bedTypes').val()),
            'uniqueId': uniqueId,
        };
        let bulkBedItemHtml = prepareTemplateRender(
            '#bulkBedActionTemplate', data);
        $('.bulk-beds-item-container').append(bulkBedItemHtml);
        dropdownToSelect2('.bedType');
        uniqueId++;
    }
}

listenClick('.delete-invoice-item', function () {
    $(this).parents('tr').remove();
    resetBulkBedItemIndex();
});

listenSubmit('#bulkBedsForm', function (event) {
    event.preventDefault();
    // screenLock();
    $('.bulk-button').prop('disabled',true)
    let formData = new FormData($(this)[0]);
    $.ajax({
        url: $('#bulkBedSaveUrl').val(),
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message);
            $('.bulk-button').prop('disabled',false)
            window.location.href = $('#bulkBedUrl').val();
        },
        error: function (result) {
            printErrorMessage('#validationErrorsBox', result);
            $('.bulk-button').prop('disabled',false)
        },
        // complete: function () {
        //     screenUnLock();
        // },
    });
});

