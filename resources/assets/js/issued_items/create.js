document.addEventListener('turbo:load', loadIssuedItems)

function loadIssuedItems() {
    $('#issueItemCategory, #issueUserType').select2({
        width: '100%',
    });
    $('#issueTo').select2({
        placeholder: 'Select User',
        width: '100%',
    });
    $('#issueItems').select2({
        placeholder: 'Select Item',
        width: '100%',
    });

    let returnDate = $('#issueReturnDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        sideBySide: true,
        locale : $('.userCurrentLanguage').val(),
    });

    $('#issueDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        locale : $('.userCurrentLanguage').val(),
        onChange: function(selectedDates, dateStr, instance) {
            let minDate = moment($('#issueDate').val()).add(1, 'days').format();
            returnDate.set('minDate', minDate);
        }
    });

    $('#issueDate').on('dp.change', function (e) {
        let minDate = moment($('#issueDate').val()).add(1, 'days');
        $('#issueReturnDate').data('DateTimePicker').minDate(minDate);
    });

    setTimeout(function () {
        $('#issueItemCategory, #issueUserType').trigger('change');
    }, 300);
};

listenChange('#issueItemCategory', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: $('#issuedItemsUrl').val(),
            type: 'get',
            dataType: 'json',
            data: {id: $(this).val()},
            success: function (data) {
                if (data.data.length !== 0) {
                    $('#issueItems').empty();
                    $('#issueItems').removeAttr('disabled');
                    $.each(data.data, function (i, v) {
                        $('#issueItems').append($('<option></option>').attr('value', i).text(v));
                    });
                    $('#issueItems').trigger('change');
                } else {
                    $('#issueItems').prop('disabled', true);
                    $('#itemQuantity').prop('disabled', true);
                    $('#itemQuantity').val('');
                    $('#showAvailableQuantity').text('0');
                    $('#itemAvailableQuantity').val(0);
                }
            },
        });
    }
    $('#issueItems').empty();
    $('#issueItems').append('<option>Select Items</option>');
    $('#issueItems').prop('disabled', true);
});

listenChange('#issueUserType', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: $('#itemIssuedUsersUrl').val(),
            type: 'get',
            dataType: 'json',
            data: {id: $(this).val()},
            success: function (data) {
                if (data.data.length !== 0) {
                    $('#issueTo').empty();
                    $('#issueTo').removeAttr('disabled');
                    $.each(data.data, function (i, v) {
                        $('#issueTo').append($('<option></option>').attr('value', i).text(v));
                    });
                } else
                    $('#issueTo').prop('disabled', true);
            },
        });
    }
    $('#issueTo').empty();
    $('#issueTo').append('<option>Select User</option>');
    $('#issueTo').prop('disabled', true);
});

listenChange('#issueItems', function () {
    $.ajax({
        url: $('#issuedItemAvailableQtyUrl').val(),
        type: 'get',
        dataType: 'json',
        data: {id: $(this).val()},
        success: function (data) {
            $('#itemAvailableQuantity').val(data);
            $('#showAvailableQuantity').text(data);
            $('#itemQuantity').attr('max', data);
            $('#itemQuantity').attr('disabled', false);
        },
    });
});

listenChange('#itemQuantity', function () {
    let availableQuantity = parseInt($('#itemAvailableQuantity').val());
    let quantity = parseInt($(this).val());
    if (quantity <= availableQuantity) {
        $('#issuedItemSave').prop('disabled', false);
    } else if (quantity === 0)
        showIssueItemError('Quantity cannot be zero.');
    else
        showIssueItemError('Quantity must be less than Available quantity.');
});

function showIssueItemError(message) {
    toastr.error(message);
    $('#issuedItemSave').prop('disabled', true);
};

listenSubmit('#createIssuedItemForm, #editIssuedItemForm', function () {
    $('#issuedItemSave').attr('disabled', true);
});
