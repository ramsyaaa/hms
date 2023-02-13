'use strict';

window.deleteItem = function (url, tableId = null, header, callFunction = null) {
    swal({
        title: $('.deleteVariable').val(),
        text: $('.confirmVariable').val()  + header + '?',
        icon: $('.sweetAlertIcon').val(),
        buttons: {
            confirm:$('.yesVariable').val()  + ', ' +  $('.deleteVariable').val(),
            cancel: $('.noVariable').val()  + ', ' +  $('.cancelVariable').val(),
        },
    }).then((result) => {
        if (result) {
            Livewire.emit('refresh')
            deleteItemAjax(url, tableId= null, header, callFunction = null);
        }
    });
};

function deleteItemAjax(url, tableId= null, header, callFunction = null) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function (obj) {
            if (obj.success) {
                Livewire.emit('refresh')
            }
            swal({
                icon: 'success',
                title: $('.deletedVariable').val(),
                confirmButtonColor: '#f62947',
                text: header + ' ' + $('.hasBeenDeletedVariable').val(),
                timer: 2000,
                buttons: {
                    confirm : $('.okVariable').val()
                }
            });
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            swal({
                title: '',
                text: data.responseJSON.message,
                confirmButtonColor: '#f62947',
                icon: 'error',
                timer: 5000,
                buttons: {
                    confirm : $('.okVariable').val()
                }
            })
        },
    })
}
