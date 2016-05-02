jQuery(document).ready(function ($) {

    "use strict";
    // Js croll one page.
    $('.menu-one-page-container ul#navbar a[href*=#]').bind('click', function (e) {
        e.preventDefault(); //prevent the "normal" behaviour which would be a "hard" jump

        var target = $(this).attr("href"); //Get the target

        // perform animated scrolling by getting top-position of target-element and set it as scroll target
        if ($(target).length) {
            $('html, body').stop().animate({scrollTop: $(target).offset().top}, 500, function () {
                location.hash = target;  //attach the hash (#jumptarget) to the pageurl
            });
            return false;
        }

    });

    //One page fixed
    $('.header-style-3 .tr-header').addClass('header-sticky-transparent');
    if ($('.menu-one-page-container').length) {
        $('.tr-header').addClass('header-onepage');
    }
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if ($('.header-style-3').length) {
            if (scroll >= $(window).outerHeight()) {
                $(".tr-header").addClass('header-sticky');
                $(".tr-header").removeClass('header-sticky-transparent');
            } else {
                $(".tr-header").removeClass('header-sticky');
                $(".tr-header").addClass('header-sticky-transparent');
            }

        }
        if($(window).width()>1024){
            if((!$('.essence_menu_sticky').hasClass('header-style-3')) && ($('.essence_menu_sticky').length)){
                if (scroll >= 10) {
                    $(".site-header").addClass('tr-header-sticky');
                } else {
                    $(".site-header").removeClass('tr-header-sticky');
                }
            }
        }
    });

    // Close messeage

    $('.tr-message-close').on("click", function () {

        $(this).parent().remove();

    })
    // Color Changer
    $('.color-changer').each(function () {
        var $this = $(this);
        var this_color = $this.attr('data-color');
        var this_hover_color = $this.attr('data-hover-color');
        var selector = $this;

        if (typeof this_color != 'undefined' && typeof this_color != false) {
            var target = $this.attr('data-c-target');
            if ($.trim(target) != '') {
                if ($this.find($.trim(target).length)) {
                    selector = $this.find($.trim(target));
                    selector.css({
                        color: this_color
                    });
                }
            }
            else {
                selector.css({
                    color: this_color
                });
            }
        }

        // Hover color
        if (typeof this_hover_color != 'undefined' && typeof this_hover_color != false) {
            var target_hover = $this.attr('data-hover-c-target');
            if ($.trim(target_hover) != '') {
                $this.find($.trim(target_hover)).each(function () {

                    // For nav menu (active)
                    if ($(this).closest('.menu-item.active').length) {
                        $(this).closest('.menu-item.active').find('> a, > .ts-has-children > i').css({
                            'color': this_hover_color
                        });
                    }

                    var color_before_hover = $(this).css('color');
                    if (typeof this_color != 'undefined' && typeof this_color != false) {
                        color_before_hover = this_color;
                    }
                    if ($(this).closest('.menu-item.active').length) { // Active menu item
                        color_before_hover = this_hover_color;
                    }
                    $(this).hover(function () {
                        $(this).css({
                            'color': this_hover_color
                        });

                        // For nav menu
                        if ($(this).closest('.menu-item').length && $(this).is('a')) {
                            $(this).closest('.menu-item').find('> a, > .ts-has-children > i').css({
                                'color': this_hover_color
                            });
                        }

                    }, function () {
                        $(this).css({
                            'color': color_before_hover
                        });

                        // For nav menu
                        if ($(this).closest('.menu-item').length && $(this).is('a')) {
                            $(this).closest('.menu-item').find('> a, > .ts-has-children > i').css({
                                'color': color_before_hover
                            });
                        }
                    });
                });
            }
        }

    });

    $('.bg-color-changer').each(function () {
        var $this = $(this);
        var this_color = $this.attr('data-bg-color');
        var selector = $this;

        if (typeof this_color != 'undefined' && typeof this_color != false) {
            var target = $this.attr('data-bgc-target');
            if ($.trim(target) != '') {
                if ($this.find($.trim(target).length)) {
                    selector = $this.find($.trim(target));
                    selector.css({
                        'background-color': this_color
                    });
                }
            }
            else {
                selector.css({
                    'background-color': this_color
                });
            }
        }
    });

    // Bullet number for Rev Slider on header style 3
    function essence_bullet_to_number_for_header_style_3() {
        if ($('.header-style-3 .hermes .tp-bullet').length) {
            var i = 1;
            $('.header-style-3 .hermes .tp-bullet').each(function () {
                var i_text = i < 10 ? '0' + i : i;
                $(this).html('<span>' + i_text + '</span>');
                i++;
            });
        }
    }

    essence_bullet_to_number_for_header_style_3();

    //CATEGORIES GRID
    $('.grid-masonry').each(function () {
        var $isotopGrid = $(this);
        var layout_mode = $isotopGrid.attr('data-layoutmode');
        // Re-layout after images loaded
        $isotopGrid.isotope({
            resizable: false,
            itemSelector: '.grid',
            layoutMode: layout_mode,
            transitionDuration: '0.6s',
            packery: {
                gutter: 0
            },
        }).isotope('layout');

        // layout Isotope after each image loads
        $isotopGrid.imagesLoaded().progress(function () {
            $isotopGrid.isotope('layout');
        });
    });

    //Accordion

    var icons = {

        header: "ts-plus",

        activeHeader: "ts-minus"

    };

    $(".ts-accordion").accordion({

        icons: icons,

        active: 0,

        collapsible: true

    });


    //BACK TO TOP
    $('.backtotop').click(function () {
        $('html,body').animate({scrollTop: 0}, 800);
        return false;
    })

    //FULL-HEIGHT
    fullHeight();
    Tr_height_header();
    Tr_heade_scroll();
    $(window).on("debouncedresize", function () {
        fullHeight();
        Tr_height_header();
        Tr_heade_scroll();
    });

    //PIE CHART
    $(".ts-chart").each(function () {
        var size = $(this).attr('data-size'),
            barColor = $(this).attr('data-barColor'),
            trackColor = $(this).attr('data-trackColor'),
            lineWidth = $(this).attr('data-lineWidth');
        $(this).easyPieChart({
            easing: 'easeInOutQuad',
            barColor: barColor,
            animate: 2000,
            trackColor: trackColor,
            lineWidth: lineWidth,
            size: size,
            scaleColor: false,
            lineCap: 'square',
            onStep: function (from, to, percent) {
                $(this.el).find('.chart-percent').text(Math.round(percent) + '%');
            }
        });
        $(this).find('span').css({
            'line-height': size + 'px',
            'color': barColor,
        });
    });

    //FUNFACT %
    $('.ts-funfact').each(function () {
        var count_element = $(this).find('.funfact-number').attr('data-number');
        if (count_element != '') {
            $(this).find('.funfact-number').countTo({
                from: 0,
                to: count_element,
                speed: 3000,
                refreshInterval: 50,
            })
        }
        ;
    });
    //SKILL BAR
    $('.item-skillbar').each(function () {
        var $percentSkill = $(this).attr('data-percent'),
            $bgSkill = $(this).attr('data-bgskill');

        $(this).find('.skillbar-bar').animate({
            'width': $percentSkill + '%'
        }, 6000);
        if ($bgSkill != '') {
            $(this).find('.skillbar-bar').css({
                'background-color': $bgSkill
            });
        }
        ;
    });

    //SET WIDTH MEGAMENU
    $('.navigation-essence-2 .megamenu-menu-item').each(function () {
        var widthSubmenu = $(this).find('.sub-menu').attr('data-width');
        $(this).find('.sub-menu').css("min-width", widthSubmenu + 'px');
    });


    //LEFT SUBMENU
    essence_submenu_adjustments();

    $('li.menu-item-has-children > .ts-has-children').on('click', function (e) {

        var $this = $(this);
        var thisLi = $this.closest('li');
        var thisUl = thisLi.closest('ul');
        var url = $this.attr('href');

        if (typeof url == 'undefined' || typeof url == false) {
            url = '';
        }

        if ($.trim(url) == '' || $.trim(url) == '#') {
            if (thisLi.is('.sub-menu-open')) {
                thisLi.find('> .sub-menu').stop().slideUp(50);
                thisLi.removeClass('sub-menu-open').find('> a').removeClass('active');
            }
            else {
                thisUl.find('> li.sub-menu-open > .sub-menu').stop().slideUp(50);
                thisUl.find('> li.sub-menu-open').removeClass('sub-menu-open'); 
                thisUl.find('> li > a.active').removeClass('active');
                thisLi.find('> .sub-menu').stop().slideDown('fast');
                //thisLi.find('> .sub-menu').niceScroll();
                thisLi.addClass('sub-menu-open').find('> a').addClass('active');
            }

            e.preventDefault();
            e.stopPropagation();
        }

    });

    // Nice Scroll for main nav menu (header style 2)
    if ($('.header-style-2 #site-navigation .menu-menu-main-container').length) {
        $('.header-style-2 #site-navigation .menu-menu-main-container').niceScroll();
    }

    //Header
    //$(".nav-menu li.menu-item-has-children > a").after("<span class='ts-has-children'><i class='fa fa-caret-down'></i></span>");
    $(".navbar-toggle").on("click", function () {
        $('.site-header').toggleClass("site-header-active");
    })

    //Menu open mobile
    //$(document).on('click', 'li.menu-item-has-children .ts-has-children', function (e) {
    //
    //    var $this = $(this);
    //    var thisLi = $this.closest('li');
    //    var thisUl = thisLi.closest('ul');
    //
    //    if (thisLi.is('.show-dropdown-menu')) {
    //        thisLi.removeClass('show-dropdown-menu');
    //    }
    //    else {
    //        thisUl.find('> li').removeClass('show-dropdown-menu');
    //        thisLi.addClass('show-dropdown-menu');
    //    }
    //
    //});

    //ADMIN BAR
    if ($('#wpadminbar').length > 0) {
        $('body').addClass('ts-adminbar');
    }


    // =========================================================================

    function essence_create_event(event_name) {
        var evt = document.createEvent('UIEvents');
        evt.initUIEvent(event_name, true, false, window, 0);
        window.dispatchEvent(evt);
    }

    // Init masonry blog
    function essence_init_masonry() {
        $('.posts-masonry').each(function () {
            var masonryGrid = $(this);
            if (masonryGrid.hasClass('processing-masonry')) {
                return false;
            }
            masonryGrid.addClass('processing-masonry');
            masonryGrid.masonry({
                // options
                itemSelector: '.type-post',
            }).on('layoutComplete', function () {
                masonryGrid.removeClass('processing-masonry');
            });
        });
    }

    essence_init_masonry();

    $(window).resize(function () {
        essence_init_masonry();
    });

    $(window).load(function () {
        $('.posts-masonry').removeClass('processing-masonry');
        essence_init_masonry();
        essence_bullet_to_number_for_header_style_3();
        //Tr_height_blog_list();
        $(window).on("debouncedresize", function () {
            //Tr_height_blog_list();
        });
    });


    // Load More Masonry
    $(document).on('click', '.blog-masonry-loadmore-btn', function (e) {

        var $this = $(this);

        if ($this.hasClass('locked') || $this.hasClass('no-more-post')) {
            return false;
        }

        var masonryContainer = $this.closest('.masonry-container');
        var masonryGrid = masonryContainer.find('.posts-masonry');
        var except_post_ids = Array();
        masonryGrid.find('.type-post').each(function () {
            var post_id = $(this).attr('id').replace('post-', '');
            except_post_ids.push(post_id);
        });
        var sidebar_pos = $this.attr(' data-sidebar-pos');

        $this.addClass('locked').html('Loading...');

        var data = {
            action: 'essence_loadmore_masonry_via_ajax',
            except_post_ids: except_post_ids,
            sidebar_pos: sidebar_pos
        };

        $.post(ajaxurl, data, function (response) {

            var items = [];
            $.each(response['items'], function (index, item_html) {

                var $elem = $(item_html);
                masonryGrid.append($elem).masonry('appended', $elem);

            });

            // layout Masonry after each image loads
            masonryGrid.imagesLoaded().progress(function () {
                masonryGrid.masonry('layout');
            });

            $this.removeClass('locked').html(response['load_more_text']);

            if (response['nomore_post'] == 'yes') {
                $this.addClass('no-more-post');
            }

            console.log(response);

        });

        e.preventDefault();

    });

    function fullHeight() {

        var window_h = $(window).height();
        var header_h = $('header').outerHeight();
        var wpadminbar_h = 0;

        if ($('#wpadminbar').length) {
            wpadminbar_h = $('#wpadminbar').outerHeight();
        }

        var full_h = window_h - header_h - 60 - wpadminbar_h;
        $('.fullheight').css('height', full_h);

    }

    function essence_submenu_adjustments() {

        $(".navigation-essence-2 > ul > .menu-item-has-children").mouseenter(function () {
            if ($(this).children(".sub-menu").length > 0) {
                var submenu = $(this).children(".sub-menu");
                var window_width = parseInt($(window).outerWidth());
                var submenu_width = parseInt(submenu.outerWidth());
                var submenu_offset_left = parseInt(submenu.offset().left);
                var submenu_adjust = window_width - submenu_width - submenu_offset_left;

                if (submenu_adjust < 0) {
                    submenu.css("left", submenu_adjust - 30 + "px");
                }
            }
        });
    }

    /*---------------------------------------------
     Height Full
     --------------------------------------------- */
    function Tr_height_blog_list() {
        (function ($) {
            if ($(window).width() > 991) {
                var heightpost = $('.posts-standard .tr-img-post').outerHeight() - 1;
                $(".tr-img-post").css("height", heightpost);
                $(".tr-content-post").css("height", heightpost);
            }
        })(jQuery);
    }

    /*---------------------------------------------
     Height Full
     --------------------------------------------- */
    function Tr_height_header() {
        (function ($) {
            var heightoff = 0;
            if ($('#wpadminbar').length) {
                heightoff = $('#wpadminbar').outerHeight();
            }
            var heightheader = $(window).outerHeight();
            //Scroll down
            $('.header-scrolldown-wrap').click(function () {
                $('html,body').animate({scrollTop: heightheader}, 800);
                return false;
            })

        })(jQuery);
    }
    /*---------------------------------------------
    Height Full
    --------------------------------------------- */
    function Tr_heade_scroll() {
        (function ($) {
            var heightheaderscroll = $(window).outerHeight();
            var heightscroll = $('.header-scrolldown-wrap').outerHeight();
            //Scroll down
            if(!$('div').hasClass('essence-banner-revolution')){
                $(".header-scrolldown-wrap").css("top", heightheaderscroll - heightscroll);
                $(".header-scrolldown-wrap").addClass('header_no_banner');
            }
           

        })(jQuery);
    }

    // var bg_color = $('.thuy').css('background-color');

    //SEARCH BOX
    $('.site-header .search-togole').on("click", function () {
        $('.search-box').fadeIn('1000');
    })
    $('.overlay-box').on("click", function () {
        $('.search-box').fadeOut('slow');
    })

});