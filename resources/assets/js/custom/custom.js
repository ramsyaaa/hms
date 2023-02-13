'use strict'

let jsrender = require('jsrender')
let csrfToken = $('meta[name="csrf-token"]').attr('content')
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
})

document.addEventListener('turbo:load', initAllComponents)

function initAllComponents () {
    select2initialize()
    refreshCsrfToken()
    alertInitialize()
    modalInputFocus()
    inputFocus()
    IOInitImageComponent();
    IOInitSidebar();
}

let firstTime = true

function select2initialize () {
    $('[data-control="select2"]').each(function () {
        $(this).select2()
    })
}

$('.getLanguage').val();

function refreshCsrfToken () {
    csrfToken = $('meta[name="csrf-token"]').attr('content')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    })
}

function alertInitialize () {
    $('.alert').delay(5000).slideUp(300)
}

const modalInputFocus = () => {
    $(function () {
        $('.modal').on('shown.bs.modal', function () {
            $(this).find('input:text').first().focus()
        })
    })
}

const inputFocus = () => {
    $('input:text:not([readonly="readonly"]):not([name="search"]):not(.front-input)').
        first().
        focus()
}

$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        $('.modal').modal('hide')
    }
})

$('input:text:not([readonly="readonly"])').first().focus()

$(document).on('select2:open', () => {
    let allFound = document.querySelectorAll('.select2-container--open .select2-search__field');
    allFound[allFound.length - 1].focus();
});

$('[data-control="select2"]').each(function () {
    $(this).select2()
})

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        $('[data-control="select2"]').each(function () {
            $(this).select2()
        })
    })
})

$(document).on('focus', '.select2.select2-container', function (e) {
    let isOriginalEvent = e.originalEvent; // don't re-open on closing focus event
    let isSingleSelect = $(this).find('.select2-selection--single').length > 0; // multi-select will pass focus to input

    if (isOriginalEvent && isSingleSelect) {
        $(this).siblings('select:enabled').select2('open');
    }
});


$(document).ready(function () {
    // initializer script for bootstrap 4 tooltip
    $('[data-bs-toggle="tooltip"]').tooltip()

    function tooltip()
    {
        var tooltipTriggerList =
            [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    }

    // script to active parent menu if sub menu has currently active
    let hasActiveMenu = $(document).find('.nav-item.nav-dropdown ul li.nav-item').hasClass('active');
    if (hasActiveMenu)
        $(document).
            find('.nav-item.nav-dropdown ul li.nav-item.active').
            parent('ul').
            parent('li').
            addClass('open');

    listenClick('.nav-item.nav-dropdown', function () {
        let openLiSelector = $(document).find('.nav-item.nav-dropdown').hasClass('open');
        if (openLiSelector && $(this).hasClass('open'))
            setTimeout(function () {
                $(this).removeClass('open');
            }, 1000);
        else
            $(document).find('.nav-item.nav-dropdown').removeClass('open');
    });

    // remove capital letters from email validation script.
    listenKeyup('input[name="email"]', function () {
        this.value = this.value.toLowerCase();
    });
    $('input[name="email"]').keypress(function (e) {
        if (e.which === 32)
            return false;
    });
});

$(function () {
    listenShownBsModal('.modal', function () {
        $(this).find('input:text').first().focus();

    });
    listenHiddenBsModal('.modal', function () {
        $('.image-input.image-input-empty').attr('style', 'display:inline-block');
    });
});

window.resetModalForm = function (formId, validationBox) {
    let inputs = $(formId)[0].elements;
    $.each(inputs, function (index, value) {
        if (typeof value._flatpickr !== 'undefined') {
            value._flatpickr.clear();
            value._flatpickr.setDate(new Date());
        }
    });
    $(formId)[0].reset()
    $('select.select2Selector').each(function (index, element) {
        let drpSelector = '#' + $(this).attr('id')
        $(drpSelector).val('')
        $(drpSelector).trigger('change')
    })
    $(validationBox).hide()
};

window.processingBtn = function (selecter, btnId, state = null) {
    var loadingButton = $(selecter).find(btnId)
    if (state === 'loading') {
        loadingButton.button('loading')
    } else {
        loadingButton.button('reset')
    }
}

window.printErrorMessage = function (selector, errorResult) {
    // $(selector).show().html("");
    // $(selector).text(errorResult.responseJSON.message);
    displayErrorMessage(errorResult.responseJSON.message)
}

toastr.options = {
    'closeButton': true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

window.manageAjaxErrors = function (data) {
    var errorDivId = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'editValidationErrorsBox';

    if (data.status == 404) {
        toastr.error(data.responseJSON.message);
    } else {
        printErrorMessage("#" + errorDivId, data);
    }
};



window.displaySuccessMessage = function (message) {
    toastr.success(message);
};

window.displayErrorMessage = function (message) {
    toastr.error(message);
};

window.displayPhoto = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};

window.isValidFile = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).
            html('The image must be a file of type: jpeg, jpg, png.').
            removeClass('d-none').
            show();
        setTimeout(function () {
            $(validationMessageSelector).slideUp(300);
        }, 5000);

        return false;
    }
    $(validationMessageSelector).addClass('d-none');

    return true;
};

