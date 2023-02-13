document.addEventListener('turbo:load', loadItemStocks)

function loadItemStocks() {

    if (!$('#stockItemCategory').length && !$('#editStockItemCategory').length) {
        return
    }

    $('#stockItemCategory, #editStockItemCategory').select2({
        width: '100%',
    });

    $('#stockItems, #editStockItems').select2({
        width: '100%',
        placeholder: 'Select Item',
    });

    if ($('.isEdit').val()) {
        $('.price-input').trigger('input');
        setTimeout(function () {
            $('#stockItemCategory, #editStockItemCategory').trigger('change');
        }, 300);
    }

}

listenChange('.stockCategory', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: $('.itemsUrl').val(),
            type: 'get',
            dataType: 'json',
            data: {id: $(this).val()},
            success: function (data) {
                if (data.data.length !== 0) {
                    $('.stockItems').empty();
                    $('.stockItems').removeAttr('disabled');
                    $.each(data.data, function (i, v) {
                        $('.stockItems').append($('<option></option>').attr('value', i).text(v));
                    });
                    if ($('.isEdit').val()) {
                        $('.stockItems').val($('#editStockItemId').val()).trigger('change.select2');
                        isEdit = false;
                    }
                } else
                    $('.stockItems').prop('disabled', true);
            },
        });
    }
    $('.stockItems').empty();
    $('.stockItems').prop('disabled', true);
});

// listenChange('.stockAttachment', function () {
//     let extension = isValidItemStockDocument($(this));
//     if (!isEmpty(extension) && extension != false) {
//         displayDocument(this, '.previewImage', extension);
//     }
// });

// function isValidItemStockDocument(inputSelector) {
//     let ext = $(inputSelector).val().split('.').pop().toLowerCase();
//     if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
//         $(inputSelector).val('');
//         UnprocessableInputError('result');
//         return false;
//     }
//     return ext;
// }

listenClick('.removeStockImage', function () {
    defaultImagePreview('.previewImage');
});
