document.addEventListener('turbo:load', loadIpdPrescriptionData)

function loadIpdPrescriptionData () {
    if (!$('#editIpdPrescriptionForm').length &&
        !$('#addIpdPrescriptionForm').length) {
        return
    }
}

listen('click', '.deleteIpdPrescriptionBtn', function (event) {
    let id = $(event.currentTarget).attr('data-id')
    deleteItem($('#showIpdPrescriptionUrl').val() + '/' + id, '',
        $('#ipdPrescription').val())
})

const dropdownToSelect2 = (selector) => {
    if (selector === '#ipdPrescriptionItemTemplate') {
        $('.ipdCategoryId').select2({
            placeholder: 'Select Category',
            width: '100%',
            dropdownParent: $('#addIpdPrescriptionModal'),
        })
    } else {
        $('.ipdCategoryId').select2({
            placeholder: 'Select Category',
            width: '100%',
            dropdownParent: $('#editIpdPrescriptionModal'),
        })
    }
}

dropdownToSelect2('#ipdPrescriptionItemTemplate')

const medicineSelect2 = (selector) => {
    if (selector === 'addIpdPrescriptionModal') {
        $('.medicineId').select2({
            placeholder: 'Select Category',
            width: '100%',
            dropdownParent: $('#addIpdPrescriptionModal'),
        })
    } else {
        $('.medicineId').select2({
            placeholder: 'Select Medicine',
            width: '100%',
            dropdownParent: $('#editIpdPrescriptionModal'),
        })
    }
}

listenClick('#addPrescriptionItem, #addPrescriptionItemOnEdit',
    function () {
        const itemSelector = (parseInt($(this).data('edit')))
            ? '#editIpdPrescriptionItemTemplate'
            : '#ipdPrescriptionItemTemplate'
        const tbodyItemSelector = (parseInt($(this).data('edit')))
            ? '.edit-ipd-prescription-item-container'
            : '.ipd-prescription-item-container'
        let uniqueId = $('#showIpdUniqueId').val()
        let data = {
            'medicineCategories': JSON.parse(
                $('#showMedicineCategories').val()),
            'uniqueId': uniqueId,
        }
        let ipdPrescriptionItemHtml = prepareTemplateRender(
            itemSelector, data)
        $(tbodyItemSelector).append(ipdPrescriptionItemHtml)
        dropdownToSelect2(itemSelector)
        uniqueId++
        $('#showIpdUniqueId').val(uniqueId)

        resetIpdPrescriptionItemIndex(parseInt($(this).data('edit')))
    })

const resetIpdPrescriptionItemIndex = (itemMode) => {
    const itemSelector = (itemMode)
        ? '#editIpdPrescriptionItemTemplate'
        : '#ipdPrescriptionItemTemplate'
    const tbodyItemSelector = (itemMode)
        ? '.edit-ipd-prescription-item-container'
        : '.ipd-prescription-item-container'
    const itemNo = (itemMode)
        ? '.edit-prescription-item-number'
        : '.prescription-item-number'

    let index = 1
    $(tbodyItemSelector + '>tr').each(function () {
        $(this).find(itemNo).text(index)
        index++
    })
    let uniqueId = $('#showIpdUniqueId').val()
    if (index - 1 == 0) {
        let data = {
            'medicineCategories': JSON.parse(
                $('#showMedicineCategories').val()),
            'uniqueId': uniqueId,
        }
        let ipdPrescriptionItemHtml = prepareTemplateRender(
            itemSelector, data)
        $(tbodyItemSelector).append(ipdPrescriptionItemHtml)
        dropdownToSelect2(itemSelector)
        uniqueId++
    }
}

listenClick('.editIpdPrescriptionBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return
    }
    ajaxCallInProgress()
    let ipdPrescriptionId = event.currentTarget.dataset.id
    renderOpdPrescriptionData(ipdPrescriptionId)
})

listenClick('.deleteIpdPrescription, .deleteIpdPrescriptionOnEdit',
    function () {
        $(this).parents('tr').remove()
        resetIpdPrescriptionItemIndex(parseInt($(this).data('edit')))
    })

listenChange('.ipdCategoryId', function (e, rData) {
    const medicineId = $(document).find('[data-medicine-id=\'' + $(this).data('id') + '\']')
    if ($(this).val() !== '') {
        $.ajax({
            url: $('#showMedicinesListUrl').val(),
            type: 'get',
            dataType: 'json',
            data: { id: $(this).val() },
            success: function (data) {
                if (data.data.length !== 0) {
                    medicineId.empty()
                    medicineId.removeAttr('disabled')
                    $.each(data.data, function (i, v) {
                        medicineId.
                            append($('<option></option>').
                                attr('value', i).
                                text(v))
                    })
                    if ($('.modal').hasClass('show')) {
                        medicineSelect2($('.modal.fade.show').attr('id'))
                    }
                    if (typeof rData != 'undefined') {
                        medicineId.val(rData.medicineId).
                            trigger('change.select2')
                    }
                } else {
                    medicineId.append($('<option></option>').
                        text('Select Medicine'))
                }
            },
        })
    }
    medicineId.empty()
    medicineId.prop('disabled', true)
})

