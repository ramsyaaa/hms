document.addEventListener('turbo:load', loadPostal)

const addModal = $('.add_modal').val();
const editModal = $('.edit_modal').val();
let editPostalDate;

function loadPostal() {

    if (!$('.editPostalDate').length) {
        return
    }
    $('.date, .editPostalDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        locale : $('.userCurrentLanguage').val(),
    });

    editPostalDate = $('.editPostalDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        sideBySide: false,
        locale : $('.userCurrentLanguage').val(),
    });
}

listenSubmit('.addPostalForm', function (event) {
    event.preventDefault();
    $('.btnPostalSave').attr('disabled', true);
    let loadingButton = jQuery(this).find('.btnPostalSave');
    loadingButton.button('loading');
    let formData = new FormData($(this)[0]);
    $.ajax({
        url: $('.postalCreateUrl').val(),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                if ($('#add_postal_receives_modal').length ||
                    $('#edit_postal_receives_modal').length) {
                    $('#add_postal_receives_modal,#edit_postal_receives_modal').
                        modal('hide')
                }
                if ($('#add_postal_dispatch_modal').length ||
                    $('#edit_postal_dispatch_modal').length) {
                    $('#add_postal_dispatch_modal,#edit_postal_dispatch_modal').
                        modal('hide')
                }
                
                Livewire.emit('refresh')
                setTimeout(function () {
                    $('.btnPostalSave').attr('disabled', false)
                    loadingButton.button('reset')
                }, 1000)
            }
            },
            error: function (result) {
                printErrorMessage('.validationErrorsBox', result);
                setTimeout(function () {
                    $('.btnPostalSave').attr('disabled', false);
                    loadingButton.button('reset');
                }, 1000);
            },
        });
    });

listenClick('.delete-postal-btn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('.postalUrl').val() + '/' + id, '', $('.name').val());
});

listenClick('.edit-postal-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let postalId = event.currentTarget.dataset.id
    postalRenderData(postalId);
});

function postalRenderData(id) {
    $.ajax({
        url: $('.postalUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {

                if (result.data.document_url != '') {
                    let ext = result.data.document_url.split('.').pop().toLowerCase();
                    if (ext === 'pdf') {
                        $('.editPreviewImage').css('background-image',
                                'url("' + $('.pdfDocumentImageUrl').val() + '")');
                        } else if ((ext === 'docx') || (ext === 'doc')) {
                            $('.editPreviewImage').css('background-image',
                                'url("' + $('.docxDocumentImageUrl').val() + '")');
                        } else if (ext === '') {
                            $('.editPreviewImage').css('background-image',
                                'url("' + $('.defaultDocumentImageUrl').val() + '")');
                        } else {
                            $('.editPreviewImage').css('background-image',
                                'url("' + result.data.document_url + '")');
                        }
                    }

                    $($('.hiddenId').val()).val(result.data.id);
                $('.editFromTitle').val(result.data.from_title);
                editPostalDate.setDate(format(result.data.date, 'YYYY-MM-DD'));

                // $('#editDate').
                //     val(result.data.date ? format(result.data.date, 'YYYY-MM-DD') : '');
                $('.editReferenceNumber').val(result.data.reference_no)
                $('.editToTitle').val(result.data.to_title)
                $('.editAddress').val(result.data.address)
                if (isEmpty(result.data.document_url)) {
                    $('.edit-attachment').addClass('d-none')
                } else {
                    $('.documentUrl').attr('href', result.data.document_url)
                }
                if ($('#edit_postal_receives_modal').length) {
                    $('#edit_postal_receives_modal').modal('show')
                }
                if ($('#edit_postal_dispatch_modal').length) {
                    $('#edit_postal_dispatch_modal').modal('show')
                }
                ajaxCallCompleted()
            }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

listenSubmit('.editPostalForm', function (event) {
    event.preventDefault();
    $('.btnEditSave').attr('disabled', true);
    let loadingButton = jQuery(this).find('.btnEditSave');
    loadingButton.button('loading')
    // if($('.editFromTitle').val().trim().length === 0){
    //     displayErrorMessage('The from title is required.');
    //     $('.btnEditSave').attr('disabled', false);
    //     return false;
    // }

    if($('.isPostal').val() == 1)
    {
        if($('.editFromTitle').val().trim().length === 0){
            displayErrorMessage('The from title is required.');
            $('.btnEditSave').attr('disabled', false);
            return false;
        }
    }
    if($('.isPostal').val() == 2)
    {
        if($('.editToTitle').val().trim().length === 0){
            displayErrorMessage('The to title is required.');
            $('.btnEditSave').attr('disabled', false);
            return false;
        }
    }
    let id = $($('.hiddenId').val()).val()
    let url = $('.postalUrl').val() + '/' + id
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'post',
        'tableSelector': $('.tableName').val(),
    }
    editRecord(data, loadingButton)
    if ($('#edit_postal_receives_modal').length) {
        $('#edit_postal_receives_modal').modal('hide')
    }
    if ($('#edit_postal_dispatch_modal').length) {
        $('#edit_postal_dispatch_modal').modal('hide')
    }
    $('.btnEditSave').attr('disabled', false)
});

listenChange('.postalAttachment', function () {
    let extension = postalIsValidDocument($(this), '.validationErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('.validationErrorsBox').html('').hide();
        displayDocument(this, '.previewImage', extension);
    }
});

    // listenChange('.editAttachment', function () {
    //     if ($('#edit_postal_receives_modal').length) {
    //         var editModalAttachment = $('#edit_postal_receives_modal')
    //     }
    //     if ($('#edit_postal_dispatch_modal').length) {
    //         editModalAttachment = $('#edit_postal_dispatch_modal')
    //     }
    //
    //     let extension = postalIsValidDocument($(this), '#editReceiveErrorsBox1')
    //     if (!isEmpty(extension) && extension != false) {
    //         displayDocument(this, '.editPreviewImage', extension)
    //     }
    //
    // });

function postalIsValidDocument(
    inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) ==
        -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).html($('.documentError').val()).removeClass('hide');
        $(validationMessageSelector).removeAttr('style');
        return false;
    }

    $(validationMessageSelector).
        html($('.documentError').val()).
        addClass('hide')
    return ext
}
listenClick('.remove-postal-image', function () {
    defaultImagePreview('.previewImage')
})
listenClick('.remove-postal-image-edit', function () {
    defaultImagePreview('.editPreviewImage')
})

listenHiddenBsModal('#add_postal_dispatch_modal', function () {
    resetModalForm('#addDispatchForm', '.validationErrorsBox')
    $('.previewImage').
        css('background-image',
            'url("' + $('.defaultDocumentImageUrl').val() + '")')
})

listenHiddenBsModal('#edit_postal_dispatch_modal', function () {
    resetModalForm('#editDispatchForm', '.editValidationErrorsBox1')
    $('.editPreviewImage').
        css('background-image',
            'url("' + $('.defaultDocumentImageUrl').val() + '")')
})

listenHiddenBsModal('#add_postal_receives_modal', function () {
    resetModalForm('#addReceiveForm', '.validationErrorsBox')
    $('.previewImage').
        css('background-image',
            'url("' + $('.defaultDocumentImageUrl').val() + '")')
})

listenHiddenBsModal('#edit_postal_receives_modal', function () {
    resetModalForm('#editReceiveForm', '.editValidationErrorsBox1')
    $('.editPreviewImage').
        css('background-image',
            'url("' + $('.defaultDocumentImageUrl').val() + '")')
})

