listen('click', '#ePayrollResetFilter', function () {
    $('#employee_payroll_filter_status').val(0).trigger('change');
    hideDropdownManually($('#employeePayrollFilterBtn'), $('.dropdown-menu'));
});


listen('click', '.deleteEmpPayrollBtn', function (event) {
    let employeePayrollId = $(event.currentTarget).attr('data-id');
    deleteItem(
        $('#indexEmployeePayrollUrl').val() + '/' + employeePayrollId,
        '',
        $('#employeePayroll').val(),
    );
});

listen('click', '.showEPayrollBtn', function (event) {
    event.preventDefault()
    let employeePayrollId = $(event.currentTarget).attr('data-id');
    renderEPayrollData(employeePayrollId);
});

function renderEPayrollData(id) {
    $.ajax({
        url: $('#employeesPayrollShowModal').val() + '/' + id,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#sr_no').text(result.data.sr_no);
                $('#payroll_id').text(result.data.payroll_id);
                $('#payroll_role').text(result.data.type_string);
                $('#employee_full_name').text(result.data.full_name);
                $('#payroll_month').text(result.data.month);
                $('#payroll_year').text(result.data.year);
                $('#salary').text(addCommas(result.data.basic_salary));
                $('#allowance').text(addCommas(result.data.allowance));
                $('#deductions').text(addCommas(result.data.deductions));
                $('#net_salary').text(addCommas(result.data.net_salary));
                $('#employee_status').empty();
                let unPaidStatus = $('#employeesPayrollStatusUnPaid').val()
                let paidStatus = $('#employeesPayrollStatusPaid').val()
                if (result.data.status == 1) {
                    $('#employee_status').append(
                        '<span class="badge bg-light-success">' + paidStatus + '</span>');
                } else {
                    $('#employee_status').append(
                        '<span class="badge bg-light-danger">' + unPaidStatus + '</span>');
                }
                $('#created_on').text(moment(result.data.created_at).fromNow());
                $('#updated_on').text(moment(result.data.updated_at).fromNow());
                setValueOfEmptySpan();
                $('#showEmployeePayrolls').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

listenChange('#employee_payroll_filter_status', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});
