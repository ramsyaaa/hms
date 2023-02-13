document.addEventListener('turbo:load', loadCallLogsCreateEdit)

function loadCallLogsCreateEdit() {
    
    if($('#createCallLogForm').length || $('#editCallLogForm').length){
        let callLogFollowUpDate = undefined;

        if ($('editCallLogId').length) {
            $('#callLogDate').flatpickr({
                format: 'YYYY-MM-DD',
                useCurrent: true,
                sideBySide: true,
                minDate: moment(new Date()).format('YYYY-MM-DD'),
                locale : $('.userCurrentLanguage').val(),
                onChange: function (selectedDates, dateStr, instance) {
                    let callLogMinDate = moment($('#callLogDate').val()).format();
                    if (typeof followUpDate != "undefined") {
                        followUpDate.set('minDate', callLogMinDate)
                    }
                }
            });
        } else {
            $('#callLogDate').flatpickr({
                format: 'YYYY-MM-DD',
                useCurrent: true,
                sideBySide: true,
                minDate: moment(new Date()).format('YYYY-MM-DD'),
                locale : $('.userCurrentLanguage').val(),
                onChange: function (selectedDates, dateStr, instance) {
                    let callLogMinDate = moment($('#callLogDate').val()).format();
                    if (typeof callLogFollowUpDate != "undefined") {
                        callLogFollowUpDate.set('minDate', callLogMinDate)
                    }
                }
            });
        }

        callLogFollowUpDate = $('#callLogFollowUpDate').flatpickr({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true,
            locale : $('.userCurrentLanguage').val(),
        });

        let callLogMinDate = moment($('#callLogDate').val()).format();

        callLogFollowUpDate.set('minDate', callLogMinDate);
        
    }else {
        
        return false;
        
    }
    
}

listenSubmit('#createCallLogForm, #editCallLogForm', function () {
    // $('.btnSave').attr('disabled', true);
    if ($('.error-msg').text() !== '') {
        $('#callLogPhoneNumber').focus();
        // $('.btnSave').attr('disabled', false);
        return false;
    }
});

listen('keyup keypress', '#createCallLogForm, #editCallLogForm', function (e) {
    let keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});

listen('keyup keypress', '#createCallLogForm, #editCallLogForm', function (e){
    let keyCode = e.keyCode || e.which
    if(keyCode === 13) {
        e.preventDefault();
        return false;
    }
})
