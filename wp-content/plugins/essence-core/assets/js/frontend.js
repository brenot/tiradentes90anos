jQuery(document).ready(function ($) {

    "use strict";

    new WOW().init();

    function essence_init_owl_carousel() {

        $('.essence-owl-carousel').each(function () {

            var $this = $(this),
                $loop = $this.attr('data-loop') == "yes",
                $numberItem = parseInt($this.attr('data-number')),
                $Nav = $this.attr('data-navcontrol') == "yes",
                $Dots = $this.attr('data-dots') == "yes",
                $autoplay = $this.attr('data-autoplay') == "yes",
                $autoplayTimeout = parseInt($this.attr('data-autoplaytimeout')),
                $marginItem = parseInt($this.attr('data-margin')),
                $rtl = $this.attr('data-rtl') == "yes",
                $autoHeight = $this.attr('data-autoheight') == "yes",
                $resNumber = {
                    0: {
                        items: 1
                    }
                }; // Responsive Settings

            $numberItem = (isNaN($numberItem)) ? 1 : $numberItem;
            $autoplayTimeout = (isNaN($autoplayTimeout)) ? 4000 : $autoplayTimeout;
            $marginItem = (isNaN($marginItem)) ? 0 : $marginItem;

            if (!$this.is('.owl-carousel')) {
                $this.addClass('owl-carousel');
            }

            //console.log($Nav);

            switch ($numberItem) {

                case 1 :
                    $resNumber = {
                        0: {
                            items: 1
                        }
                    }
                    break;

                case 2 :
                    $resNumber = {
                        0: {
                            items: 1
                        },
                        480: {
                            items: 1
                        },
                        768: {
                            items: 2
                        },
                        992: {
                            items: $numberItem
                        }
                    }
                    break;

                case 3 :
                case 4 :
                    $resNumber = {
                        0: {
                            items: 1
                        },
                        480: {
                            items: 1
                        },
                        768: {
                            items: 2
                        },
                        992: {
                            items: 3
                        },
                        1200: {
                            items: $numberItem
                        }
                    }
                    break;

                default : // $numberItem > 4
                    $resNumber = {
                        0: {
                            items: 1
                        },
                        480: {
                            items: 2
                        },
                        768: {
                            items: 3
                        },
                        992: {
                            items: 4
                        },
                        1200: {
                            items: $numberItem
                        }
                    }
                    break;
            } // Endswitch

            $(this).owlCarousel({
                items: $numberItem,
                loop: $loop,
                nav: $Nav,
                navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
                navContainer: false,
                dots: $Dots,
                autoplay: $autoplay,
                autoplayTimeout: $autoplayTimeout,
                autoHeight: $autoHeight,
                margin: $marginItem,
                //responsiveClass:true,
                rtl: $rtl,
                responsive: $resNumber,
                autoplayHoverPause: true,
                //center: true,
                onRefreshed: function () {
                    var total_active = $this.find('.owl-item.active').length;
                    var i = 0;

                    $this.find('.owl-item').removeClass('active-first active-last');
                    $this.find('.owl-item.active').each(function () {
                        i++;
                        if (i == 1) {
                            $(this).addClass('active-first');
                        }
                        if (i == total_active) {
                            $(this).addClass('active-last');
                        }
                    });
                },
                onTranslated: function () {
                    var total_active = $this.find('.owl-item.active').length;
                    var i = 0;

                    $this.find('.owl-item').removeClass('active-first active-last');
                    $this.find('.owl-item.active').each(function () {
                        i++;
                        if (i == 1) {
                            $(this).addClass('active-first');
                        }
                        if (i == total_active) {
                            $(this).addClass('active-last');
                        }
                    });
                },
                onResized: function () {
                    //essence_set_equal_columns();
                }
            });

        });
    }

    //essence_init_owl_carousel();

    //BUTTON HOVER
    $('.ts-button-shortcode').each(function () {
        //console.log("Vao chưa ?");
        var $bgHover = $(this).attr('data-hoverbg');
        var $colorHover = $(this).attr('data-colorhover');
        var $bg = $(this).attr('data-bg');
        var $color = $(this).attr('data-color');
        var $colorShadow = $(this).attr('data-colorshadow');
        var $hoverShadow = $(this).attr('data-shadowhover');
        $(this).css({
            'background': $bg,
            'color': $color
        });
        if ($(this).hasClass('button-3d')) {
            if ($colorShadow != '') {
                $(this).css({
                    'box-shadow': '0 3px 0 ' + $colorShadow,
                    '-moz-box-shadow': '0 3px 0 ' + $colorShadow,
                    '-webkit-box-shadow': '0 3px 0 ' + $colorShadow
                });
            }
            if ($colorShadow != '' && $hoverShadow != '') {
                $(this).hover(function () {
                    $(this).css({
                        'box-shadow': '0 3px 0 ' + $hoverShadow,
                        '-moz-box-shadow': '0 3px 0 ' + $hoverShadow,
                        '-webkit-box-shadow': '0 3px 0 ' + $hoverShadow
                    });
                }, function () {
                    $(this).css({
                        'box-shadow': '0 3px 0 ' + $colorShadow,
                        '-moz-box-shadow': '0 3px 0 ' + $colorShadow,
                        '-webkit-box-shadow': '0 3px 0 ' + $colorShadow
                    });
                });
            }
        }
        ;

        if ($(this).hasClass('button-outline')) {
            $(this).css({
                'border-color': $color
            })
            $(this).hover(function () {
                $(this).css("border-color", $bgHover);
            }, function () {
                $(this).css("border-color", $color);
            });
        }

        $(this).hover(function () {
            $(this).find('.ts-button-hover').css("background", $bgHover);
            $(this).find('.ts-button-text').css("color", $colorHover);
            $(this).find('.ts-icon-button').css("color", $colorHover);
        }, function () {
            $(this).find('.ts-button-hover').css("background", '');
            $(this).find('.ts-button-text').css("color", '');
            $(this).find('.ts-icon-button').css("color", '');
        })


    });

    // Count down (coming soon mode)
    // Coming Soon Countdown
    $('.essence-countdown-wrap').each(function () {
        var $this = $(this);
        var countdown_to_date = $this.attr('data-countdown');

        if (typeof countdown_to_date == 'undefined' || typeof countdown_to_date == false) {
            var cd_class = $this.attr('class');
            if ($.trim(cd_class) != '') {
                cd_class = cd_class.split('essence-cms-date_');
                if (typeof cd_class[1] != 'undefined' && typeof cd_class[1] != false) {
                    countdown_to_date = cd_class[1];
                }
            }
        }

        if (typeof countdown_to_date != 'undefined' && typeof countdown_to_date != false) {
            if ($this.hasClass('countdown-admin-menu')) { // For admin login
                $this.find('a').countdown(countdown_to_date, function (event) {
                    $this.find('a').html(
                        event.strftime(essence['html']['countdown_admin_menu'])
                    );
                });
            }
            else {
                $this.countdown(countdown_to_date, function (event) {
                    $this.html(
                        event.strftime(essence['html']['countdown'])
                    );
                });
            }
        }

    });

    // EQUAL ELEM
    function essence_equal_elems() {
        $('.equal-container').each(function () {
            var $this = $(this);
            if ($this.find('.equal-elem').length) {
                $this.find('.equal-elem').css({
                    'height': 'auto'
                });
                var elem_height = 0;
                $this.find('.equal-elem').each(function () {
                    var this_elem_h = $(this).height();
                    if (elem_height < this_elem_h) {
                        elem_height = this_elem_h;
                    }
                });
                $this.find('.equal-elem').height(elem_height);
            }
        });
    }

    essence_equal_elems();
    // END EQUAL ELEM

    // NEWSLETTER
    // Submit Mailchimp via ajax
    $(document).on('submit', 'form[name="news_letter"]', function (e) {

        var $this = $(this);
        var thisWrap = $this.closest('.newsletter-form-wrap');

        if ($this.hasClass('processing')) {
            return false;
        }

        var api_key = $this.find('input[name="api_key"]').val();
        var list_id = $this.find('input[name="list_id"]').val();
        var success_message = $this.find('input[name="success_message"]').val();
        var email = $this.find('input[name="email"]').val();

        var data = {
            action: 'essence_core_submit_mailchimp_via_ajax',
            api_key: api_key,
            list_id: list_id,
            success_message: success_message,
            email: email
        }

        $this.addClass('processing');
        thisWrap.find('.return-message').remove();

        $.post(ajaxurl, data, function (response) {

            if ($.trim(response['success']) == 'yes') {
                $this.after('<p class="return-message bg-success">' + response['message'] + '</p>');
                $this.find('input[name="email"]').val('');
            }
            else {
                $this.after('<p class="return-message bg-danger">' + response['message'] + '</p>');
            }

            console.log(response);
            $this.removeClass('processing');

        });

        e.preventDefault();
        return false;

    });
    
    
    /* START JS FOR SHORTCODE: GOOGLE MAP ====================================== */
    $('.ts-gmaps').each(function () {
        var $this = $(this),
            $id = $this.attr('id'),
            $zoom = parseInt($this.attr('data-zoom')),
            $latitude = $this.attr('data-latitude'),
            $longitude = $this.attr('data-longitude'),
            $address = $this.attr('data-address'),
            $info_title = $this.attr('data-info_title'),
            $phone = $this.attr('data-phone'),
            $email = $this.attr('data-email'),
            $website = $this.attr('data-website'),
            $map_type = $this.attr('data-map-type'),
            $pin_icon = $this.attr('data-pin-icon'),
            $pan_control = $this.attr('data-pan-control') === "true" ? true : false,
            $map_type_control = $this.attr('data-map-type-control') === "true" ? true : false,
            $scale_control = $this.attr('data-scale-control') === "true" ? true : false,
            $draggable = $this.attr('data-draggable') === "true" ? true : false,
            $zoom_control = $this.attr('data-zoom-control') === "true" ? true : false,
            $modify_coloring = $this.attr('data-modify-coloring') === "true" ? true : false,
            $saturation = $this.attr('data-saturation'),
            $hue = $this.attr('data-hue'),
            $lightness = $this.attr('data-lightness'),
            $styles;


        if ($modify_coloring == true) {
            var $styles = [{
                stylers: [{
                    hue: $hue
                }, {
                    saturation: $saturation
                }, {
                    lightness: $lightness
                }, {
                    featureType: "landscape.man_made",
                    stylers: [{
                        visibility: "on"
                    }]
                }]
            }];
        }

        var map;

        function initialize() {
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                zoom: $zoom,
                panControl: $pan_control,
                zoomControl: $zoom_control,
                mapTypeControl: $map_type_control,
                scaleControl: $scale_control,
                draggable: $draggable,
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId[$map_type],
                styles: $styles
            };

            map = new google.maps.Map(document.getElementById($id), mapOptions);
            map.setTilt(45);


            // Multiple Markers

            var markers = [];
            var infoWindowContent = [];

            if ($latitude != '' && $longitude != '') {
                markers[0] = [$address, $latitude, $longitude];

                var info_show_html = '';
                if ($.trim($info_title) != '') {
                    info_show_html += '<h4 class="map_info_title">' + $info_title + '</h4>';
                }

                if ($.trim($address) != '') {
                    info_show_html += '<p>' + $address + '</p>';
                }

                if ($.trim($phone) != '') {
                    info_show_html += '<i class="fa fa-phone"></i>' + $phone + '<br />';
                }

                if ($.trim($email) != '') {
                    info_show_html += '<i class="fa fa-envelope"></i><a href="mailto:' + $email + '">' + $email + '</a><br />';
                }

                if ($.trim($website) != '') {
                    info_show_html += '<i class="fa fa-globe"></i><a href="' + $website + '" target="_blank">' + $website + '</a><br />';
                }

                if ($.trim(info_show_html) != '') {
                    info_show_html = '<div class="map_info_box">' + info_show_html + '</div>';
                }

                infoWindowContent[0] = [info_show_html];
            }

            var infoWindow = new google.maps.InfoWindow(), marker, i;

            for (i = 0; i < markers.length; i++) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: markers[i][0],
                    icon: $pin_icon
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        if (infoWindowContent[i][0].length > 1) {
                            console.log(infoWindowContent[i][0]);
                            infoWindow.setContent(infoWindowContent[i][0]);
                        }

                        infoWindow.open(map, marker);
                    }
                })(marker, i));

                map.fitBounds(bounds);

            }

            var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
                this.setZoom($zoom);
                google.maps.event.removeListener(boundsListener);
            });
        }

        initialize();

        function googleMapsResize() {
            initialize();
        }

        var temporaryTabsContainer = jQuery('.mk-tabs');
        if (temporaryTabsContainer.length) {
            temporaryTabsContainer.each(function () {
                google.maps.event.addDomListener($(this)[0], "click", googleMapsResize);
            });

        }

        var fullHeight = $this.hasClass('full-height-map');

        function fullHeightMap() {
            if (fullHeight) {
                var $window_height = jQuery(window).outerHeight(), wp_admin_height = 0, header_height = 0;
                if (jQuery.exists('#mk-header .mk-header-holder')) {
                    header_height = parseInt(jQuery('#mk-header').attr('data-sticky-height'));
                }

                if (jQuery.exists("#wpadminbar")) {
                    var wp_admin_height = jQuery("#wpadminbar").outerHeight();
                }

                $window_height = $window_height - wp_admin_height - header_height;
                $this.css('height', $window_height);
            }
        }

        fullHeightMap();
        jQuery(window).on('debouncedresize', fullHeightMap);
    });
    /* END JS FOR SHORTCODE: GOOGLE MAP ======================================== */


    /* START JS FOR SHORTCODE: PIE CHART ====================================== */
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
    /* END JS FOR SHORTCODE: PIE CHART ======================================== */


    /* START JS FOR SHORTCODE: COUNTDOWN ====================================== */
    $('.tr-countdown').each(function () {
        var $this = $(this);
        var countdown_to_date = $this.attr('data-time');

        if (typeof countdown_to_date == 'undefined' || typeof countdown_to_date == false) {
            return false;
        }

        $this.countdown(countdown_to_date, function (event) {
            var ts_day = event.strftime('%D');
            var ts_hour = event.strftime('%H');
            var ts_minute = event.strftime('%M');
            var ts_second = event.strftime('%S');
            $this.find('.ts-cdown-days').html(ts_day);
            $this.find('.ts-cdown-hours').html(ts_hour);
            $this.find('.ts-cdown-minutes').html(ts_minute);
            $this.find('.ts-cdown-seconds').html(ts_second);
        });

    });
    /* END JS FOR SHORTCODE: COUNTDOWN ====================================== */

    /* START JS FOR SHORTCODE: IMAGE INTRO ====================================== */

    function essence_core_img_intro_cal() {
        $('.image-intro-wrap').each(function () {

            var $this = $(this);
            var imgWrap = $this.find('.image-wrap');
            var introBox = $this.find('.intro-box');
            var this_w = $this.width();
            var img_wrap_w = this_w * 670 / 1170; // Design ratio

            var intro_box_w = this_w - img_wrap_w;

            if (this_w > 768) {

            }

            imgWrap.css({
                'width': img_wrap_w + 'px'
            });

            introBox.css({
                'width': intro_box_w + 'px'
            });

        });
    }

    essence_core_img_intro_cal();

    /* END JS FOR SHORTCODE: IMAGE INTRO ====================================== */

    /* START JS FOR HEADER FULL HEIGHT BOX ====================================== */
    function essence_core_make_header_box_full_height() {
        if ($('.header-full-height-box').length) {
            var w_h = $(window).height();
            $('.header-full-height-box').height(w_h);
        }
    }

    //essence_core_make_header_box_full_height();

    /* END JS FOR HEADER FULL HEIGHT BOX ====================================== */

    /* End JS run after all loaded ====================================== */

    /* JS run when window resize ====================================== */
    $(window).resize(function () {
        //essence_core_make_header_box_full_height();
    });

    /* End JS run when window resize ====================================== */
    

    $(window).on("debouncedresize", function () {
        essence_equal_elems();
    });

    $(window).load(function () {
        essence_init_owl_carousel();
        essence_equal_elems();
        essence_core_img_intro_cal();
    });

});