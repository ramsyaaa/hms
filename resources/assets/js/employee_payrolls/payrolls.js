document.addEventListener('turbo:load', loadEmployeePayrollData)

function loadEmployeePayrollData() {
    if (!$('#createPayroll').length && !$('#editPayroll').length) {
        return
    }

    $('.price-input').trigger('input');

    $('.type').focus();
}

listenChange('.basicSalary,#allowance,#deductions', function () {
    let basicSalary = parseFloat(removeCommas($('.basicSalary').val()));
    let allowance = parseFloat(removeCommas($('#allowance').val()));
    let deductions = parseFloat(removeCommas($('#deductions').val()));
    basicSalary = !isNaN(basicSalary) ? basicSalary : 0;
    allowance = !isNaN(allowance) ? allowance : 0;
    deductions = !isNaN(deductions) ? deductions : 0;
    let netSalary = ((basicSalary + allowance));

    if (deductions > netSalary) {
        $('#validationErrorsBox').removeClass('d-none');
        $('#validationErrorsBox').text('Deductions cannot be greater than Basic salary + Allowance').show();
        $('#deductions').val(null);
        deductions = 0;
        setTimeout(function () {
            $('#validationErrorsBox').addClass('d-none');
            $('#validationErrorsBox').text('');
        }, 7000);
    }

    netSalary = ((basicSalary + allowance) - deductions);
    (!isNaN(netSalary)) ? $('#netSalary').val(netSalary).trigger('input') : $(
        '#netSalary').val(0);
});

listenChange('#type', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: $('.employeeUrl').val(),
            type: 'get',
            dataType: 'json',
            data: {id: $(this).val()},
            success: function (data) {
                $('#ownerType').removeAttr('disabled');
                $.each(data.data, function (i, v) {
                    $('#ownerType').append($('<option></option>').attr('value', i).text(v));
                });
                let isEdit = $('.isEdit').val();
                if (isEdit) {
                    $('#ownerType').val($('.employeeOwnerId').val()).trigger('change');
                    isEdit = false;
                }
            },
        });
    }
    $('#ownerType').empty();
    $('#ownerType').prepend('<option value="0">Select Employee</option>');
    $('#ownerType').prop('disabled', true);
});

listenSubmit('#createPayroll, #editPayroll', function () {
    $('.btnSave').attr('disabled', true);
});
