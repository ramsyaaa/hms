'use strict'

listenClick('.delete-patient-case-btn', function (event) {
    let caseId = $(event.currentTarget).attr('data-id')
    deleteItem($('#indexPatientCaseUrl').val() + '/' + caseId, '',
        Lang.get('messages.case.case'))
})

listenClick('#caseResetFilter', function () {
    $('#caseHead').val(0).trigger('change')
    hideDropdownManually($('#caseFilterBtn'), $('.dropdown-menu'))
})

// status activation deactivation change event
listenChange('.patientCaseStatus', function (event) {
    let caseId = $(event.currentTarget).attr('data-id')
    caseActiveDeActiveStatus(caseId)
})

// activate de-activate Status
window.caseActiveDeActiveStatus = function (id) {
    $.ajax({
        url: $('#indexPatientCaseUrl').val() + '/' + id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                Livewire.emit('refresh')
            }
        },
    })
}

listenClick('.show-patient-case-btn', function (event) {
    let patientCaseId = $(event.currentTarget).attr('data-id')
    renderPatientCaseData(patientCaseId)
})

window.renderPatientCaseData = function (id) {
    $.ajax({
        url: $('#patientCaseShowModal').val() + '/' + id,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                console.log(result.data)
                $('#case_id').text(result.data.case_id)
                $('#patient_name').
                    text(result.data.patient_name)
                $('#patient_phone').text(result.data.phone)
                $('#patient_doctor').text(result.data.doctor_name)
                moment.locale($('#caseLanguage').val())
                $('#case_date').text(moment(result.data.date).format('Do MMM, Y h:mm A'))
                $('#case_fee').text(result.data.fee)
                $('#description').text(result.data.description)
                $('#patientStatus').empty()
                let activeCase = $('#patientCaseActive').val()
                let deActiveCase = $('#patientCaseDeActive').val()
                if (result.data.status == 1) {
                    $('#patientStatus').
                        append(
                            '<span class="badge bg-light-success">' +
                            activeCase + '</span>')
                } else {
                    $('#patientStatus').
                        append(
                            '<span class="badge bg-light-danger">' +
                            deActiveCase + '</span>')
                }
                $('#created_on').
                    text(moment(result.data.created_at).fromNow())
                $('#updated_on').
                    text(moment(result.data.updated_at).fromNow())

                setValueOfEmptySpan()
                $('#showPatientCase').appendTo('body').modal('show')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
}
listenChange('#caseHead', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
})
