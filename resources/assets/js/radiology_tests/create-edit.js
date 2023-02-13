document.addEventListener('turbo:load', loadRadiologyEdit)

function loadRadiologyEdit(){
    if (!$('.radiologyTestActionURL').length) {
        return
    }

    $('.price-input').trigger('input');
    $('.radiologyCategories,.chargeCategories').select2({
        width: '100%',
    });
    $('#createRadiologyTest, #editRadiologyTest').find('input:text:visible:first').focus();

}

window.radiologyTestGetStandardCharge = function (id) {
    $.ajax({
        url: $('.radiologyTestActionURL').val() + '/get-standard-charge' + '/' + id,
        method: 'get',
        cache: false,
        success: function (result) {
            if (result.data !== '') {
                $('.rtStandardCharge').val(result.data);
                $('.price-input').trigger('input');
            }
        },
    });
};
listenChange('.chargeCategories', function (event) {
    let chargeCategoryId = $(this).val();
    (chargeCategoryId !== '') ? radiologyTestGetStandardCharge(chargeCategoryId) : $(
        '.rtStandardCharge').val('');
});
