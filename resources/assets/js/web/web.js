document.addEventListener('turbo:load', loadWebContentData)

function loadWebContentData()
{
    // if(!$('.doctor-name-filter').length) {
    //     return
    // }
    //
    // if(!$('.datepicker').length) {
    //     return
    // }
    
    $('.doctor-name-filter').selectize();
    $.datepicker.setDefaults( $.datepicker.regional[ $('.userCurrentLanguage').val() ] )
    $('.datepicker').datepicker(
        {
            minDate: new Date(),
            isRTL: false,
            dateFormat: 'dd/mm/yy',
        });
    $(window).on('scroll', function(){
        var scrolled = $(window).scrollTop();
        if (scrolled > 600) $('.go-top').addClass('active');
        if (scrolled < 600) $('.go-top').removeClass('active');
    });
    $('.go-top').on('click', function() {
        $("html, body").animate({ scrollTop: "0" },  500);
    });
    
    if((!$(".testimonial-slider").length)) {
        return 
    }
    
    $(".slick-slider").slick({
        slidesToShow: 4,
        infinite: true,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 1500,
        dots: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });

    $(".testimonial-slider").slick({
        slidesToShow: 1,
        infinite: true,
        slidesToScroll: 1,
        // autoplay: true,
        autoplaySpeed: 1500,
        dots: true,
        arrows: true,
        prevArrow: '<span class="prev-arrow"><i class="fas fa-chevron-left fs-5"></i></span>',
        nextArrow: '<span class="next-arrow"><i class="fas fa-chevron-right fs-5"></i></span>',
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    arrows: false,
                },
            }
        ],
    });
}
