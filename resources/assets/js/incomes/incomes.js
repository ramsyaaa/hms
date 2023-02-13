document.addEventListener('turbo:load', loadIncome)

function loadIncome () {

    if (!$('#addIncomeForm').length && !$('#editIncomesForm').length) {
        return
    }

    listenShownBsModal('#add_incomes_modal, #edit_incomes_modal', function () {
        $('#incomeId, #editIncomeHeadId:first').focus()

        $('#incomeId').select2({
            width: '100%',
            dropdownParent: $('#add_incomes_modal'),
        })
        $('#editIncomeHeadId').select2({
            width: '100%',
            dropdownParent: $('#edit_incomes_modal'),
        });
    })
    
    $('#incomeHead').select2({
        width: '100%',
    })

    $('#incomeDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        sideBySide: false,
        locale : $('.userCurrentLanguage').val(),
    });

    let editDate = $('#editIncomeDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        sideBySide: false,
        locale : $('.userCurrentLanguage').val(),
    })

}

listenSubmit('#addIncomeForm', function (event) {
    event.preventDefault()
    $('#incomeSave').attr('disabled', true)
    var loginButton = jQuery(this).find('#incomeSave')
    loginButton.button('loading')
    $.ajax({
        url: $('#indexIncomeCreateUrl').val(),
        type: 'POST',
        data: new FormData(this),
        dataType: 'JSON',
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#add_incomes_modal').modal('hide')
                $('#incomeSave').attr('disabled', false)
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            // $('#incomeSave').attr('disabled', false)
            // printErrorMessage('#incomeErrorsBox', result)
            // displayErrorMessage($('#incomeErrorsBox').text())
            manageAjaxErrors(result)
            $('#incomeSave').attr('disabled', false)
        },
        complete: function () {
            loginButton.button('reset')
        },
    })
})

listenClick('.deleteIncomesBtn', function (event) {
    let deleteIncomeId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexIncomeUrl').val() + '/' + deleteIncomeId, null,
        $('#Income').val())
})

listenClick('#incomeResetFilter', function () {
    $('#incomeHead').val(0).trigger('change')
    hideDropdownManually($('#incomeFilterBtn'), $('.dropdown-menu'))
})

    listenClick('.editIncomesBtn', function (event) {
        let id = event.currentTarget.dataset.id
        renderIncomeData(id);
    });

function renderIncomeData (id) {
    $.ajax({
        url: $('#indexIncomeUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let ext = result.data.document_url.split('.').
                    pop().
                    toLowerCase()
                if (ext == 'pdf') {
                    $('#editIncomePreviewImage').css('background-image',
                        'url("' + $('.pdfDocumentImageUrl').val() + '")')
                } else if ((ext == 'docx') || (ext == 'doc')) {
                    $('#editIncomePreviewImage').css('background-image',
                        'url("' + $('.docxDocumentImageUrl').val() + '")')
                } else if (ext == '') {
                    $('#editIncomePreviewImage').css('background-image',
                        'url("' +
                        $('#indexIncomeDefaultDocumentImageUrl').val() + '")')
                } else {
                    $('#editIncomePreviewImage').css('background-image',
                        'url("' + result.data.document_url + '")')

                }

                $('#editIncomeId').val(result.data.id)
                $('#editIncomeHeadId').
                    val(result.data.income_head).
                    trigger('change.select2')
                $('#editIncomeName').val(result.data.name)
                document.querySelector('#editIncomeDate').
                    _flatpickr.
                    setDate(moment(result.data.date).format())
                $('#editIncomeInvoiceNumber').
                    val(result.data.invoice_number)
                $('#editIncomeAmount').val(result.data.amount)
                $('.price-input').trigger('input')
                $('#editIncomeDescription').val(result.data.description)
                if (isEmpty(result.data.document_url)) {
                    $('#editIncomeDocumentUrl').hide()
                    $('.btn-view').hide()
                } else {
                    $('#editIncomeDocumentUrl').show()
                    $('.btn-view').show()
                    $('#editIncomeDocumentUrl').
                        attr('href', result.data.document_url)
                }
                $('#edit_incomes_modal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            manageAjaxErrors(result)
        },
    })
}

listenSubmit('#editIncomesForm', function (event) {
    event.preventDefault()
    $('#editIncomeSave').attr('disabled', true)
    let loadingButton = jQuery(this).find('#editIncomeSave')
    loadingButton.button('loading')
    let id = $('#editIncomeId').val()
    let url = $('#indexIncomeUrl').val() + '/' + id + '/update'
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'POST',
        'tableSelector': null,
    }
    Livewire.emit('refresh')
    editRecord(data, loadingButton, '#edit_incomes_modal')
    $('#avatar_remove').val('')
})

listenHiddenBsModal('#add_incomes_modal', function () {
    resetModalForm('#addIncomeForm', '#incomeErrorsBox')
    $('#incomeSave').attr('disabled', false)

    $('#incomeId').val('').trigger('change.select2')
    // $('#previewImage').attr('src', $('#indexIncomeDefaultDocumentImageUrl').val());
    $('#incomePreviewImage').css('background-image',
        'url("' + $('#indexIncomeDefaultDocumentImageUrl').val() + '")')
})

listenHiddenBsModal('#edit_incomes_modal', function () {
    resetModalForm('#editIncomesForm', '#editIncomeErrorsBox')
    $('#editIncomeSave').attr('disabled', false)
})

// listenChange('#incomeAttachment', function () {
//     let extension = isValidIncomeDocument($(this), '#incomeErrorsBox')
//     if (!isEmpty(extension) && extension != false) {
//         $('#incomeErrorsBox').html('').hide()
//         displayDocument(this, '#incomePreviewImage', extension)
//     }
// })

listenChange('#editIncomeAttachment', function () {
    let extension = isValidIncomeDocument($(this), '#editIncomeErrorsBox')
    if (!isEmpty(extension) && extension != false) {
        $('#editIncomeErrorsBox').html('').hide()
        displayDocument(this, '#editIncomePreviewImage', extension)
    }
    else {
        $(this).val('');
        $('#editIncomeErrorsBox').removeClass('d-none hide');
        $('#editIncomeErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=customValidationErrorsBox]').focus();
        $("html, body").animate({ scrollTop: "0" },  500);
        $('.alert').delay(5000).slideUp(300)
    }
})

window.isValidIncomeDocument = function (
    inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase()
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) ==
        -1) {
        $(inputSelector).val('')
        $(validationMessageSelector).
            html($('#indexIncomeDocumentError').val()).
            show()
        return false
    }
    return ext
}

listenClick('.removeIncomesImage', function () {
    defaultImagePreview('#incomePreviewImage')
})
listenClick('.removeIncomesImageEdit', function () {
    defaultImagePreview('#editIncomePreviewImage')
})
listenChange('#incomeHead', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
})

 
    



