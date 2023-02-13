document.addEventListener('turbo:load', loadPatientOpdTimelineData)

function loadPatientOpdTimelineData() {
    if (!$('#showOpdListPatientDepartmentId').length) {
        return
    }

    getOpdTimelines($('#showOpdListPatientDepartmentId').val());
}

function getOpdTimelines(opdPatientDepartmentId) {
    $.ajax({
        url: $('#showOpdListTimelinesUrl').val(),
        type: 'get',
        data: {id: opdPatientDepartmentId},
        success: function (data) {
            $('#opdTimelines').html(data);
        },
    });
};
