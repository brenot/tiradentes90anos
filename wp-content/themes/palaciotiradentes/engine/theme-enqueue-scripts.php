<?php 
/**
  * This file for enqueue "functions", "widgets" script, css files.
  * 
  * @since Essence 1.0.
  */

if ( !function_exists( 'essence_frontend_css_js_files' ) ) {
    function essence_frontend_css_js_files(){

        // Nice Scroll ---------------
        wp_enqueue_script( 'jquery.nicescroll.min', get_template_directory_uri() . '/assets/js/jquery.nicescroll.min.js', array( 'jquery' ), ESSENCE_VERSION, true );
        // End Nice Scroll -----------

        // Bootstrap ---------------
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/vendors/bootstrap/css/bootstrap.min.css', false, ESSENCE_VERSION, 'all' );
        wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/vendors/bootstrap/js/bootstrap.min.js', array( 'jquery' ), ESSENCE_VERSION, true );
        // End Bootstrap -----------

        // Images Loaded ---------------
        wp_enqueue_script( 'imagesloaded.pkgd.min', get_template_directory_uri() . '/assets/vendors/images-loaded/imagesloaded.pkgd.min.js', array( 'jquery' ), ESSENCE_VERSION, true );
        // End Images Loaded -----------

        // Masonry ---------------
        wp_enqueue_script( 'masonry.pkgd.min', get_template_directory_uri() . '/assets/vendors/masonry/masonry.pkgd.min.js', array( 'jquery' ), ESSENCE_VERSION, true );
        // End Masonry -----------



        // Pie Chart ---------------
        wp_enqueue_script( 'jquery.easypiechart.min', get_template_directory_uri() . '/assets/vendors/pie-chart/jquery.easypiechart.min.js', array( 'jquery' ), ESSENCE_VERSION, true );
        wp_enqueue_script( 'jquery.easing.min', get_template_directory_uri() . '/assets/vendors/pie-chart/jquery.easing.min.js', array( 'jquery' ), ESSENCE_VERSION, true );
        wp_enqueue_script( 'jquery.countTo', get_template_directory_uri() . '/assets/vendors/pie-chart/jquery.countTo.js', array( 'jquery' ), ESSENCE_VERSION, true );
        // End Pie Chart -----------

    }
    add_action( 'wp_enqueue_scripts', 'essence_frontend_css_js_files' );
}

