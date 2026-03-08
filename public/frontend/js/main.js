
$(function () {

    "use strict";

    //======MENU FIX JS======
    if ($('.main_menu').offset() != undefined) {
        $(window).bind('scroll', function () {
            if ($(window).scrollTop() > 10) {
                $('.main_menu').addClass('menu_fix');
            } else {
                $('.main_menu').removeClass('menu_fix');
            }
        });
    }

    //=======SELECT2======
    $(document).ready(function () {
        // Check if Select2 is loaded
        if (typeof $.fn.select2 !== 'undefined') {
            // Initialize all select2 elements
            $('.select_2').each(function () {
                var $select = $(this);
                if (!$select.data('select2')) {
                    $select.select2();
                }
            });
        } else {
            // Retry if Select2 not loaded yet
            var retryCount = 0;
            var retryInterval = setInterval(function () {
                retryCount++;
                if (typeof $.fn.select2 !== 'undefined' || retryCount > 20) {
                    clearInterval(retryInterval);
                    if (typeof $.fn.select2 !== 'undefined') {
                        $('.select_2').select2();
                    }
                }
            }, 100);
        }
    });

    //=========COUNTER.JS=========
    // Counter animation disabled - showing static numbers
    // $('.counter').countUp();

    //=======CATEGORY SLIDER======
    //=======CATEGORY SLIDER======
    // Disabled - Categories now use grid layout instead of slider
    // $('.category_slider').slick({
    //     slidesToShow: 11,
    //     slidesToScroll: 1,
    //     autoplay: true,
    //     autoplaySpeed: 4000,
    //     dots: false,
    //     arrows: true,
    //     swipeToSlide: true, // Allow smooth swiping
    //     nextArrow: '<i class="far fa-long-arrow-right nextArrow"></i>',
    //     prevArrow: '<i class="far fa-long-arrow-left prevArrow"></i>',

    //     responsive: [
    //         {
    //             breakpoint: 1200,
    //             settings: {
    //                 slidesToShow: 11,
    //             }
    //         },
    //         {
    //             breakpoint: 992,
    //             settings: {
    //                 slidesToShow: 11, // Force 11 on small desktops/tablets
    //             }
    //         },
    //         {
    //             breakpoint: 768,
    //             settings: {
    //                 slidesToShow: 5,
    //             }
    //         },
    //         {
    //             breakpoint: 576,
    //             settings: {
    //                 slidesToShow: 4,
    //                 slidesToScroll: 1,
    //                 arrows: false,
    //                 centerMode: false,
    //                 variableWidth: false
    //             }
    //         }
    //     ]

    // });

    //=======FEATURED SERVICE SLIDER======
    $('.featured_service_slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="far fa-long-arrow-right nextArrow"></i>',
        prevArrow: '<i class="far fa-long-arrow-left prevArrow"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //=======TESTIMONIAL SLIDER======
    $('.testi_slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //*==========STICKY SIDEBAR=========
    $("#sticky_sidebar").stickit({
        top: 95,
    })

    //=========calender.js=========
    $(function () {
        $('#calendar_js').calendar({
            months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            days: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        });
    });

    //=======TESTIMONIAL SLIDER======
    $('.blog_det_slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //=======CATEGORY SLIDER 2 ======
    $('.category_slider2').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="far fa-long-arrow-right nextArrow"></i>',
        prevArrow: '<i class="far fa-long-arrow-left prevArrow"></i>',

        responsive: [
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //=======FEATURED SERVICE SLIDER======
    $('.featured_service_slider2').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //=======TESTIMONIAL2 SLIDER======
    $('.testi_slider2').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //=======CATEGORY SLIDER 3 ======
    $('.category_slider3').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="far fa-long-arrow-right nextArrow"></i>',
        prevArrow: '<i class="far fa-long-arrow-left prevArrow"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]

    });

    //=======FEATURED SERVICE SLIDER======
    $('.featured_service_slider3').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //*==========SCROLL BUTTON==========
    $('.wsus__scroll_btn').on('click', function () {
        $('html, body').animate({
            scrollTop: 0,
        }, 500);
    });

    $(window).on('scroll', function () {
        var scrolling = $(this).scrollTop();
        if (scrolling > 300) {
            $('.wsus__scroll_btn').fadeIn();
        } else {
            $('.wsus__scroll_btn').fadeOut();
        }
    });

    //*==========ORDER HISTORY==========
    $(".view_invoice").on("click", function () {
        $(".wsus_dashboard_order").fadeOut();
    });

    $('.view_invoice').on('click', function () {
        $(".wsus__invoice").fadeIn();
    });

    $(".go_back").on("click", function () {
        $(".wsus_dashboard_order").fadeIn();
    });

    $(".go_back").on("click", function () {
        $(".wsus__invoice").fadeOut();
    });

    //*==========DASHBOARD TICKET==========
    $(".ticket_invoice_view").on("click", function () {
        $(".support_ticket").fadeOut();
    });

    $('.ticket_invoice_view').on('click', function () {
        $(".wsus__ticket_list_view").fadeIn();
    });

    $(".go_ticket").on("click", function () {
        $(".support_ticket").fadeIn();
    });

    $(".go_ticket").on("click", function () {
        $(".wsus__ticket_list_view").fadeOut();
    });

    $(".dash_info_btn").click(function () {
        $(".wsus_dash_personal_info").toggleClass("show");
    });

    $(".dash_info_btn").click(function () {
        $(".dash_info_btn").toggleClass("active");
    });

    //=======FEATURED SERVICE SLIDER======
    $('.related_services_slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="far fa-angle-right nextArrow"></i>',
        prevArrow: '<i class="far fa-angle-left prevArrow"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //=======MOBILE MENU TOGGLE - WORKING FIX======
    // Define functions globally
    window.openMobileMenu = function () {
        var menu = document.getElementById('navbarNav');
        var togglers = document.querySelectorAll('.navbar-toggler');
        if (menu) {
            menu.classList.remove('collapse', 'collapsing');
            menu.classList.add('show');
        }
        togglers.forEach(function (toggler) {
            toggler.classList.add('show_m_close');
            toggler.setAttribute('aria-expanded', 'true');
        });
    };

    window.closeMobileMenu = function () {
        var menu = document.getElementById('navbarNav');
        var togglers = document.querySelectorAll('.navbar-toggler');
        if (menu) {
            menu.classList.remove('show', 'collapsing');
            menu.classList.add('collapse');
        }
        togglers.forEach(function (toggler) {
            toggler.classList.remove('show_m_close');
            toggler.setAttribute('aria-expanded', 'false');
        });
        if (typeof $ !== 'undefined') {
            $('.main_menu .navbar-nav .nav-item').removeClass('active');
            $('.main_menu .navbar-nav .nav-item .wsus__droap_menu').slideUp(200);
        }
    };

    // Initialize menu handler
    function initMobileMenu() {
        // Remove Bootstrap data attributes and destroy Bootstrap instance
        var togglers = document.querySelectorAll('.navbar-toggler');
        togglers.forEach(function (toggler) {
            toggler.removeAttribute('data-bs-toggle');
            toggler.removeAttribute('data-bs-target');
        });

        // Destroy Bootstrap collapse if exists
        if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
            var menuEl = document.getElementById('navbarNav');
            if (menuEl) {
                var instance = bootstrap.Collapse.getInstance(menuEl);
                if (instance) {
                    instance.dispose();
                }
            }
        }

        // Close menu on load
        if (window.innerWidth <= 991) {
            window.closeMobileMenu();
        }
    }

    // Handle clicks using jQuery with high priority
    $(document).ready(function () {
        initMobileMenu();

        // Use jQuery with off() then on() to ensure our handler runs
        $(document).off('click', '.navbar-toggler').on('click', '.navbar-toggler', function (e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();

            if (window.innerWidth <= 991) {
                var menu = document.getElementById('navbarNav');
                if (menu) {
                    var isOpen = menu.classList.contains('show');
                    if (isOpen) {
                        window.closeMobileMenu();
                    } else {
                        window.openMobileMenu();
                    }
                }
            }
            return false;
        });

        // Handle icon clicks
        $(document).off('click', '.open_m_menu, .close_m_menu').on('click', '.open_m_menu, .close_m_menu', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('.navbar-toggler').trigger('click');
            return false;
        });
    });

    // Close menu when clicking on a link without dropdown
    // NOTE: Dropdown items are handled in layout.blade.php, so we exclude them here
    $(document).on('click', '.main_menu .navbar-nav .nav-item:not(.has-dropdown) .nav-link', function (e) {
        if ($(window).width() <= 991) {
            var $link = $(this);
            var href = $link.attr('href');
            if (href && href !== 'javascript:;' && href !== '#' && !$link.hasClass('dropdown-toggle')) {
                setTimeout(function () {
                    if (typeof window.closeMobileMenu === 'function') {
                        window.closeMobileMenu();
                    }
                }, 100);
            }
        }
    });

    // Close dropdowns when clicking on dropdown links
    $(document).on('click', '.main_menu .navbar-nav .nav-item .wsus__droap_menu a', function (e) {
        if ($(window).width() <= 991) {
            setTimeout(function () {
                if (typeof window.closeMobileMenu === 'function') {
                    window.closeMobileMenu();
                }
            }, 100);
        }
    });

    // Close menu when clicking outside
    $(document).on('click', function (e) {
        if ($(window).width() <= 991) {
            var $menu = $('#navbarNav');
            if ($menu.hasClass('show')) {
                if (!$(e.target).closest('.main_menu').length && !$(e.target).is('.navbar-toggler') && !$(e.target).closest('.navbar-toggler').length) {
                    if (typeof window.closeMobileMenu === 'function') {
                        window.closeMobileMenu();
                    }
                }
            }
        }
    });

    $(".wsus__message__button").click(function () {
        $(".wsus__message_area").addClass("show_chat");
    });

    $(".close_chat").click(function () {
        $(".wsus__message_area").removeClass("show_chat");
    });

    $("#change-header-language").on("change", function () {
        $("#change-header-language").submit();
    });

    $("#change-header-currency").on("change", function () {
        $("#change-header-currency").submit();
    });

    //========NICE SELECT==========
    $('.select_js').niceSelect();

});
