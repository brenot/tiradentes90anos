<?php

/**
 * This file for enqueue "functions", "widgets" or "shortcodes" script, css files.
 *
 * @since Essence Core 1.0.
 */


if ( !function_exists( 'essence_core_shortcode_css_js_files' ) ) {

    function essence_core_shortcode_css_js_files()

    {

        {


            /** JS for shortcode "Google Map" **/

            wp_enqueue_script( 'maps.googleapis.com_jssensorfalse', 'https://maps.googleapis.com/maps/api/js?sensor=false', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

            /** End JS for shortcode "Google Map" **/


        }


        add_action( 'wp_enqueue_scripts', 'essence_core_shortcode_css_js_files' );

    }

}


if ( !function_exists( 'essence_core_frontend_css_js_files' ) ) {

    function essence_core_frontend_css_js_files()

    {

        // Map API

        $google_map_js_url = 'https://maps.googleapis.com/maps/api/js?sensor=false';

        wp_register_script( 'google-map', $google_map_js_url, false, ESSENCE_CORE_VERSION, true );

        wp_enqueue_script( 'google-map' );


        // Ban Style nháp, sẽ gộp sau

        wp_enqueue_style( 'essencecore-functions-style', ESSENCE_CORE_CSS_URL . 'functions-style.css', false, ESSENCE_CORE_VERSION, 'all' );


        // Animate CSS

        wp_enqueue_style( 'animate', ESSENCE_CORE_VENDORS_URL . 'animate/animate.css', false, ESSENCE_CORE_VERSION, 'all' );


        // Resize Event ---------------

        wp_enqueue_script( 'debouncedresize', ESSENCE_CORE_VENDORS_URL . 'smartresize/jquery.debouncedresize.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

        wp_enqueue_script( 'throttledresize', ESSENCE_CORE_VENDORS_URL . 'smartresize/jquery.throttledresize.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

        // End Resize Event -----------


        // Images Loaded ---------------

        wp_enqueue_script( 'imagesloaded.pkgd.min', ESSENCE_CORE_VENDORS_URL . 'images-loaded/imagesloaded.pkgd.min.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

        // End Images Loaded -----------


        // Countdown ---------------

        wp_enqueue_script( 'jquery.countdown.min', ESSENCE_CORE_VENDORS_URL . 'countdown/jquery.countdown.min.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

        // End Countdown-----------


        // Awesome Font Icons ---------------

        wp_enqueue_style( 'font-awesome.min', ESSENCE_CORE_VENDORS_URL . 'font-awesome/css/font-awesome.min.css', false, ESSENCE_CORE_VERSION, 'all' );

        // End Awesome Font Icons -----------


        // Elegant Font Icons ---------------

        wp_enqueue_style( 'elegant-font-style', ESSENCE_CORE_VENDORS_URL . 'elegant-icons/css/elegant-font-style.css', false, ESSENCE_CORE_VERSION, 'all' );

        // End Elegant Font Icons -----------


        // Linea Font Icons ---------------

        wp_enqueue_style( 'linea-ecommerce.css', ESSENCE_CORE_VENDORS_URL . 'linea-font-icons/css/linea-ecommerce.css', false, ESSENCE_CORE_VERSION, 'all' );

        wp_enqueue_style( 'linea-software.css', ESSENCE_CORE_VENDORS_URL . 'linea-font-icons/css/linea-software.css', false, ESSENCE_CORE_VERSION, 'all' );

        wp_enqueue_style( 'linea-arrows.css', ESSENCE_CORE_VENDORS_URL . 'linea-font-icons/css/linea-arrows.css', false, ESSENCE_CORE_VERSION, 'all' );

        wp_enqueue_style( 'linea-basic.css', ESSENCE_CORE_VENDORS_URL . 'linea-font-icons/css/linea-basic.css', false, ESSENCE_CORE_VERSION, 'all' );

        wp_enqueue_style( 'linea-music.css', ESSENCE_CORE_VENDORS_URL . 'linea-font-icons/css/linea-music.css', false, ESSENCE_CORE_VERSION, 'all' );

        wp_enqueue_style( 'linea-basic-elaboration.css', ESSENCE_CORE_VENDORS_URL . 'linea-font-icons/css/linea-basic-elaboration.css', false, ESSENCE_CORE_VERSION, 'all' );

        wp_enqueue_style( 'linea-weather.css', ESSENCE_CORE_VENDORS_URL . 'linea-font-icons/css/linea-weather.css', false, ESSENCE_CORE_VERSION, 'all' );

        // End Linea Font Icons -----------


        // Masonry ---------------

        wp_enqueue_script( 'masonry.pkgd.min.js', ESSENCE_CORE_VENDORS_URL . 'masonry/masonry.pkgd.min.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

        // End Masonry -----------


        // Pie Chart ---------------

        wp_enqueue_script( 'jquery.easypiechart.min.js', ESSENCE_CORE_VENDORS_URL . 'pie-chart/jquery.easypiechart.min.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

        wp_enqueue_script( 'jquery.easing.min.js', ESSENCE_CORE_VENDORS_URL . 'pie-chart/jquery.easing.min.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

        wp_enqueue_script( 'jquery.countTo.js', ESSENCE_CORE_VENDORS_URL . 'pie-chart/jquery.countTo.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

        // End Pie Chart -----------


        // Header ---------------

        wp_enqueue_script( 'EasePack.min.js', ESSENCE_CORE_VENDORS_URL . 'header/EasePack.min.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

        wp_enqueue_script( 'TweenLite.min.js', ESSENCE_CORE_VENDORS_URL . 'header/TweenLite.min.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

        // End Header -----------


        // OWL Carousel ---------------

        wp_enqueue_style( 'owl.carousel', ESSENCE_CORE_VENDORS_URL . 'owl-carousel/assets/owl.carousel.css', false, ESSENCE_CORE_VERSION, 'all' );

        wp_enqueue_style( 'owl.theme.default', ESSENCE_CORE_VENDORS_URL . 'owl-carousel/assets/owl.theme.default.css', false, ESSENCE_CORE_VERSION, 'all' );

        wp_enqueue_script( 'owl.carousel.min', ESSENCE_CORE_VENDORS_URL . 'owl-carousel/owl.carousel.min.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

        // End OWL Carousel -----------


        // Wow js

        wp_enqueue_script( 'wow.min', ESSENCE_CORE_VENDORS_URL . 'wow/wow.min.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );


        // Frontend style for plugins

        wp_enqueue_style( 'essencecore-frontend-css', ESSENCE_CORE_CSS_URL . 'frontend-style.css', false, ESSENCE_CORE_VERSION, 'all' );


        // Frontend js for plugins

        wp_enqueue_script( 'essencecore-banner-header.js', ESSENCE_CORE_JS . 'banner-header.js', false, ESSENCE_CORE_VERSION, 'all' );

        wp_enqueue_script( 'essencecore-frontend', ESSENCE_CORE_JS . 'frontend.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );

    }


    add_action( 'wp_enqueue_scripts', 'essence_core_frontend_css_js_files', 9 );

}


/**
 * Enqueue Frontend Custom Styles
 **/

if ( !function_exists( 'essence_core_custom_css' ) ) {

    /*

     * Load css

    */

    function essence_core_custom_css()
    {

        $post_id = essence_core_get_current_post_id();
        wp_enqueue_style( 'essencecore-customize-style', esc_url( admin_url( 'admin-ajax.php' ) ), false, ESSENCE_CORE_VERSION . '&amp;action=essence_core_enqueue_style_via_ajax&amp;post_id=' . esc_attr( $post_id ), 'all' );

    }

    add_action( 'wp_enqueue_scripts', 'essence_core_custom_css', 99 );

}


if ( !function_exists( 'essence_core_google_fonts' ) ) {

    function essence_core_google_fonts()

    {

        wp_enqueue_style( 'wpb-google-fonts', 'http://fonts.googleapis.com/css?family=Abril+Fatface|Arvo:400,700italic,700,400italic', false );


    }


    add_action( 'wp_enqueue_scripts', 'essence_core_google_fonts' );

}