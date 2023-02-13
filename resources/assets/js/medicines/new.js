document.addEventListener('turbo:load', loadMedicineData)

function loadMedicineData() {
    if (!$('#createMedicine').length && !$('#editMedicine').length) {
        return
    }

    let qtyEle = $('#qty');
    qtyEle.blur(() => {
        if (qtyEle.val() < 0) {
            qtyEle.val(0);
        }
    });

    $('#medicineBrandId,#medicineCategoryId').select2({
        width: '100%',
    });

    $('#medicineNameId').focus();
}
    listenSubmit('#createMedicine, #editMedicine', function () {
        $('#medicineSave').attr('disabled', true);
    });

