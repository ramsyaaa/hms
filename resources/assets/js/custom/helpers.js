'use strict';

window.isEmpty = (value) => {
    return value === undefined || value === null || value === '';
};

window.randomCode = (length = 6) => {
    return Math.random().toString(36).slice(-length);
};
window.listen = function (event, selector, callback) {
    $(document).on(event, selector, callback)
}
window.listenClick = function (selector, callback) {
    $(document).on('click', selector, callback)
}
window.listenSubmit = function (selector, callback) {
    $(document).on('submit', selector, callback)
}
window.listenHiddenBsModal = function (selector, callback) {
    $(document).on('hidden.bs.modal', selector, callback)
}
window.listenChange = function (selector, callback) {
    $(document).on('change', selector, callback)
}
window.listenKeyup = function (selector, callback) {
    $(document).on('keyup', selector, callback)
}
window.listenShownBsModal = function (selector, callback) {
    $(document).on('shown.bs.modal', selector, callback)
}
