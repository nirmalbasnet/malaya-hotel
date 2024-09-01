(function(jQuery) {
    "use strict";
    $(window).on('load', function() {
        $('.load-popup').fadeIn(5000);
    });
    
    $(document).ready(function() {

        $(".searchd").on("click", function () {
            $(".searchbox").addClass("open", 1000);
        });

        $(".close").on("click", function () {
            $(".searchbox").removeClass("open", 1000);
        });
        jQuery('.master-head  .toggle-button').on('click', function() {
            jQuery(this).toggleClass('active');
            jQuery('.master-head .menu').toggleClass('menu-open');

        });
        jQuery('.master-head  .menu .close-toggle').on('click', function() {
            jQuery('.master-head .menu').removeClass('menu-open');

        });

        var jQuerywinwidth = jQuery(window).width();
        if (jQuerywinwidth <= 1024) {
            jQuery('.menu ul li.menu-item-has-children').prepend('<span class="fa fa-angle-down"></span>');

            jQuery('.menu ul li.menu-item-has-children span.fa-angle-down').on('click', function(e) {
                e.preventDefault();

                jQuery(this).siblings('.menu ul li.menu-item-has-children ul').slideToggle(300);

            })
        }



        /*====================================
        // hero carousel
        ======================================*/

        $('.hero-slider').owlCarousel({
            items: 1,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            loop: true,
            dots: false,
            nav: true,
            responsiveClass: true,
            navText: [
                "<i class='fa fa-long-arrow-left'></i>",
                "<i class='fa fa-long-arrow-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 1,
                }

            },
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });
        $('.review-slider').owlCarousel({
            items: 1,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            loop: true,
            dots: false,
            nav: true,
            responsiveClass: true,
            navText: [
                "<i class='fa fa-long-arrow-left'></i>",
                "<i class='fa fa-long-arrow-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 1,
                }

            },
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });


        /*====================================
        // hero carousel
        ======================================*/

        $('.detail-slider').owlCarousel({
            items: 1,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            loop: true,
            margin: 20,
            dots: false,
            nav: true,
            responsiveClass: true,
            navText: [
                "<i class='fa fa-long-arrow-left'></i>",
                "<i class='fa fa-long-arrow-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 1,
                }

            },
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });
       

        /*====================================
        // major carousel
        ======================================*/


        $('.guide-slider').owlCarousel({
            items: 4,
            loop: true,
            margin: 15,
            dots: false,
            nav: true,
            responsiveClass: true,
            navText: [
                "<i class='fa fa-long-arrow-left'></i>",
                "<i class='fa fa-long-arrow-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 2,
                },
                1200: {
                    items: 4,
                },
                768: {
                    items: 3,
                },
                576: {
                    items: 2,
                },

            },
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });

        /*====================================
        // pub carousel
        ======================================*/


        $('.destination-slider').owlCarousel({
            items: 3,
            loop: true,
            margin: 15,
            dots: false,
            nav: true,
            responsiveClass: true,
            navText: [
                "<i class='fa fa-long-arrow-left'></i>",
                "<i class='fa fa-long-arrow-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 2,
                },
                1024: {
                    items: 3,
                },
                768: {
                    items: 2,
                },
                576: {
                    items: 2,
                },

            },
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });
        $('.package-slider').owlCarousel({
            items: 3,
            loop: true,
            margin: 15,
            dots: false,
            nav: true,
            responsiveClass: true,
            navText: [
                "<i class='fa fa-long-arrow-left'></i>",
                "<i class='fa fa-long-arrow-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 2,
                },
                1024: {
                    items: 3,
                },
                768: {
                    items: 2,
                },
                576: {
                    items: 2,
                },

            },
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });
        



        /*====================================
        // tooltip
        ======================================*/

        $('[data-toggle="tooltip"]').tooltip();



        /*====================================
        // Tab link
        ======================================*/

        $('.tab-link').on('click', function(e) {
            e.preventDefault();
            var tab_id = $(this).attr('data-tab');
            $('.tab-link').removeClass('current');
            $(this).addClass('current');
            $(this).parent().parent().find('.tabcontent .booktab-content.current').removeClass('current');
            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        });

        /*====================================
        // major report tab
        ======================================*/

        $('.custom-link').on('click', function (e) {
            e.preventDefault();
            var tab_id = $(this).attr('data-tab');
            $('.custom-link').removeClass('current');
            $(this).addClass('current');
            $(this).parent().parent().find('.tabcontent .tabpane.current').removeClass('current');
            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        });

        // $('.count').each(function () {
        //     $(this).prop('Counter',0).animate({
        //       Counter: $(this).text()
        //     }, {
        //       duration: 5000,
        //       easing: 'swing',
        //       step: function (now) {
        //         $(this).text(Math.ceil(now));
        //       }
        //     });
        //   });
        //tooltips

        
        $('select').niceSelect();

        
            
        
        //   var banderaEstandar= $('#counter');
        //   $(window).on('scroll', function(){
        //       if($(this).scrollTop() + $(this).innerHeight()>=$(this)[0].scrollHeight && banderaEstandar)
        //       {
        //           $('.count').each(function () {
        //           $(this).prop('Counter',0).animate(
        //           {
        //               Counter: $(this).text()
        //           }, 
        //           {
        //               duration: 1000,
        //               easing: 'swing',
        //               step: function (now) {
        //               $(this).text(Math.ceil(now));
        //           }
        //           });
        //           });
        //       }
        //   });

        $('.count').counterUp({ delay: 4, time: 1000 });
        /*====================================
        // menu-fix
        ======================================*/

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 50) {
                $('.site-header').addClass("affix", 500);
            } else {
                $('.site-header').removeClass("affix", 500);
            }
        });

        
        
    });
})(jQuery);

