document.addEventListener('turbo:load', loadPackageData)

uniquePackageId = $('.packageUniqueId').val()

function loadPackageData () {
    if (!$('.packageForm').length) {
        return
    }

    $('.packageForm').find('input:text:visible:first').focus()

    const removeCommas = (str) => {
        return str.replace(/,/g, '')
    }

    const calculateAmount = (qty, rate) => {
        if (qty > 0 && rate > 0) {
            return qty * rate
        } else {
            return 0
        }
    }

    dropdownToSelecte2('.serviceId')

    window.isNumberKey = (evt, element) => {
        let charCode = (evt.which) ? evt.which : event.keyCode

        return !((charCode !== 46 || $(element).val().indexOf('.') !== -1) &&
            (charCode < 48 || charCode > 57))
    }

    listenKeyup('.packageQty', function () {
        let qty = parseInt($(this).val())
        let rate = $(this).parent().siblings().find('.price').val()
        rate = parseInt(removeCommas(rate))
        let amount = calculateAmount(qty, rate)
        $(this).parent().siblings('.amount').text(addCommas(amount.toString()))
        calculateAndSetTotalAmount()
    })

    listenKeyup('.price', function () {
        let rate = $(this).val()
        rate = parseInt(removeCommas(rate))
        let qty = parseInt($(this).parent().siblings().find('.qty').val())
        let amount = calculateAmount(qty, rate)
        $(this).parent().siblings('.amount').text(addCommas(amount.toString()))
        calculateAndSetTotalAmount()
    })

    listenKeyup('#packageDiscountId', function () {
        calculateAndSetTotalAmount()
    })

}

listenClick('#addPackageItem', function () {
    let data = {
        'services': JSON.parse($('.associateServices').val()),
        'uniqueId': uniquePackageId,
    }
    let packageServiceItemHtml = prepareTemplateRender(
        '#packageServiceTemplate', data)
    $('.package-service-item-container').append(packageServiceItemHtml)
    dropdownToSelecte2('.serviceId')
    uniquePackageId++

    resetServicePackageItemIndex()
})

listenClick('.delete-service-package-item', function () {
    $(this).parents('tr').remove()
    resetServicePackageItemIndex()
    calculateAndSetTotalAmount()
})

const resetServicePackageItemIndex = () => {
    let index = 1
    $('.package-service-item-container>tr').each(function () {
        $(this).find('.item-number').text(index)
        index++
    })
    if (index - 1 == 0) {
        let data = {
            'services': JSON.parse($('.associateServices').val()),
            'uniqueId': uniquePackageId,
        }
        let packageServiceItemHtml = prepareTemplateRender(
            '#packageServiceTemplate', data)
        $('.package-service-item-container').append(packageServiceItemHtml)
        dropdownToSelecte2('.serviceId')
        uniquePackageId++
    }
}

const calculateAndSetTotalAmount = () => {
    let totalAmount = 0
    let discount = parseFloat(
        $('#packageDiscountId').val() !== ''
            ? $('#packageDiscountId').val()
            : 0)
    $('.package-service-item-container>tr').each(function () {
        let itemTotal = $(this).find('.item-total').text()
        itemTotal = removeCommas(itemTotal)
        itemTotal = isEmpty($.trim(itemTotal)) ? 0 : parseInt(itemTotal)
        totalAmount += itemTotal
    })
    totalAmount = parseFloat(totalAmount)
    totalAmount -= (totalAmount * discount / 100)
    $('#packageTotal').text($('.currentCurrency').val() + addCommas(totalAmount.toFixed(2)))

    //set hidden input value
    $('#packageTotal_amount').val(totalAmount)
}

const dropdownToSelecte2 = (selector) => {
    $(selector).select2({
        placeholder: 'Select Service',
        width: '100%',
    })
}

listenSubmit('.packageForm', function (event) {
    event.preventDefault()
    // screenLock()
    $('#packageSaveBtn').attr('disabled', true)
    let loadingButton = jQuery(this).find('#packageSaveBtn')
    loadingButton.button('loading')
    let formData = new FormData($(this)[0])
    $.ajax({
        url: $('.packageSaveUrl').val(),
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message)
            window.location.href = $('.packageUrl').val()
            $('#packageSaveBtn').attr('disabled', false)
        },
        error: function (result) {
            printErrorMessage('#packageValidationErrorsBox', result)
            $('#packageSaveBtn').attr('disabled', false)
        },
        // complete: function () {
        //     screenUnLock()
        //     loadingButton.button('reset')
        // },
    })
})
