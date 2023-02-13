document.addEventListener('turbo:load', loadIpdBills)

function loadIpdBills () {

    if (!$('#ipdBillForm').length) {
        return false
    }

    let totalCharges = 0
    let totalPayments = 0
    let grossTotal = 0
    let discountPercent = 0
    let taxPercentage = 0
    let otherCharges = 0
    let netPayabelAmount = 0
    let totalDiscount = 0
    let totalTax = 0

    if ($('#showIpdBillStatus').val() == 1) {
        $(' #discountPercent, #taxPercentage,#otherCharges ').
            prop('disabled', true)
    }
    calculateIpdBill()
    if (grossTotal <= 0) {
        $('#grossTotal').text(0)
        $(' #discountPercent, #taxPercentage,#otherCharges ').
            prop('disabled', true)
    }

}

listenKeyup('#discountPercent, #taxPercentage, #otherCharges'
    , function () {
        if (this.id == 'discountPercent' || this.id == 'taxPercentage') {
            if (parseInt(removeCommas($(this).val())) > 100) {
                $(this).val(100)
            }
        }
        calculateIpdBill()
    })
listenSubmit('#ipdBillForm', function (e) {
    e.preventDefault()
    $(' #discountPercent, #taxPercentage,#otherCharges').
        prop('disabled', false)
    screenLock()
    $('#saveIpdBillbtn').attr('disabled', true)
    let loadingButton = jQuery(this).find('#saveIpdBillbtn')
    loadingButton.button('loading')

    calculateIpdBill()
    let formData = new FormData($(this)[0])
    formData.append('total_charges', totalCharges)
    formData.append('total_payments', totalPayments)
    formData.append('gross_total', grossTotal)
    formData.append('net_payable_amount', netPayabelAmount)

    $.ajax({
        url: $('#showIpdBillSaveUrl').val(),
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message)
            window.location.reload()
        },
        error: function (result) {
            UnprocessableInputError(result)
            $('#saveIpdBillbtn').attr('disabled', false)
        },
        complete: function () {
            screenUnLock()
            loadingButton.button('reset')
        },
    })

})

function removeCurrencySymbol (amount) {
    var result = amount.replace(/\D/g, '')
    return parseInt(result)
}

function calculateIpdBill () {

    // console.log(removeCurrencySymbol($('#totalCharges').text()))
    
    totalCharges = removeCurrencySymbol($('#totalCharges').text())
    totalPayments = removeCurrencySymbol($('#totalPayments').text())
    grossTotal = removeCurrencySymbol($('#grossTotal').text())

    discountPercent = removeCurrencySymbol($('#discountPercent').val())
    taxPercentage = removeCurrencySymbol($('#taxPercentage').val())
    otherCharges = removeCurrencySymbol($('#otherCharges').val())

    // discountPercent = (isNaN(discountPercent)) ? 0 : discountPercent
    // taxPercentage = (isNaN(taxPercentage)) ? 0 : taxPercentage
    // otherCharges = (isNaN(otherCharges)) ? 0 : otherCharges

    //calculate
    let total = totalCharges - (totalPayments - otherCharges)
    totalDiscount = percentage(discountPercent, totalCharges)
    totalTax = percentage(taxPercentage, totalCharges)
    netPayabelAmount = isNaN((totalCharges + otherCharges + totalTax) -
        (totalPayments + totalDiscount)) ? 0 : (totalCharges + otherCharges +
        totalTax) -
        (totalPayments + totalDiscount)

    if (netPayabelAmount > 0)
        $('#billStatus').html('Unpaid')
    else {
        netPayabelAmount = 0
        $('#billStatus').html('Paid')

    }
    $('#netPayabelAmount').text(addCommas(netPayabelAmount))
}

function percentage (percent, total) {
    return ((percent / 100) * total)
}
