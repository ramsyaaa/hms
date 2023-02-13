document.addEventListener('turbo:load', loadServiceEditData)

function loadServiceEditData() {
    if (!$('#createServiceForm').length && !$('#editServiceForm').length) {
        return
    }
    $('#serviceStatus').select2({
        width: '100%',
    });

    $('.price-input').trigger('input');

    $(window).on('beforeunload', function () {
        $('input[type=submit]').prop('disabled', 'disabled');
    });

    $('#createServiceForm, #editServiceForm').find('input:text:visible:first').focus();
}
    listenSubmit('#createServiceForm, #editServiceForm', function () {
        $('#serviceBtnSave').attr('disabled', true);
    });

