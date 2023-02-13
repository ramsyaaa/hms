document.addEventListener('turbo:load',
    loadPluginLightGallery)

function loadPluginLightGallery() {
    if (!$('.lightGallery').length) {
        return
    }

    $('.lightgallery').lightGallery({
        mode: 'lg-slide-circular',
        counter: false
    });
}