window.format = function (dateTime) {
    var format = arguments.length > 1 && arguments[1] !== undefined
        ? arguments[1]
        : 'YYYY-MM-DD';
    return moment(dateTime).format(format);
};

window.DatetimepickerDefaults = function(opts) {
    return $.extend({},{
        sideBySide: true,
        ignoreReadonly: true,
        icons: {
            up: "icon-arrow-up-circle icons font-2xl",
            down: "icon-arrow-down-circle icons font-2xl",
            previous: 'icon-arrow-left icons',
            next: 'icon-arrow-right icons',
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            today: 'fa fa-crosshairs',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        }
    }, opts);
};

window.screenLock = function() {
    $('#overlay-screen-lock').show();
    $('body').css({'pointer-events':'none','opacity':'0.6'});
};

window.screenUnLock = function() {
    $('body').css({'pointer-events':'auto','opacity':'1'});
    $("#overlay-screen-lock").hide();
};

window.prepareTemplateRender = function (templateSelector, data) {
    let template = jsrender.templates(templateSelector);
    return template.render(data);
};

/**
 * @return string
 */
window.getCurrentCurrencyClass = function () {
    return '<b>' + $('.currentCurrency').val() + '</b>';
};

/**
 * @return string
 */
window.getCurrentCurrency = function () {
    return $('.getCurrentCurrency').val();
};

window.hideDropdownManually = function (dropdownBtnEle, dropdownEle) {
    dropdownBtnEle.removeClass('show')
    dropdownEle.removeClass('show')
}

window.displayDocument = function (input, selector, extension) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            if ($.inArray(extension, ['pdf', 'doc', 'docx', 'mp3', 'mp4']) == -1) {
                image.src = e.target.result;
            } else {
                if (extension == 'pdf') {
                    $('#editPhoto').css('background-image', 'url("' + $('.pdfDocumentImageUrl').val() + '")');
                    image.src = $('.pdfDocumentImageUrl').val();
                } else if (extension == 'mp3') {
                    image.src = $('.audioDocumentImageUrl').val();
                } else if (extension == 'mp4') {
                    image.src = $('.videoDocumentImageUrl').val();
                } else {
                    image.src = $('.docxDocumentImageUrl').val();
                }
            }
            image.onload = function () {
                $(selector).attr('src', image.src);
                $(selector).css('background-image',
                    'url("' + image.src + '")');
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};

let ajaxCallIsRunning = $('.ajaxCallIsRunning').val();
window.ajaxCallInProgress = function () {
    ajaxCallIsRunning = true;
};

window.ajaxCallCompleted = function () {
    ajaxCallIsRunning = false;
};

window.UnprocessableInputError = function (data) {
    toastr.error(data.responseJSON.message);
};

