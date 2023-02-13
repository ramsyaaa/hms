document.addEventListener('turbo:load', loadItemCategory)

function loadItemCategory () {
    if (!$('#itemCategory').length && !$('#editItemCategory').length) {
        return
    }

    $('#itemCategory').select2({
        width: '100%',
    });
    $('#editItemCategory').select2({
        width: '100%',
    });
}
