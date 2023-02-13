document.addEventListener('turbo:load', loadIpdTimelineData)

function loadIpdTimelineData() {
    if (!$('#showListIpdPatientDepartmentId').length) {
        return
    }
    getPatientListIpdTimelines($('#showListIpdPatientDepartmentId').val());

}

function getPatientListIpdTimelines(ipdPatientDepartmentId) {
    $.ajax({
        url: $('#showListIpdTimelinesUrl').val(),
        type: 'get',
        data: {id: ipdPatientDepartmentId},
        success: function (data) {
            $('#ipdTimelines').html(data);
        },
    });
};
