'use strict';

listenClick('.deletePathologyTestBtn', function (event) {
    let pathologyTestId = $(event.currentTarget).attr('data-id');
    deleteItem($('#pathologyTestURL').val() + '/' + pathologyTestId, '',
        // Lang.get('messages.pathology_test.pathology_tests'));
        $('#pathologyTest').val());
});

listenClick('.showPathologyTestBtn', function (event) {
    event.preventDefault()
    let pathologyTestId = $(event.currentTarget).attr('data-id');
    renderPathologyTestData(pathologyTestId);
});

window.renderPathologyTestData = function (id) {
    $.ajax({
        url: $('#pathologyTestShowUrl').val() + '/' + id,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showPathologyTestName').text(result.data.test_name);
                $('#showPathologyTestShortName').text(result.data.short_name);
                $('#showPathologyTestType').text(result.data.test_type);
                $('#showPathologyCategories').text(result.data.pathology_category_name);
                $('#showPathologyTestUnit').text(result.data.unit);
                $('#showPathologyTestSubcategory').text(result.data.subcategory);
                $('#showPathologyTestMethod').text(result.data.method);
                $('#showPathologyTestReportDays').text(result.data.report_days);
                $('#showPathologyChargeCategories').text(result.data.charge_category_name);
                $('#showPTestStandardCharge').text(result.data.standard_charge);
                moment.locale($('#pathologyTestLanguage').val());
                $('#showPathologyTestCreatedOn').text(moment(result.data.created_at).fromNow());
                $('#showPathologyTestUpdatedOn').text(moment(result.data.updated_at).fromNow());

                setValueOfEmptySpan();
                $('#showPathologyTest').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};
