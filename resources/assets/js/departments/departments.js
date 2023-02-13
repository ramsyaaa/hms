'use strict';

listenChange('.is-active', function (event) {
    let departmentId = $(event.currentTarget).attr('data-id');
    updateStatus(departmentId);
});

window.updateStatus = function (id) {
    $.ajax({
        url: $('#indexDepartmentUrl').val() + id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                livewire.emit('refresh')
            }
        },
    })
};

listenSubmit('#addDepartmentForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find("#departmentSave");
    loadingButton.button('loading');
    let data = {
        'formSelector': $(this),
        'url': $('#indexDepartmentCreateUrl').val(),
        'type': 'POST',
        'tableSelector': tableName
    };
    newRecord(data, loadingButton, '#add_departments_modal');
});

listenSubmit('#editDepartmentForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find("#editDepartmentSave");
    loadingButton.button('loading');
    let id = $('#departmentId').val();
    let url = $('#indexDepartmentUrl').val() + id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'PUT',
        'tableSelector': tableName
    };
    editRecordWithForm(data, loadingButton, '#edit_departments_modal');
});

listenClick('.edit-btn', function (event) {
    let departmentId = $(event.currentTarget).attr('data-id');
    renderData(departmentId);
});

listenClick('.delete-btn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexDepartmentUrl').val() + id, tableName, 'Department');
});

window.renderData = function (id) {
    $.ajax({
        url: $('#indexDepartmentUrl').val() + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#departmentId').val(result.data.id);
                $('#editDepartmentName').val(result.data.name);
                if (result.data.is_active) {
                    $('#editDepartmentIsActive').val(1).prop('checked', true);
                }
                $('#edit_departments_modal').modal('show');
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

$('#filter_active').select2({
    width: '100%',
});
