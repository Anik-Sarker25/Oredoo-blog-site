/* -----------------------------------------------
					Js Main
--------------------------------------------------
    Template Name: Oredoo - Personal Blog HTML Template
--------------------------------------------------

Table of Content

	. Preloader
    . Navigation
    . Search
    . Back-top
    . Left-side
    . Blog-home3
    . Blog-home4
    . TheiaStickySidebar
    . Section-scroll-marquee
    
----------------------------------- */


(function ($) {
    "use strict";

    /* -----------------------------------
            Preloader
    ----------------------------------- */
    $('.loader').delay(500).fadeOut(500);


    /* -----------------------------------
            Navigation
    ----------------------------------- */
    $('.navbar-toggler').on('click', function () {
        $('.navbar-collapse').collapse('show');
    });



    /* -----------------------------------
           Search
    ----------------------------------- */
    $('.search-icon').on('click', function () {
        $('.search').addClass('search-open');
    });
    $('.close').on('click', function () {
        $('.search').removeClass('search-open');
    });


    /* -----------------------------------
           Back-top
    ----------------------------------- */
    $(window).on("scroll", function () {
        if ($(window).scrollTop() > 250) {
            $('.back-top').fadeIn(300);
        } else {
            $('.back-top').fadeOut(300);
        }
    });

    $('.back-top').on('click', function (event) {
        event.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 300);
        return false;
    });


    /* -----------------------------------
       left-side
    -----------------------------------*/
    $(".left-side .owl-carousel").owlCarousel({
        loop: true,
        stagePadding: 5,
        margin: 30,
        nav: true,
        autoplay: true,
        center: false,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        smartSpeed: 1000,
        autoplayHoverPause: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1200: {
                margin: 30,
                items: 1,
            },
        }
    });
    
    /* -----------------------------------
       blog-home3
    -----------------------------------*/
    $(".blog-home3 .owl-carousel").owlCarousel({
        loop: true,
        stagePadding: 5,
        margin: 30,
        nav: true,
        autoplay:true,
        center: false,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        smartSpeed: 1000,
        autoplayHoverPause: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
           990: {
                items: 2,
            },
            1400: {
                margin: 30,
                items: 3,
            },
        }
    });

    /* -----------------------------------
       blog-home4
    -----------------------------------*/
    $(".blog-home4 .owl-carousel").owlCarousel({
        loop: true,
        stagePadding: 5,
        margin: 30,
        nav: true,
        autoplay:true,
        center: false,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        smartSpeed: 1000,
        autoplayHoverPause: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1200: {
                margin: 30,
                items: 1,
            },
        }
    });
        /* -----------------------------------
       blog-home4
    -----------------------------------*/
    $(".blog-home7 .owl-carousel").owlCarousel({
        loop: true,
        stagePadding: 5,
        margin: 30,
        nav: true,
        autoplay:true,
        center: false,
        dots: true,
        mouseDrag: true,
        touchDrag: true,
        smartSpeed: 1000,
        autoplayHoverPause: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1200: {
                margin: 30,
                items: 3,
            },
        }
    });

    /* -----------------------------------
       theiaStickySidebar
    -----------------------------------*/

    jQuery('.oredoo-sidebar,.oredoo-content').theiaStickySidebar({
        additionalMarginTop: 150
    });
      
     /* -----------------------------------
       section-scroll-marquee
    -----------------------------------*/
    $('.section-scroll-marquee').each(function () {
        let $this = $(this),
            title = $this.find('.page-title'),
            text = title.text();

        title.append('&nbsp;' + text + '&nbsp;')
        title.append('&nbsp;' + text + '&nbsp;')
        title.marquee({
            duplicated: true,
            duration: 20000,
            delayBeforeStart: 0,
            direction: 'left',
            startVisible: true
        });
    })
     

})(jQuery);


