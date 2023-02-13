document.addEventListener('turbo:load', loadUpdateInsurancesData)

function loadUpdateInsurancesData() {

    $('.price-input').trigger('input');

    if ($('.insuranceDiscount').val() < 0) {
        $('.discount').val(0);
    }

    if ($('.addInsuranceItem').val() < 0) {
        $('.discount').val(0);
    }
    $('#insuranceDiscountId').blur(function () {
        if ($('#insuranceDiscountId').val().length == 0) {
            $('#insuranceDiscountId').val(0);
        }
    });

    $('.insuranceForm').find('input:text:visible:first').focus();

    window.isInsuranceNumberKey = (evt, element) => {
        let charCode = (evt.which) ? evt.which : event.keyCode;

        return !((charCode !== 46 || $(element).val().indexOf('.') !== -1) &&
            (charCode < 48 || charCode > 57));
    };

    listenKeyup('.disease-charge', function (){
        calculateAndSetInsuranceAmount();
    })
    
    listenChange('.service-tax, .discount, .hospital-rate, .disease-charge',
        function () {
            calculateAndSetInsuranceAmount();
        });

    window.calculateAndSetInsuranceAmount = function () {
        let totalAmount = 0;
        let serviceTax = parseInt(
            $('.service-tax').val() !== '' ? removeCommas(
                $('.service-tax').val()) : 0);
        let hospitalRate = parseInt(
            $('.hospital-rate').val() !== '' ? removeCommas(
                $('.hospital-rate').val()) : 0);
        let discount = parseFloat($('.discount').val());
        totalAmount = serviceTax + hospitalRate;
        $('.disease-item-container>tr').each(function () {
            let itemTotal = parseInt(
                $(this).find('.disease-charge').val() != '' ? removeCommas(
                    $(this).find('.disease-charge').val()) : 0);
            totalAmount += itemTotal;
        });
        totalAmount -= (totalAmount * discount / 100);

        $('#insuranceTotal').text($('.currentCurrency').val() + addCommas(totalAmount.toFixed(2)));
        $('#insuranceTotal_amount').val(totalAmount);
    };

}
listenSubmit('#insuranceForm', function (event) {
    event.preventDefault();
    // screenLock();
    $('#insuranceSaveBtn').attr('disabled', true);
    let loadingButton = jQuery(this).find('#insuranceSaveBtn');
    loadingButton.button('loading');
    let formData = new FormData($(this)[0]);
    $.ajax({
        url: $('.insuranceSaveUrl').val(),
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message);
            window.location.href = $('.insuranceUrl').val();
            $('#insuranceSaveBtn').attr('disabled', false)
        },
        error: function (result) {
            printErrorMessage('#insuranceValidationErrorsBox', result)
            $('#insuranceSaveBtn').attr('disabled', false)
        },
        // complete: function () {
        //     screenUnLock()
        //     loadingButton.button('reset')
        // },
    });
});

let uniqueInsuranceId = $('.insuranceUniqueId').val()

listenClick('#addInsuranceItem', function () {
    let data = {
        'uniqueId': uniqueInsuranceId,
    }
    let diseaseItemHtml = prepareTemplateRender(
        '#insuranceDiseaseTemplate', data)
    $('.disease-item-container').append(diseaseItemHtml)
    uniqueInsuranceId++

    resetInsuranceItemIndex()
})

listenClick('.delete-disease', function () {
    $(this).parents('tr').remove()
    resetInsuranceItemIndex()
    calculateAndSetInsuranceAmount()
})

function resetInsuranceItemIndex () {
    let index = 1
    $('.disease-item-container>tr').each(function () {
        $(this).find('.item-number').text(index)
        index++
    })
    if (index - 1 == 0) {
        $('#insuranceTotal').text('0')
        $('#insuranceBillTbl tbody').append('<tr>' +
            '<td class="text-center item-number">1</td>' +
            '<td><input class="form-control disease-name" required name="disease_name[]" type="text"></td>' +
            '<td><input class="form-control disease-charge price-input" required name="disease_charge[]" type="text"></td>' +
            '<td class="text-center"><a href="javascript:void(0)" title="{{__(\'messages.common.delete\')}}"  class="delete-disease btn px-1 text-danger fs-3 pe-0">\n' +
            '                    <i class="fa-solid fa-trash"></i>\n' +
            '                            </a></td>' +
            '</tr>')
    }
}
