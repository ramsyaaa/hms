document.addEventListener('turbo:load', loadMedicineCreateData)

'use strict';

function loadMedicineCreateData()
{
    listenClick('.showMedicineBtn', function (event) {
        event.preventDefault()
        let medicineId = $(event.currentTarget).attr('data-id');
        renderMedicineData(medicineId);
    });

    function renderMedicineData(id) {
        $.ajax({
            url: $('#medicinesShowModal').val() + '/' + id,
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#showMedicineName').text(result.data.name);
                    $('#showMedicineBrand').text(result.data.brand_name);
                    $('#showMedicineCategory').text(result.data.category_name);
                    $('#showMedicineSaltComposition').text(result.data.salt_composition);
                    $('#showMedicineSellingPrice').text(result.data.selling_price);
                    $('#showMedicineBuyingPrice').text(result.data.buying_price);
                    $('#showMedicineSideEffects').text(result.data.side_effects);
                    moment.locale($('#medicineLanguage').val());
                    let createDate = moment(result.data.created_at);
                    $('#showMedicineCreatedOn').text(createDate.fromNow());
                    $('#showMedicineUpdatedOn').text(moment(result.data.updated_at).fromNow());
                    $('#showMedicineDescription').text(result.data.description);
                    setValueOfEmptySpan();
                    $('#showMedicine').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    }
}

listenClick('.deleteMedicineBtn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexMedicineUrl').val() + '/' + id, '', $('#Medicine').val());
});