// set N/A if span tag is empty
window.setValueOfEmptySpan = function (){
    $('span.showSpan').each(function () {
        if (!$(this).text()) {
            $(this).text('N/A');
        }
    });
}

// Add comma into numbers
window.addCommas = function(number)
{
    number += '';
    let x = number.split('.');
    let x1 = x[0];
    let x2 = x.length > 1 ? '.' + x[1] : '';
    let rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

$(function () {

    listenClick('.notification', function (e) {
        e.stopPropagation();
        let notificationId = $(this).data('id');
        let notification = $(this);
        $('[data-toggle="tooltip"]').tooltip('hide');

        $.ajax({
            type: 'get',
            url: '/notification/' + notificationId + '/read',
            success: function () {
                notification.remove();
                displaySuccessMessage('Notification read successfully')
                let notificationCounter = document.getElementsByClassName(
                    'notification').length;
                $('#counter').text(notificationCounter);
                if (notificationCounter == 0) {
                    $('.read-all-notification').addClass('d-none');
                    $('.empty-state').removeClass('d-none');
                    $('#counter').text(notificationCounter);
                    $('.notification-count').addClass('d-none');
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    });

    listenClick('#readAllNotification', function (e) {
        e.stopPropagation();

        $.ajax({
            type: 'post',
            url: '/read-all-notification',
            success: function () {
                $('.notification').remove();
                displaySuccessMessage('All Notifications read successfully');
                let notificationCounter = document.getElementsByClassName(
                    'notification').length;
                $('#counter').text(notificationCounter);
                $('#readAllNotification').addClass('d-none');
                $('.empty-state').addClass('d-none');
                $('.empty-state.empty-notification').removeClass('d-none');
                $('.notification-count').addClass('d-none');
                displaySuccessMessage('All notifications read successfully');
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    });
});
window.avoidSpace = function (event) {
    let k = event ? event.which : window.event.keyCode;
    if (k == 32 && (event.path[0].value.length <= 0)) {
        return false;
    }
};
let defaultAvatarImageUrl = "asset('assets/img/avatar.png')";
window.defaultImagePreview = function (imagePreviewSelector, id = null) {
    if (id == 1) {
        $(imagePreviewSelector).
            css('background-image', 'url("' + defaultAvatarImageUrl + '")');
    } else {
        $(imagePreviewSelector).css('background-image', 'url("' + $('.defaultDocumentImageUrl').val() + '")');
    }
};

window.cancelAppointment = function (url, tableId, header, appointmentId) {
    swal({
        title: Lang.get('messages.common.cancel') + ' ' + Lang.get('messages.web_menu.appointment'),
        text: Lang.get('messages.appointment.are_you_sure_want_to_cancel') + ' ' + header + ' ?',
        type: 'warning',
        icon: 'warning',
        closeOnConfirm: false,
        confirmButtonColor: '#000000',
        showLoaderOnConfirm: true,
        buttons: {
            confirm:Lang.get('messages.common.yes'),
            cancel: Lang.get('messages.common.no'),
        },
    }).then(function (result) {
        if (result) {
            cancelAppointmentAjax(url, tableId, header, appointmentId);
        }
    });
};

function cancelAppointmentAjax (url, tableId, header, appointmentId) {

    $.ajax({
        url: url,
        type: 'POST',
        success: function (obj) {
            if (obj.success) {
                Livewire.emit('refresh')
            }
            swal({
                title: Lang.get('messages.common.canceled')+ ' ' +Lang.get('messages.web_menu.appointment'),
                text: header + Lang.get('messages.appointment.has_been_cancelled'),
                icon: 'success',
                confirmButtonColor: '#D9214E',
                buttons: {
                    confirm:Lang.get('messages.common.ok'),
                },
                timer: 2000,
            });
        },
        error: function (data) {
            swal({
                title: 'Error',
                icon: 'error',
                text: data.responseJSON.message,
                type: 'error',
                confirmButtonColor: '#D9214E',
                buttons: {
                    confirm:Lang.get('messages.common.ok'),
                },
                timer: 5000,
            });
        },
    });
}

