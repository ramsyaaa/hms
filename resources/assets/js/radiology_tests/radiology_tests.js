
listenClick('.delete-radiology-test-btn', function (event) {
    let radiologyTestId = $(event.currentTarget).attr('data-id');
    deleteItem($('#radiologyTestURL').val() + '/' + radiologyTestId, '',
        $('#radiologyTest').val());
});
listenClick('.show-radiology-test-btn', function (event) {
    event.preventDefault()
    let radiologyTestId = $(this).attr('data-id');
    radiologyTestRenderData(radiologyTestId);
});
window.radiologyTestRenderData = function (id) {

    $.ajax({
        url: $('#radiologyTestShowModal').val() + '/' + id,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showRtTest_name').text(result.data.test_name);
                $('#showRtShort_name').text(result.data.short_name);
                $('#showRtTest_type').text(result.data.test_type);
                $('#showRadiologyCategories').text(result.data.radiology_category_name);
                $('#showRtSubcategory').text(result.data.subcategory);
                $('#showRtReport_days').text(result.data.report_days);
                $('#showCharge_categories').text(result.data.charge_category_name);
                $('#showRtStandard_charge').text(result.data.standard_charge);
                moment.locale($('#radiologyTestLanguage').val());
                $('#showRtCreated_on').text(moment(result.data.created_at).fromNow());
                $('#showRtUpdated_on').text(moment(result.data.updated_at).fromNow());

                setValueOfEmptySpan();
                $('#showRadiologyTest').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

