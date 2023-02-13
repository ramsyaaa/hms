listenClick('.delete-schedule-btn', function (event) {
    let scheduleId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexScheduleUrl').val() + '/' + scheduleId, '', $('#Schedule').val());
});