function renderOpdPrescriptionData (id) {
    $.ajax({
        url: $('#showIpdPrescriptionUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let ipdPrescriptionData = result.data.ipdPrescription
                let ipdPrescriptionItemsData = result.data.ipdPrescriptionItems
                $('#ipdEditPrescriptionId').val(ipdPrescriptionData.id)
                $('#editHeaderNote').val(ipdPrescriptionData.header_note)
                $('#editFooterNote').val(ipdPrescriptionData.footer_note)

                $.each(ipdPrescriptionItemsData, function (i, v) {
                    $('#addPrescriptionItemOnEdit').trigger('click')
                    let rowId = $('#showIpdUniqueId').val() - 1
                    $(document).
                        find('[data-id=\'' + rowId + '\']').
                        val(v.category_id).
                        trigger('change', [{ medicineId: v.medicine_id }])
                    $(document).
                        find('[data-dosage-id=\'' + rowId + '\']').
                        val(v.dosage)
                    $(document).
                        find('[data-instruction-id=\'' + rowId + '\']').
                        val(v.instruction)
                })

                let index = 1
                $('.edit-ipd-prescription-item-container>tr').
                    each(function () {
                        $(this).
                            find('.prescription-item-number').
                            text(index)
                        index++
                    })

                $('#editIpdPrescriptionModal').modal('show')
                ajaxCallCompleted()
            }
        },
        error: function (result) {
            manageAjaxErrors(result)
        },
    })
}

listenClick('.printIpdPrescription', function () {
    let divToPrint = document.getElementById('DivIdToPrint')
    let newWin = window.open('', 'Print-Window')
    newWin.document.open()
    newWin.document.write(
        '<html><link href="' + $('#showIpdBootstrapUrl').val() +
        '" rel="stylesheet" type="text/css"/>' +
        '<body onload="window.print()">' + divToPrint.innerHTML +
        '</body></html>')
    newWin.document.close()
    setTimeout(function () {
        newWin.close()
    }, 1000000)
})

listenHiddenBsModal('#addIpdPrescriptionModal', function () {
    resetModalForm('#addIpdPrescriptionForm', '#validationErrorsBox')
    $('#ipdPrescriptionTbl').find('tr:gt(1)').remove()
    $('.ipdCategoryId').val('')
    $('.ipdCategoryId').trigger('change')
})

listenShownBsModal('#addIpdPrescriptionModal', function () {
    medicineSelect2('.medicineId')
    dropdownToSelect2('#ipdPrescriptionItemTemplate')
})

listenHiddenBsModal('#editIpdPrescriptionModal', function () {
    $('#editIpdPrescriptionTbl').find('tr:gt(0)').remove()
    resetModalForm('#editIpdPrescriptionForm',
        '#editIpdPrescriptionErrorsBox')
})

listenClick('.viewIpdPrescription', function (event) {
    let ipdPrescriptionShowId = event.currentTarget.dataset.id
    $.ajax({
        url: $('#showIpdPrescriptionUrl').val() + '/' +
            ipdPrescriptionShowId,
        type: 'get',
        beforeSend: function () {
            screenLock()
        },
        success: function (result) {
            $('#ipdPrescriptionViewData').html(result)
            $('#showIpdPrescriptionModal').modal('show')
            ajaxCallCompleted()
        },
        complete: function () {
            screenUnLock()
        },
    })
})

listenSubmit('#addIpdPrescriptionForm', function (event) {
    event.preventDefault()
    if (checkOpdMedicine() !== true) {
        return false
    }
    let loadingButton = jQuery(this).find('#btnIpdPrescriptionSave')
    loadingButton.button('loading')
    let data = {
        'formSelector': $(this),
        'url': $('#showIpdPrescriptionCreateUrl').val(),
        'type': 'POST',
    }
    newRecord(data, loadingButton, '#addIpdPrescriptionModal')
})

function checkOpdMedicine () {
    let result = true
    $('.medicineId').each(function xyz () {
        if ($(this).val() == 'Select Medicine') {
            displayErrorMessage('Medicine field is required')
            result = false
            return false
        }
    })
    return result
}

listenSubmit('#editIpdPrescriptionForm', function (event) {
    event.preventDefault()
    if (checkOpdMedicine() !== true) {
        return false
    }
    let loadingButton = jQuery(this).find('#btnEditIpdPrescriptionSave')
    loadingButton.button('loading')
    let id = $('#ipdEditPrescriptionId').val()
    let url = $('#showIpdPrescriptionUrl').val() + '/' + id
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'POST',
        // 'tableSelector': tableName,
    }
    editRecord(data, loadingButton, '#editIpdPrescriptionModal')
})
