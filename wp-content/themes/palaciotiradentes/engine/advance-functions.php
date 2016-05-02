<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Essence
 */


if ( !function_exists( 'essence_get_global_essence' ) ) {
    function essence_get_global_essence()
    {
        global $essence;

        return $essence;
    }
}

if ( !function_exists( 'essence_get_some_vars' ) ) {

    function essence_get_some_vars()
    {
        global $essence, $force_grid_masonry;

        // Socials info 
        $essence[ 'opt_twitter_link' ] = isset( $essence[ 'opt_twitter_link' ] ) ? $essence[ 'opt_twitter_link' ] : '';
        $essence[ 'opt_fb_link' ] = isset( $essence[ 'opt_fb_link' ] ) ? $essence[ 'opt_fb_link' ] : '';
        $essence[ 'opt_google_plus_link' ] = isset( $essence[ 'opt_google_plus_link' ] ) ? $essence[ 'opt_google_plus_link' ] : '';
        $essence[ 'opt_dribbble_link' ] = isset( $essence[ 'opt_dribbble_link' ] ) ? $essence[ 'opt_dribbble_link' ] : '';
        $essence[ 'opt_behance_link' ] = isset( $essence[ 'opt_behance_link' ] ) ? $essence[ 'opt_behance_link' ] : '';
        $essence[ 'opt_tumblr_link' ] = isset( $essence[ 'opt_tumblr_link' ] ) ? $essence[ 'opt_tumblr_link' ] : '';
        $essence[ 'opt_instagram_link' ] = isset( $essence[ 'opt_instagram_link' ] ) ? $essence[ 'opt_instagram_link' ] : '';
        $essence[ 'opt_pinterest_link' ] = isset( $essence[ 'opt_pinterest_link' ] ) ? $essence[ 'opt_pinterest_link' ] : '';
        $essence[ 'opt_youtube_link' ] = isset( $essence[ 'opt_youtube_link' ] ) ? $essence[ 'opt_youtube_link' ] : '';
        $essence[ 'opt_vimeo_link' ] = isset( $essence[ 'opt_vimeo_link' ] ) ? $essence[ 'opt_vimeo_link' ] : '';
        $essence[ 'opt_linkedin_link' ] = isset( $essence[ 'opt_linkedin_link' ] ) ? $essence[ 'opt_linkedin_link' ] : '';
        $essence[ 'opt_rss_link' ] = isset( $essence[ 'opt_rss_link' ] ) ? $essence[ 'opt_rss_link' ] : '';

        if ( isset( $_GET[ 'sidebar' ] ) ) {
            if ( trim( $_GET[ 'sidebar' ] ) != '' ) {
                $essence[ 'opt_blog_sidebar_pos' ] = trim( $_GET[ 'sidebar' ] ); // Set blog sidebar
                $essence[ 'woo_shop_sidebar_pos' ] = trim( $_GET[ 'sidebar' ] ); // Set shop sidebar
            }
        }

        if ( isset( $_GET[ 'blog_layout' ] ) ) { // Set blog layout style (standard or default or grid)
            if ( trim( $_GET[ 'blog_layout' ] ) != '' ) {
                $essence[ 'opt_blog_layout_style' ] = trim( $_GET[ 'blog_layout' ] ); // Set blog sidebar
            }
        }

        if ( isset( $_GET[ 'single_sidebar' ] ) ) { // Set product single sidebar
            if ( trim( $_GET[ 'single_sidebar' ] ) != '' ) { // 0 or 1 (1: show single product sidebar)
                $essence[ 'opt_single_product_sidebar' ] = trim( $_GET[ 'single_sidebar' ] ); // Set single sidebar
            }
        }

        if ( isset( $_GET[ 'products_gman' ] ) ) { // Set products grid masonry
            if ( trim( $_GET[ 'products_gman' ] ) != '' ) { // 0 or 1 (1: enable shop grid masonry)
                $essence[ 'opt_enable_shop_grid_masonry' ] = trim( $_GET[ 'products_gman' ] );
            }
        }

        if ( isset( $_GET[ 'product_title' ] ) ) { // Product title always show or show on hover?
            if ( trim( $_GET[ 'product_title' ] ) != '' ) { // "always_show" or "show_on_hover"
                $essence[ 'opt_show_product_title_on_loop' ] = trim( $_GET[ 'product_title' ] );
            }
        }

        if ( isset( $_GET[ 'products_per_row' ] ) ) { // Products per row on shop
            if ( trim( $_GET[ 'products_per_row' ] ) != '' ) { // 2 --> 4
                $essence[ 'woo_products_per_row' ] = trim( $_GET[ 'products_per_row' ] );
            }
        }

        if ( isset( $_GET[ 'products_overlay' ] ) ) { // Products hover overlay
            if ( trim( $_GET[ 'products_overlay' ] ) != '' ) { // 1 or 0
                $essence[ 'opt_enable_product_overlay' ] = trim( $_GET[ 'products_overlay' ] );
            }
        }

        // Footer
        if ( isset( $_GET[ 'footer_layout' ] ) ) { // Set footer layout
            if ( in_array( trim( $_GET[ 'footer_layout' ] ), array( 'style-1', 'style-2', 'style-3', 'style-4' ) ) ) {
                $essence[ 'opt_footer_layout' ] = trim( $_GET[ 'footer_layout' ] );
            }
        }

    }

    add_action( 'init', 'essence_get_some_vars' );

}

if ( !function_exists( 'essence_get_header_setting' ) ) {
    function essence_get_header_setting()
    {
        global $essence;

        //$header_settings[ 'opt_show_title' ] = 'default'; // default: Show default title, custom: show custom title, disable: show none
        $header_settings[ 'opt_logo_url' ] = isset( $essence[ 'opt_general_logo' ][ 'url' ] ) ? $essence[ 'opt_general_logo' ][ 'url' ] : get_template_directory_uri() . '/assets/images/logo.png';
        $header_settings[ 'opt_title' ] = '';
        $header_settings[ 'opt_title_color' ] = '';
        $header_settings[ 'opt_menu' ] = '';
        $header_settings[ 'opt_menu_color' ] = '';
        $header_settings[ 'opt_menu_hover_color' ] = '';
        $header_settings[ 'opt_menu_bg_color' ] = '';
        $header_settings[ 'opt_top_header_bg_color' ] = '';
        $header_settings[ 'opt_show_breadcrumb' ] = 1; // 1, 0 (true, false)
        $header_settings[ 'opt_breadcrumb_color' ] = '';
        $header_settings[ 'opt_breadcrumb_hover_color' ] = '';
        $header_settings[ 'opt_breadcrumb_cur_page_color' ] = '';
        $header_settings[ 'opt_breadcrumb_sep_color' ] = '';
        $header_settings[ 'opt_header_type' ] = isset( $essence[ 'opt_header_type' ] ) ? $essence[ 'opt_header_type' ] : 'header-v1';
        $header_settings[ 'opt_header_slider' ] = isset( $essence[ 'opt_header_slider' ] ) ? $essence[ 'opt_header_slider' ] : '';
        $header_settings[ 'opt_header_img_url' ] = isset( $essence[ 'opt_header_img' ][ 'url' ] ) ? $essence[ 'opt_header_img' ][ 'url' ] : get_template_directory_uri() . '/assets/images/banner_default.jpg';
        $header_settings[ 'opt_enable_header_scroll_down' ] = isset( $essence[ 'opt_enable_header_scroll_down' ] ) ? $essence[ 'opt_enable_header_scroll_down' ] : 1;
        $header_settings[ 'opt_header_scroll_down_style' ] = isset( $essence[ 'opt_header_scroll_down_style' ] ) ? $essence[ 'opt_header_scroll_down_style' ] : 'style1';
        $header_settings[ 'opt_header_scroll_down_img_url' ] = isset( $essence[ 'opt_header_scroll_down_custom' ][ 'url' ] ) ? $essence[ 'opt_header_scroll_down_custom' ][ 'url' ] : '';

        $post_id = 0; // Post, page or post type... id

        if ( is_front_page() && is_home() ) {
            // Default homepage
            // Current version of theme does not support custom header for search results default home page, global setting will be used
        }
        elseif ( is_front_page() ) {
            // static homepage
            $post_id = get_option( 'page_on_front' );
        }
        elseif ( is_home() ) {
            // blog page
            $post_id = get_option( 'page_for_posts' );
        }
        else {
            // Everything else

            // Is a singular
            if ( is_singular() ) {
                $post_id = get_the_ID();
            }
            else {
                // Is archive or taxonomy
                if ( is_archive() ) {
                    // Current version of theme does not support custom header for archive, global setting will be used

                    // Checking for shop archive
                    if ( function_exists( 'is_shop' ) ) { // Products archive, products category, products search page...
                        if ( is_shop() ) {
                            $post_id = get_option( 'woocommerce_shop_page_id' );
                        }
                        if ( is_product_category() ) {
                            global $wp_query;
                            $cat = $wp_query->get_queried_object();
                            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                            $header_settings[ 'opt_header_img_url' ] = trim( wp_get_attachment_url( $thumbnail_id ) ) != '' ? esc_url( wp_get_attachment_url( $thumbnail_id ) ) : $header_settings[ 'opt_header_img_url' ];
                            $header_settings[ 'opt_title' ] = $cat->name;
                        }
                    }
                }
                else {
                    if ( is_404() ) {
                        // Current version of theme does not support custom header for 404 page, global setting will be used
                    }
                    else {
                        if ( is_search() ) {
                            // Current version of theme does not support custom header for search results page, global setting will be used
                        }
                        else {
                            // Is category, is tag, is tax
                            // Current version of theme does not support custom header for search results category, tag, tax.., global setting will be used
                        }
                    }
                }

            }
        }

        if ( $post_id > 0 ) {

            $use_custom_logo = get_post_meta( $post_id, 'essence_use_custom_logo', true ) == 'yes';
            if ( $use_custom_logo ) {
                $header_settings[ 'opt_logo_url' ] = get_post_meta( $post_id, 'essence_custom_logo', true );
            }

            $show_title = get_post_meta( $post_id, 'essence_show_title', true );
            if ( trim( $show_title ) == 'default' || trim( $show_title ) == '' ) {
                $header_settings[ 'opt_title' ] = get_the_title( $post_id );
            }
            if ( trim( $show_title ) == 'custom' ) {
                $header_settings[ 'opt_title' ] = get_post_meta( $post_id, 'essence_custom_title', true );
            }
            if ( trim( $show_title ) == 'disable' ) {
                $header_settings[ 'opt_title' ] = '';
            }

            $header_settings[ 'opt_title_color' ] = get_post_meta( $post_id, 'essence_title_color', true );

            $header_settings[ 'opt_menu' ] = get_post_meta( $post_id, 'essence_custom_menu', true );
            $header_settings[ 'opt_menu_color' ] = get_post_meta( $post_id, 'essence_menu_color', true );
            $header_settings[ 'opt_menu_hover_color' ] = get_post_meta( $post_id, 'essence_menu_hover_color', true );
            $header_settings[ 'opt_menu_bg_color' ] = get_post_meta( $post_id, 'essence_menu_bg_color', true );
            $header_settings[ 'opt_top_header_bg_color' ] = get_post_meta( $post_id, 'essence_top_header_bg_color', true );

            $header_settings[ 'opt_show_breadcrumb' ] = get_post_meta( $post_id, 'essence_show_breadcrumb', true ) != 'no';
            $header_settings[ 'opt_breadcrumb_color' ] = get_post_meta( $post_id, 'essence_breadcrumb_color', true );
            $header_settings[ 'opt_breadcrumb_hover_color' ] = get_post_meta( $post_id, 'essence_breadcrumb_hover_color', true );
            $header_settings[ 'opt_breadcrumb_cur_page_color' ] = get_post_meta( $post_id, 'essence_breadcrumb_cur_page_color', true );
            $header_settings[ 'opt_breadcrumb_sep_color' ] = get_post_meta( $post_id, 'essence_breadcrumb_sep_color', true );

            $use_custom_header = get_post_meta( $post_id, 'essence_use_custom_header', true ) == 'yes';

            if ( $use_custom_header ) {
                $header_type = get_post_meta( $post_id, 'essence_header_type', true );
                $header_settings[ 'opt_header_type' ] = trim( $header_type ) != '' ? $header_type : $header_settings[ 'opt_header_type' ];
                $header_slider = get_post_meta( $post_id, 'essence_section_revolution', true );
                $header_settings[ 'opt_header_slider' ] = $header_slider;
                $header_img = get_post_meta( $post_id, 'essence_custom_header_img', true );
                $header_settings[ 'opt_header_img_url' ] = $header_img;
                $scroll_down_style = get_post_meta( $post_id, 'essence_scroll_down_style', true );
                if ( $scroll_down_style == 'disable' ) {
                    $header_settings[ 'opt_enable_header_scroll_down' ] = 0;
                }
                if ( $scroll_down_style == 'custom' ) {
                    $scroll_down_custom_img = get_post_meta( $post_id, 'essence_custom_scroll_down_img', true );
                    $header_settings[ 'opt_header_scroll_down_img_url' ] = $scroll_down_custom_img;
                    $header_settings[ 'opt_enable_header_scroll_down' ] = 1;
                }
                if ( $scroll_down_style == 'global' ) {
                    switch ( $header_settings[ 'opt_header_scroll_down_style' ] ) {
                        case 'style1':
                            $header_settings[ 'opt_header_scroll_down_img_url' ] = plugins_url( '/essence-core' ) . '/assets/images/scroll_down_1.png';
                            break;
                        case 'style2':
                            $header_settings[ 'opt_header_scroll_down_img_url' ] = plugins_url( '/essence-core' ) . '/assets/images/scroll_down_2.png';
                            break;
                        case 'style3':
                            $header_settings[ 'opt_header_scroll_down_img_url' ] = plugins_url( '/essence-core' ) . '/assets/images/scroll_down_3.png';
                            break;
                        case 'custom':
                            // Do nothing
                            break;
                    }
                }
            }

        }

        return $header_settings;

    }
}

if ( !function_exists( 'essence_get_current_post_id' ) ) {
    function essence_get_current_post_id()
    {
        $post_id = 0; // Post, page or post type... id

        if ( is_front_page() && is_home() ) {
            // Default homepage
        }
        elseif ( is_front_page() ) {
            // static homepage
            $post_id = get_option( 'page_on_front' );
        }
        elseif ( is_home() ) {
            // blog page
            $post_id = get_option( 'page_for_posts' );
        }
        else {
            // Everything else

            // Is a singular
            if ( is_singular() ) {
                $post_id = get_the_ID();
            }
            else {
                // Is archive or taxonomy
                if ( is_archive() ) {

                }
                else {
                    if ( is_404() ) {

                    }
                    else {
                        if ( is_search() ) {

                        }
                        else {
                            // Is category, is tag, is tax
                        }
                    }
                }

            }
        }

        return $post_id;
    }
}

if ( !function_exists( 'essence_breadcrumb' ) ) {
    function essence_breadcrumb( $setting = array() )
    {
        if ( !function_exists( 'breadcrumb_trail' ) ) {
            return;
        }

        $defaults_setting = array(
            'container' => 'nav', 'before' => '', 'after' => '', 'show_on_front' => true, 'network' => false, 'show_title' => true, 'show_browse' => true, 'echo' => true, 'post_taxonomy' => array(), 'labels' => array(
                'browse'              => '', 'aria_label' => esc_attr_x( 'Breadcrumbs', 'breadcrumbs aria label', 'essence' ), 'home' => esc_html__( 'Home', 'essence' ), 'error_404' => esc_html__( '404 Not Found', 'essence' ), 'archives' => esc_html__( 'Archives', 'essence' ), // Translators: %s is the search query. The HTML entities are opening and closing curly quotes.
                'search'              => esc_html__( 'Search results for &#8220;%s&#8221;', 'essence' ), // Translators: %s is the page number.
                'paged'               => esc_html__( 'Page %s', 'essence' ), // Translators: Minute archive title. %s is the minute time format.
                'archive_minute'      => esc_html__( 'Minute %s', 'essence' ), // Translators: Weekly archive title. %s is the week date format.
                'archive_week'        => esc_html__( 'Week %s', 'essence' ),

                // "%s" is replaced with the translated date/time format.
                'archive_minute_hour' => '%s', 'archive_hour' => '%s', 'archive_day' => '%s', 'archive_month' => '%s', 'archive_year' => '%s',
            ),
        );

        $setting = wp_parse_args( $setting, $defaults_setting );
        breadcrumb_trail( $setting );
    }
}


if ( !function_exists( 'essence_body_classes' ) ) {
    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     *
     * @return array
     */
    function essence_body_classes( $classes )
    {
        // Adds a class essence-body
        if ( is_multi_author() ) {
            $classes[] = ' essence-body';
        }

        return $classes;
    }

    add_filter( 'body_class', 'essence_body_classes' );
}


if ( !function_exists( 'essence_favicon' ) ) {

    /**
     * Custom favicon
     **/
    function essence_favicon()
    {
        global $essence;

        if ( !function_exists( 'has_site_icon' ) || !has_site_icon() ) {
            $favicon = isset( $essence[ 'opt_general_favicon' ][ 'url' ] ) ? $essence[ 'opt_general_favicon' ][ 'url' ] : get_template_directory_uri() . '/assets/images/favicon.png';
            if ( trim( $favicon ) != '' ) {
                echo '<link rel="shortcut icon" href="' . esc_url( $favicon ) . '" />', "\n";
            }
        }
    }

    add_action( 'wp_head', 'essence_favicon', 2 );

}


if ( !function_exists( 'essence_custom_js' ) ) {

    /**
     * Custom js
     **/
    function essence_custom_js()
    {
        global $essence;

        $script = '';
        if ( isset( $essence[ 'opt_general_js_code' ] ) ) {
            $script .= stripslashes( $essence[ 'opt_general_js_code' ] );
        }

        echo '<script type="text/javascript" class="custom-js">
                jQuery(document).ready(function($){
                    ' . stripslashes( $script ) . '
                });
            </script>';
    }

    add_action( 'wp_head', 'essence_custom_js' );

}

if ( !function_exists( 'essence_get_the_excerpt_max_charlength' ) ) {

    function essence_get_the_excerpt_max_charlength( $charlength )
    {
        $excerpt = get_the_excerpt();
        $charlength++;

        if ( mb_strlen( $excerpt ) <= $charlength ) {
            $excerpt = strip_tags( get_the_content() );
        }

        if ( mb_strlen( $excerpt ) > $charlength ) {
            $subex = mb_substr( $excerpt, 0, $charlength - 5 );
            $exwords = explode( ' ', $subex );
            $excut = -( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
            if ( $excut < 0 ) {
                $subex = mb_substr( $subex, 0, $excut );
            }
            $subex .= '...';
            $excerpt = $subex;
        }

        return $excerpt;
    }

}

if ( !function_exists( 'essence_get_the_excerpt_max_words_length' ) ) {

    function essence_get_the_excerpt_max_words_length( $words_length )
    {
        $excerpt = get_the_excerpt();

        if ( str_word_count( $excerpt ) <= $words_length ) {
            $excerpt = strip_tags( get_the_content() );
        }

        $excerpt = wp_trim_words( $excerpt, $words_length, '...' );

        return $excerpt;
    }

}

if ( !function_exists( 'essence_main_container_class' ) ) {
    function essence_main_container_class()
    {
        global $essence;

        $header_settings = essence_get_header_setting();

        $class = 'main-container';

        if ( trim( $header_settings[ 'opt_header_slider' ] ) != '' && trim( $header_settings[ 'opt_header_img_url' ] ) != '' ) {
            $class .= ' no-header-banner';
        }

        if ( is_front_page() && is_home() ) {
            // Default homepage

        }
        elseif ( is_front_page() ) {
            // static homepage

        }
        elseif ( is_home() ) {
            // blog page
            $class .= ' page-blog';

        }
        else {
            //everything else

            // Is a singular
            if ( is_singular() ) {
                if ( is_singular( 'post' ) ) {
                    $class .= ' page-blog page-blog-single';
                }
            }
            else {
                // Is archive or taxonomy
                if ( is_archive() ) {
                    $title = post_type_archive_title( '', false );

                    // Checking for shop archive
                    if ( function_exists( 'is_shop' ) ) { // Products archive, products category, products search page...
                        if ( is_shop() ) {
                            $sidebar_pos = isset( $essence[ 'woo_shop_sidebar_pos' ] ) ? trim( $essence[ 'woo_shop_sidebar_pos' ] ) : 'right';
                            $enable_single_product_sidebar = isset( $essence[ 'opt_single_product_sidebar' ] ) ? $essence[ 'opt_single_product_sidebar' ] == '1' : false;

                            $sidebar_pos = is_product() && !$enable_single_product_sidebar ? 'fullwidth' : $sidebar_pos;

                            if ( $sidebar_pos == 'fullwidth' ) {
                                $class .= ' page-shop-no-sidebar';
                                if ( is_product() ) {
                                    $class .= ' page-single-product';
                                }
                            }
                            else {
                                $class .= ' page-shop-sidebar' . esc_attr( $sidebar_pos );
                            }
                        }
                    }
                }
                else {
                    if ( is_search() ) {
                        $class .= ' page-search-results';
                    }
                }

                // Is WooCommerce page
                if ( function_exists( 'is_woocommerce' ) ) {
                    if ( is_woocommerce() ) {

                    }
                }

            }
        }

        return esc_attr( $class );
    }
}

if ( !function_exists( 'essence_primary_class' ) ) {

    /**
     * Add class to #primary
     *
     * @return string
     **/
    function essence_primary_class( $class = '' )
    {
        global $essence;

        $sidebar_pos = isset( $essence[ 'opt_blog_sidebar_pos' ] ) ? trim( $essence[ 'opt_blog_sidebar_pos' ] ) : 'right';

        if ( $sidebar_pos == 'fullwidth' ) {
            $class .= ' col-xs-12 no-sidebar';
        }
        else {
            $class .= ' col-xs-12 col-sm-8 col-md-9 has-sidebar-' . esc_attr( $sidebar_pos );
        }

        return esc_attr( $class );

    }

}

if ( !function_exists( 'essence_secondary_class' ) ) {

    /**
     * Add class to #secondary
     *
     * @return string
     **/
    function essence_secondary_class( $class = '' )
    {
        global $essence;

        $sidebar_pos = isset( $essence[ 'opt_blog_sidebar_pos' ] ) ? trim( $essence[ 'opt_blog_sidebar_pos' ] ) : 'right';

        if ( $sidebar_pos == 'fullwidth' ) {
            $class .= ' col-xs-12 content-area-fullwidth';
        }
        else {
            $class .= ' col-xs-12 col-sm-4 col-md-3 sidebar sidebar-' . esc_attr( $sidebar_pos );
        }

        return esc_attr( $class );

    }

}

if ( !function_exists( 'essence_shop_primary_class' ) ) {

    /**
     * Add class to #primary
     *
     * @return string
     **/
    function essence_shop_primary_class( $class = '' )
    {
        global $essence;

        $sidebar_pos = isset( $essence[ 'woo_shop_sidebar_pos' ] ) ? trim( $essence[ 'woo_shop_sidebar_pos' ] ) : 'right';
        $enable_single_product_sidebar = isset( $essence[ 'opt_single_product_sidebar' ] ) ? $essence[ 'opt_single_product_sidebar' ] == '1' : false;

        $sidebar_pos = is_product() && !$enable_single_product_sidebar ? 'fullwidth' : $sidebar_pos;

        if ( $sidebar_pos == 'fullwidth' ) {
            $class .= ' col-xs-12 no-sidebar';
        }
        else {
            $class .= 'col-xs-12 col-sm-8 col-md-9 has-sidebar-' . esc_attr( $sidebar_pos );
        }

        return esc_attr( $class );

    }

}

if ( !function_exists( 'essence_shop_secondary_class' ) ) {

    /**
     * Add class to #secondary
     *
     * @return string
     **/
    function essence_shop_secondary_class( $class = '' )
    {
        global $essence;

        $sidebar_pos = isset( $essence[ 'woo_shop_sidebar_pos' ] ) ? trim( $essence[ 'woo_shop_sidebar_pos' ] ) : 'right';
        $enable_single_product_sidebar = isset( $essence[ 'opt_single_product_sidebar' ] ) ? $essence[ 'opt_single_product_sidebar' ] == '1' : false;

        $sidebar_pos = is_product() && !$enable_single_product_sidebar ? 'fullwidth' : $sidebar_pos;

        if ( $sidebar_pos == 'fullwidth' ) {
            $class .= ' col-xs-12';
        }
        else {
            $class .= ' col-xs-12 col-sm-4 col-md-3 sidebar sidebar-' . esc_attr( $sidebar_pos );
        }

        return esc_attr( $class );

    }

}

if ( !function_exists( 'essence_get_blog_sidebar_pos' ) ) {
    function essence_get_blog_sidebar_pos()
    {
        global $essence;
        $sidebar_pos = isset( $essence[ 'opt_blog_sidebar_pos' ] ) ? trim( $essence[ 'opt_blog_sidebar_pos' ] ) : 'right';

        return $sidebar_pos;
    }
}

if ( !function_exists( 'essence_search_form' ) ) {

    /*
     * Filter Search form
    */
    function essence_search_form( $form )
    {
        global $essence;

        $placeholder = isset( $essence[ 'opt_search_placeholder' ] ) ? $essence[ 'opt_search_placeholder' ] : esc_html__( 'Search place holder', 'essence' );

        $key = get_search_query();

        $form = '<form class="ts-search-form search-form" method="get" action="' . esc_url( home_url( '/' ) ) . '" >
                  <input type="search" value="' . esc_attr( $key ) . '" placeholder="' . sanitize_text_field( $placeholder ) . '" class="search" name="s">
                  <span><button type="submit" class="search-submit"><i class="icon icon-arrows-slide-right2"></i></button></span>
                </form>';

        return $form;
    }

    add_filter( 'get_search_form', 'essence_search_form' );

}

if ( !function_exists( 'essence_get_site_layout' ) ) {
    function essence_get_site_layout()
    {
        $post_id = 0;
        if ( $post_id == 0 ) {
            if ( is_singular() ) {
                $post_id = get_the_ID();
            }
        }
        if ( essence_is_blog() ) {
            $post_id = get_option( 'page_for_posts' );
        }

        $e_layout_site = get_post_meta( $post_id, 'opt-layout-type', true );
        if ( trim( $e_layout_site ) != '' ) {
            $e_layout_site = get_post_meta( $post_id, 'opt-layout-type', true );;
        }
        else {
            $e_layout_site = 'ts-page-default';
        }

        return $e_layout_site;
    }
}

if ( !function_exists( 'essence_search_filter' ) ) {

    /*
     * Filter Search form
    */
    function essence_search_filter( $query )
    {
        global $essence;
        $display_search_result_for = isset( $essence[ 'opt_display_search_result_for' ] ) ? (array) $essence[ 'opt_display_search_result_for' ] : array( 'post' );

        if ( $query->is_search && !is_admin() ) {
            $query->set( 'post_type', $display_search_result_for );
        }

        return $query;
    }

    add_filter( 'pre_get_posts', 'essence_search_filter' );

}


if ( !function_exists( 'essence_wp_title' ) ) {

    /*
     * WP title
    */
    function essence_wp_title( $title, $separator )
    {
        global $essence;

        if ( is_feed() ) {
            return $title;
        }

        $is_coming_soon_mode = isset( $essence[ 'opt_enable_coming_soon_mode' ] ) ? $essence[ 'opt_enable_coming_soon_mode' ] == '1' : false;

        if ( !current_user_can( 'administrator' ) && $is_coming_soon_mode ) {
            $title = isset( $essence[ 'opt_coming_soon_site_title' ] ) ? $essence[ 'opt_coming_soon_site_title' ] : $title;
        }
        else {
            return $title;
        }

        return $title;
    }

    add_filter( 'wp_title', 'essence_wp_title', 10, 2 );

}

if ( !function_exists( 'essence_coming_soon_redirect' ) ) {
    function essence_coming_soon_redirect()
    {
        global $essence;

        $is_coming_soon_mode = isset( $essence[ 'opt_enable_coming_soon_mode' ] ) ? $essence[ 'opt_enable_coming_soon_mode' ] == '1' : false;
        $disable_if_date_smaller_than_current = isset( $essence[ 'opt_disable_coming_soon_when_date_small' ] ) ? $essence[ 'opt_disable_coming_soon_when_date_small' ] == '1' : false;
        $coming_date = isset( $essence[ 'opt_coming_soon_date' ] ) ? $essence[ 'opt_coming_soon_date' ] : '';

        $today = date( 'm/d/Y' );

        if ( trim( $coming_date ) == '' || strtotime( $coming_date ) <= strtotime( $today ) ) {
            if ( $disable_if_date_smaller_than_current ) {
                $is_coming_soon_mode = false;
            }
        }

        // Dont't show coming soon page if is user logged in or is not coming soon mode on
        if ( is_user_logged_in() || !$is_coming_soon_mode ) {
            return;
        }

        essence_coming_soon_html(); // Locate in theme_coming_soon_template.php

        exit();
    }

    add_action( 'template_redirect', 'essence_coming_soon_redirect' );
}

if ( !function_exists( 'essence_coming_soon_mode_admin_toolbar' ) ) {
    // Add Toolbar Menus
    function essence_coming_soon_mode_admin_toolbar()
    {
        global $wp_admin_bar, $essence;

        $is_coming_soon_mode = isset( $essence[ 'opt_enable_coming_soon_mode' ] ) ? $essence[ 'opt_enable_coming_soon_mode' ] == '1' : false;
        $disable_if_date_smaller_than_current = isset( $essence[ 'opt_disable_coming_soon_when_date_small' ] ) ? $essence[ 'opt_disable_coming_soon_when_date_small' ] == '1' : false;
        $coming_date = isset( $essence[ 'opt_coming_soon_date' ] ) ? $essence[ 'opt_coming_soon_date' ] : '';

        $today = date( 'm/d/Y' );

        if ( trim( $coming_date ) == '' || strtotime( $coming_date ) <= strtotime( $today ) ) {
            if ( $disable_if_date_smaller_than_current && $is_coming_soon_mode ) {
                $is_coming_soon_mode = false;
                $menu_item_class = 'essence_coming_soon_expired';
                if ( current_user_can( 'administrator' ) ) { // Coming soon expired

                    $date = isset( $essence[ 'opt_coming_soon_date' ] ) ? $essence[ 'opt_coming_soon_date' ] : date();

                    $args = array( 'id' => 'essence_coming_soon', 'parent' => 'top-secondary', 'title' => esc_html__( 'Coming Soon Mode Expired', 'essence' ), 'href' => esc_url( admin_url( 'themes.php?page=essence_options' ) ), 'meta' => array( 'class' => 'essence_coming_soon_expired', 'title' => esc_html__( 'Coming soon mode is actived but expired', 'essence' ), ), );
                    $wp_admin_bar->add_menu( $args );
                }
            }
        }

        if ( current_user_can( 'administrator' ) && $is_coming_soon_mode ) {

            $date = isset( $essence[ 'opt_coming_soon_date' ] ) ? $essence[ 'opt_coming_soon_date' ] : date();

            $args = array( 'id' => 'essence_coming_soon', 'parent' => 'top-secondary', 'title' => esc_html__( 'Coming Soon Mode', 'essence' ), 'href' => esc_url( admin_url( 'themes.php?page=essence_options' ) ), 'meta' => array( 'class' => 'essence_coming_soon essence-countdown-wrap countdown-admin-menu essence-cms-date_' . esc_attr( $date ), 'title' => esc_html__( 'Coming soon mode is actived', 'essence' ), ), );
            $wp_admin_bar->add_menu( $args );
        }

    }

    add_action( 'wp_before_admin_bar_render', 'essence_coming_soon_mode_admin_toolbar', 999 );
}

if ( !function_exists( 'essence_no_image' ) ) {

    /**
     * No image generator
     *
     * @since 1.0
     *
     * @param $size : array, image size
     * @param $echo : bool, echo or return no image url
     **/
    function essence_no_image( $size = array( 'width' => 500, 'height' => 500 ), $echo = false, $transparent = false )
    {

        $noimage_dir = get_template_directory();
        $noimage_uri = get_template_directory_uri();

        $suffix = ( $transparent ) ? '_transparent' : '';

        if ( !is_array( $size ) || empty( $size ) ):
            $size = array( 'width' => 500, 'height' => 500 );
        endif;

        if ( !is_numeric( $size[ 'width' ] ) && $size[ 'width' ] == '' || $size[ 'width' ] == null ):
            $size[ 'width' ] = 'auto';
        endif;

        if ( !is_numeric( $size[ 'height' ] ) && $size[ 'height' ] == '' || $size[ 'height' ] == null ):
            $size[ 'height' ] = 'auto';
        endif;

        // base image must be exist
        $img_base_fullpath = $noimage_dir . '/assets/images/noimage/no_image' . $suffix . '.png';
        $no_image_src = $noimage_uri . '/assets/images/noimage/no_image' . $suffix . '.png';


        // Check no image exist or not
        if ( !file_exists( $noimage_dir . '/assets/images/noimage/no_image' . $suffix . '-' . $size[ 'width' ] . 'x' . $size[ 'height' ] . '.png' ) ):

            $no_image = wp_get_image_editor( $img_base_fullpath );

            if ( !is_wp_error( $no_image ) ):
                $no_image->resize( $size[ 'width' ], $size[ 'height' ], true );
                $no_image_name = $no_image->generate_filename( $size[ 'width' ] . 'x' . $size[ 'height' ], $noimage_dir . '/assets/images/noimage/', null );
                $no_image->save( $no_image_name );
            endif;

        endif;

        // Check no image exist after resize
        $noimage_path_exist_after_resize = $noimage_dir . '/assets/images/noimage/no_image' . $suffix . '-' . $size[ 'width' ] . 'x' . $size[ 'height' ] . '.png';

        if ( file_exists( $noimage_path_exist_after_resize ) ):
            $no_image_src = $noimage_uri . '/assets/images/noimage/no_image' . $suffix . '-' . $size[ 'width' ] . 'x' . $size[ 'height' ] . '.png';
        endif;

        if ( $echo ):
            echo esc_url( $no_image_src );
        else:
            return esc_url( $no_image_src );
        endif;

    }
}

if ( !function_exists( 'essence_resize_image' ) ) {
    /**
     * @param int    $attach_id
     * @param string $img_url
     * @param int    $width
     * @param int    $height
     * @param bool   $crop
     * @param bool   $place_hold        Using place hold image if the image does not exist
     * @param bool   $use_real_img_hold Using real image for holder if the image does not exist
     * @param string $solid_img_color   Solid placehold image color (not text color). Random color if null
     *
     * @since 1.0
     * @return array
     */
    function essence_resize_image(
        $attach_id = null, $img_url = null, $width, $height, $crop = false,
        $place_hold = true, $use_real_img_hold = true, $solid_img_color = null
    ) {

        // If is singular and has post thumbnail and $attach_id is null, so we get post thumbnail id automatic
        if ( is_singular() && !$attach_id && !$img_url ) {
            if ( has_post_thumbnail() && !post_password_required() ) {
                $attach_id = get_post_thumbnail_id();
            }
        }

        // this is an attachment, so we have the ID
        $image_src = array();
        if ( $attach_id ) {
            $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
            $actual_file_path = get_attached_file( $attach_id );
            // this is not an attachment, let's use the image url
        }
        else {
            if ( $img_url ) {
                $file_path = str_replace( get_site_url(), ABSPATH, $img_url );
                $actual_file_path = rtrim( $file_path, '/' );
                if ( !file_exists( $actual_file_path ) ) {
                    $file_path = parse_url( $img_url );
                    $actual_file_path = rtrim( ABSPATH, '/' ) . $file_path[ 'path' ];
                }
                if ( file_exists( $actual_file_path ) ) {
                    $orig_size = getimagesize( $actual_file_path );
                    $image_src[ 0 ] = $img_url;
                    $image_src[ 1 ] = $orig_size[ 0 ];
                    $image_src[ 2 ] = $orig_size[ 1 ];
                }
                else {
                    $image_src[ 0 ] = '';
                    $image_src[ 1 ] = 0;
                    $image_src[ 2 ] = 0;
                }
            }
        }
        if ( !empty( $actual_file_path ) && file_exists( $actual_file_path ) ) {
            $file_info = pathinfo( $actual_file_path );
            $extension = '.' . $file_info[ 'extension' ];

            // the image path without the extension
            $no_ext_path = $file_info[ 'dirname' ] . '/' . $file_info[ 'filename' ];

            $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

            // checking if the file size is larger than the target size
            // if it is smaller or the same size, stop right here and return
            if ( $image_src[ 1 ] > $width || $image_src[ 2 ] > $height ) {

                // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
                if ( file_exists( $cropped_img_path ) ) {
                    $cropped_img_url = str_replace( basename( $image_src[ 0 ] ), basename( $cropped_img_path ), $image_src[ 0 ] );
                    $vt_image = array( 'url' => $cropped_img_url, 'width' => $width, 'height' => $height, );

                    return $vt_image;
                }

                // $crop = false
                if ( $crop == false ) {
                    // calculate the size proportionaly
                    $proportional_size = wp_constrain_dimensions( $image_src[ 1 ], $image_src[ 2 ], $width, $height );
                    $resized_img_path = $no_ext_path . '-' . $proportional_size[ 0 ] . 'x' . $proportional_size[ 1 ] . $extension;

                    // checking if the file already exists
                    if ( file_exists( $resized_img_path ) ) {
                        $resized_img_url = str_replace( basename( $image_src[ 0 ] ), basename( $resized_img_path ), $image_src[ 0 ] );

                        $vt_image = array( 'url' => $resized_img_url, 'width' => $proportional_size[ 0 ], 'height' => $proportional_size[ 1 ], );

                        return $vt_image;
                    }
                }

                // no cache files - let's finally resize it
                $img_editor = wp_get_image_editor( $actual_file_path );

                if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
                    return array( 'url' => '', 'width' => '', 'height' => '', );
                }

                $new_img_path = $img_editor->generate_filename();

                if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
                    return array( 'url' => '', 'width' => '', 'height' => '', );
                }
                if ( !is_string( $new_img_path ) ) {
                    return array( 'url' => '', 'width' => '', 'height' => '', );
                }

                $new_img_size = getimagesize( $new_img_path );
                $new_img = str_replace( basename( $image_src[ 0 ] ), basename( $new_img_path ), $image_src[ 0 ] );

                // resized output
                $vt_image = array( 'url' => $new_img, 'width' => $new_img_size[ 0 ], 'height' => $new_img_size[ 1 ], );

                return $vt_image;
            }

            // default output - without resizing
            $vt_image = array( 'url' => $image_src[ 0 ], 'width' => $image_src[ 1 ], 'height' => $image_src[ 2 ], );

            return $vt_image;
        }
        else {
            if ( $place_hold ) {
                $width = intval( $width );
                $height = intval( $height );

                // Real image place hold (https://unsplash.it/)
                if ( $use_real_img_hold ) {
                    $random_time = time() + rand( 1, 100000 );
                    $vt_image = array( 'url' => 'https://unsplash.it/' . $width . '/' . $height . '?random&time=' . $random_time, 'width' => $width, 'height' => $height, );
                }
                else {
                    $color = $solid_img_color;
                    if ( is_null( $color ) || trim( $color ) == '' ) {

                        // Show no image (gray)
                        $vt_image = array( 'url' => essence_no_image( array( 'width' => $width, 'height' => $height ) ), 'width' => $width, 'height' => $height, );
                    }
                    else {
                        if ( $color == 'transparent' ) { // Show no image transparent
                            $vt_image = array( 'url' => essence_no_image( array( 'width' => $width, 'height' => $height ), false, true ), 'width' => $width, 'height' => $height, );
                        }
                        else { // No image with color from placehold.it
                            $vt_image = array( 'url' => 'http://placehold.it/' . $width . 'x' . $height . '/' . $color . '/ffffff/', 'width' => $width, 'height' => $height, );
                        }
                    }
                }

                return $vt_image;
            }
        }

        return false;
    }
}

if ( !function_exists( 'essence_rev_slide_options_for_redux' ) ) {
    function essence_rev_slide_options_for_redux()
    {
        global $wpdb;
        $essence_herosection_revolutions = array( '' => esc_html__( 'No Revolution Slider', 'essence-core' ) );
        if ( class_exists( 'RevSlider' ) ) {
            global $wpdb;
            if ( shortcode_exists( 'rev_slider' ) ) {
                $rev_sql = $wpdb->prepare(
                    "SELECT *
                    FROM {$wpdb->prefix}revslider_sliders
                    WHERE %d", 1
                );
                $rev_rows = $wpdb->get_results( $rev_sql );
                if ( count( $rev_rows ) > 0 ) {
                    foreach ( $rev_rows as $rev_row ):
                        $essence_herosection_revolutions[ $rev_row->alias ] = $rev_row->title;
                    endforeach;
                }
            }
        }

        return $essence_herosection_revolutions;
    }
}


if ( !function_exists( 'essence_color_hex2rgba' ) ) {
    function essence_color_hex2rgba( $hex, $alpha = 1 )
    {
        $hex = str_replace( "#", "", $hex );

        if ( strlen( $hex ) == 3 ) {
            $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
            $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
            $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
        }
        else {
            $r = hexdec( substr( $hex, 0, 2 ) );
            $g = hexdec( substr( $hex, 2, 2 ) );
            $b = hexdec( substr( $hex, 4, 2 ) );
        }
        $rgb = array( $r, $g, $b );

        return 'rgba( ' . implode( ', ', $rgb ) . ', ' . $alpha . ' )'; // returns the rgb values separated by commas
    }
}

if ( !function_exists( 'essence_color_rgb2hex' ) ) {
    function essence_color_rgb2hex( $rgb )
    {
        $hex = '#';
        $hex .= str_pad( dechex( $rgb[ 0 ] ), 2, '0', STR_PAD_LEFT );
        $hex .= str_pad( dechex( $rgb[ 1 ] ), 2, '0', STR_PAD_LEFT );
        $hex .= str_pad( dechex( $rgb[ 2 ] ), 2, '0', STR_PAD_LEFT );

        return $hex; // returns the hex value including the number sign (#)
    }
}

/** FUNCTIONS FOR AJAX ======================================= **/


/**
 * Do login via ajax
 **/
function essence_do_login_via_ajax()
{
    global $current_user;

    $response = array( 'html' => '', 'is_logged_in' => is_user_logged_in() ? 'yes' : 'no', 'message' => '', );

    if ( $response[ 'is_logged_in' ] == 'yes' ) {
        $response[ 'message' ] = '<p class="text-primary bg-primary login-message">' . esc_html__( 'You are logged in!', 'essence' ) . '</p>';
        wp_send_json( $response );
        die();
    }

    $user_login = isset( $_POST[ 'user_login' ] ) ? $_POST[ 'user_login' ] : '';
    $user_pass = isset( $_POST[ 'user_pass' ] ) ? $_POST[ 'user_pass' ] : '';
    $rememberme = isset( $_POST[ 'rememberme' ] ) ? $_POST[ 'rememberme' ] == 'yes' : false;
    $login_nonce = isset( $_POST[ 'login_nonce' ] ) ? $_POST[ 'login_nonce' ] : '';

    if ( !wp_verify_nonce( $login_nonce, 'ajax-login-nonce' ) ) {
        $response[ 'message' ] = '<p class="text-danger bg-danger login-message">' . esc_html__( 'Security check error!', 'essence' ) . '</p>';
        wp_send_json( $response );
        die();
    }

    if ( trim( $user_login ) == '' ) {
        $response[ 'message' ] = '<p class="text-danger bg-danger login-message">' . esc_html__( 'User name can not be empty!', 'essence' ) . '</p>';
        wp_send_json( $response );
        die();
    }

    $info = array();
    $info[ 'user_login' ] = $user_login;
    $info[ 'user_password' ] = $user_pass;
    $info[ 'remember' ] = $rememberme;

    $user_signon = wp_signon( $info, false );

    if ( is_wp_error( $user_signon ) ) {
        $response[ 'message' ] = '<p class="text-danger bg-danger login-message">' . esc_html__( 'Wrong username or password.', 'essence' ) . '</p>';
    }
    else {
        $response[ 'is_logged_in' ] = 'yes';
        $response[ 'message' ] = '<p class="text-success bg-success login-message">' . esc_html__( 'Logged in successfully', 'essence' ) . '</p>';
        $response[ 'html' ] = '<h3>' . esc_html__( 'Welcome', 'essence' ) . '</h3>
                            <p>' . sprintf( esc_html__( 'Hello %s!', 'essence' ), $current_user->display_name ) . '</p>';
    }

    wp_send_json( $response );

    die();
}

add_action( 'wp_ajax_nopriv_essence_do_login_via_ajax', 'essence_do_login_via_ajax' );
add_action( 'wp_ajax_essence_do_login_via_ajax', 'essence_do_login_via_ajax' );

function essence_do_register_via_ajax()
{

    $response = array( 'html' => '', 'register_ok' => 'no', 'message' => '', );

    $username = isset( $_POST[ 'username' ] ) ? $_POST[ 'username' ] : '';
    $email = isset( $_POST[ 'email' ] ) ? $_POST[ 'email' ] : '';
    $password = isset( $_POST[ 'password' ] ) ? $_POST[ 'password' ] : '';
    $repassword = isset( $_POST[ 'repassword' ] ) ? $_POST[ 'repassword' ] : '';
    $agree = isset( $_POST[ 'agree' ] ) ? $_POST[ 'agree' ] : 'no';
    $register_nonce = isset( $_POST[ 'register_nonce' ] ) ? $_POST[ 'register_nonce' ] : '';

    if ( !wp_verify_nonce( $register_nonce, 'ajax-register-nonce' ) ) {
        $response[ 'message' ] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'Security check error!', 'essence' ) . '</p>';
        wp_send_json( $response );
        die();
    }

    if ( trim( $username ) == '' ) {
        $response[ 'message' ] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'User name can not be empty!', 'essence' ) . '</p>';
        wp_send_json( $response );
        die();
    }

    if ( !is_email( $email ) ) {
        $response[ 'message' ] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'The Email Address is in an invalid format!', 'essence' ) . '</p>';
        wp_send_json( $response );
        die();
    }

    if ( trim( $password ) == '' ) {
        $response[ 'message' ] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'Please enter a password!', 'essence' ) . '</p>';
        wp_send_json( $response );
        die();
    }

    if ( trim( $password ) != trim( $repassword ) ) {
        $response[ 'message' ] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'Passwords did not match. Please try again!', 'essence' ) . '</p>';
        wp_send_json( $response );
        die();
    }

    if ( trim( $agree ) != 'yes' ) {
        $response[ 'message' ] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'You must agree to our terms of use!', 'essence' ) . '</p>';
        wp_send_json( $response );
        die();
    }

    $user_id = username_exists( $username );

    if ( !$user_id and email_exists( $email ) == false ) {
        $user_id = wp_create_user( $username, $password, $email );
        if ( !is_wp_error( $user_id ) ) {
            $response[ 'register_ok' ] = 'yes';
            $response[ 'message' ] = '<p class="text-success bg-success register-message">' . esc_html__( 'Thank you! Registered successfully, now you can login.', 'essence' ) . '</p>';
        }
        else {
            $response[ 'message' ] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'Registration failed. Please try again latter!', 'essence' ) . '</p>';
        }
    }
    else {
        $response[ 'message' ] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'User already exists.', 'essence' ) . '</p>';
    }

    wp_send_json( $response );

    die();
}

add_action( 'wp_ajax_nopriv_essence_do_register_via_ajax', 'essence_do_register_via_ajax' );


if ( !function_exists( 'essence_loadmore_masonry_via_ajax' ) ) {

    function essence_loadmore_masonry_via_ajax()
    {
        global $essence;

        $load_more_text = isset( $essence[ 'opt_blog_masonry_loadmore_text' ] ) ? $essence[ 'opt_blog_masonry_loadmore_text' ] : esc_html__( 'Load more', 'essence' );
        $no_more_text = isset( $essence[ 'opt_blog_masonry_nomore_text' ] ) ? $essence[ 'opt_blog_masonry_nomore_text' ] : esc_html__( 'No more post', 'essence' );

        $response = array( 'items' => array(), 'message' => '', 'load_more_text' => $load_more_text, 'nomore_post' => 'no', );

        $post__not_in = isset( $_POST[ 'except_post_ids' ] ) ? $_POST[ 'except_post_ids' ] : array( 0 );
        $sidebar_pos = isset( $_POST[ 'sidebar_pos' ] ) ? $_POST[ 'sidebar_pos' ] : 'right';
        $essence[ 'opt_blog_sidebar_pos' ] = $sidebar_pos;

        if ( !is_array( $post__not_in ) ) {
            $post__not_in = array( 0 );
        }

        $showposts = isset( $essence[ 'opt_blog_masonry_loadmore_number' ] ) ? max( 1, intval( $essence[ 'opt_blog_masonry_loadmore_number' ] ) ) : 6;

        $args = array( 'showposts' => $showposts, 'post_status' => array( 'publish' ), 'paged' => 1, 'post__not_in' => $post__not_in, );

        $query_posts = new WP_Query( $args );
        $i = 0;

        if ( $query_posts->have_posts() ):

            while ( $query_posts->have_posts() ) : $query_posts->the_post();
                $i++;
                ob_start();

                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_format() );
                $response[ 'items' ][] = ob_get_clean();

            endwhile;

        endif;
        wp_reset_postdata();

        if ( $i < $showposts ) { // Not really correct
            $response[ 'load_more_text' ] = $no_more_text;
            $response[ 'nomore_post' ] = 'yes';
        }

        wp_send_json( $response );

        die();
    }

    add_action( 'wp_ajax_essence_loadmore_masonry_via_ajax', 'essence_loadmore_masonry_via_ajax' );
    add_action( 'wp_ajax_nopriv_essence_loadmore_masonry_via_ajax', 'essence_loadmore_masonry_via_ajax' );
}


/** END FUNCTIONS FOR AJAX =================================== **/


/**
 * Add show item product via ajax
 **/

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
// Display 24 products per page. Goes in functions.php
//add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 2;' ), 20 );

if ( !function_exists( 'essence_show_product_via_ajax' ) ) {
    function essence_show_product_via_ajax()
    {
        $response = array(
            'html' => '',
        );
        $loop_columns = isset( $_POST[ 'loop_product' ] ) ? $_POST[ 'loop_product' ] : '3';
        $woof_settings = unserialize( 'a:30:{s:8:"by_price";a:7:{s:4:"show";s:1:"1";s:11:"show_button";s:1:"0";s:10:"title_text";s:0:"";s:6:"ranges";s:0:"";s:17:"first_option_text";s:0:"";s:15:"ion_slider_step";s:1:"1";s:15:"ion_slider_skin";s:8:"skinNice";}s:8:"tax_type";a:4:{s:11:"product_cat";s:8:"checkbox";s:11:"product_tag";s:8:"checkbox";s:8:"pa_color";s:8:"checkbox";s:7:"pa_size";s:8:"checkbox";}s:14:"excluded_terms";a:4:{s:11:"product_cat";s:0:"";s:11:"product_tag";s:0:"";s:8:"pa_color";s:0:"";s:7:"pa_size";s:0:"";}s:16:"tax_block_height";a:4:{s:11:"product_cat";s:1:"0";s:11:"product_tag";s:1:"0";s:8:"pa_color";s:1:"0";s:7:"pa_size";s:1:"0";}s:16:"show_title_label";a:4:{s:11:"product_cat";s:1:"0";s:11:"product_tag";s:1:"0";s:8:"pa_color";s:1:"0";s:7:"pa_size";s:1:"0";}s:13:"dispay_in_row";a:4:{s:11:"product_cat";s:1:"0";s:11:"product_tag";s:1:"0";s:8:"pa_color";s:1:"0";s:7:"pa_size";s:1:"0";}s:16:"custom_tax_label";a:4:{s:11:"product_cat";s:0:"";s:11:"product_tag";s:0:"";s:8:"pa_color";s:0:"";s:7:"pa_size";s:0:"";}s:3:"tax";a:4:{s:11:"product_cat";s:1:"1";s:11:"product_tag";s:1:"1";s:8:"pa_color";s:1:"1";s:7:"pa_size";s:1:"1";}s:11:"icheck_skin";s:4:"none";s:12:"overlay_skin";s:7:"default";s:19:"overlay_skin_bg_img";s:0:"";s:18:"plainoverlay_color";s:0:"";s:25:"default_overlay_skin_word";s:0:"";s:25:"woof_auto_hide_button_img";s:0:"";s:25:"woof_auto_hide_button_txt";s:0:"";s:26:"woof_auto_subcats_plus_img";s:0:"";s:27:"woof_auto_subcats_minus_img";s:0:"";s:16:"custom_front_css";s:0:"";s:15:"custom_css_code";s:0:"";s:18:"js_after_ajax_done";s:0:"";s:8:"per_page";s:2:"12";s:12:"storage_type";s:7:"session";s:25:"listen_catalog_visibility";s:1:"0";s:23:"disable_swoof_influence";s:1:"0";s:16:"cache_count_data";s:1:"0";s:11:"cache_terms";s:1:"0";s:19:"show_woof_edit_view";s:1:"1";s:22:"custom_extensions_path";s:0:"";s:20:"activated_extensions";s:0:"";s:11:"items_order";s:0:"";}' );
        $woof_settings = get_option( 'woof_settings', $woof_settings );

        $woof_settings[ 'per_page' ] = $loop_columns;
        update_option( 'woof_settings', $woof_settings );
        wp_send_json( $response );
        die();
    }
}

add_action( 'wp_ajax_essence_show_product_via_ajax', 'essence_show_product_via_ajax' );
add_action( 'wp_ajax_nopriv_essence_show_product_via_ajax', 'essence_show_product_via_ajax' );

/** END FUNCTIONS FOR AJAX =================================== **/


function essence_save_extra_register_fields( $customer_id )
{
    if ( isset( $_POST[ 'billing_phone' ] ) ) {
        // WooCommerce billing phone
        update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST[ 'billing_phone' ] ) );
    }
}

add_action( 'woocommerce_created_customer', 'essence_save_extra_register_fields' );

/**
 * Validate the extra register fields.
 *
 * @param  string $username          Current username.
 * @param  string $email             Current email.
 * @param  object $validation_errors WP_Error object.
 *
 * @return void
 */
add_filter( 'woocommerce_registration_errors', 'registration_errors_validation', 10, 3 );
function registration_errors_validation( $reg_errors, $sanitized_user_login, $user_email )
{
    $password = $_POST[ 'password' ];
    $repassword = $_POST[ 'repassword' ];
    if ( strcmp( $password, $repassword ) !== 0 ) {
        return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'essence' ) );
    }

    return $reg_errors;
}

/**
 * Add description for shop
 */

//add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_single_excerpt', 5);

if ( !function_exists( 'ts_mini_cart' ) ) {
    /**
     *  Mini cart on top menu
     *
     * @since 1.0
     **/
    function ts_mini_cart()
    {

        if ( class_exists( 'WooCommerce' ) ):

            $args = array(
                'list_class' => '',
            );

            ob_start();
            wc_get_template( 'cart/mini-cart.php', $args );
            $mini_cart = ob_get_clean();
            global $woocommerce;
            echo '<div class="ts-mini-cart-wrap">
                        <div class="widget_shopping_cart_content ts-mini-cart-wrap-content ">
							<div class="num_items cart-number-items">' . $woocommerce->cart->cart_contents_count . ' item(s) added to your bag</div>
                            ' . $mini_cart . '
                        </div>
                    </div>';

        endif;
    }
}


add_filter( 'add_to_cart_fragments', 'ess_header_add_to_cart_fragment' );

function ess_header_add_to_cart_fragment( $fragments )
{
    global $woocommerce;

    ob_start();

    ?>
    <a title="View your shopping cart" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>"
       class="cart-contents button-togole togole-cart">
        <span class="elegant-icon icon_cart"></span>
        <span class="cart-number-items">
            <?php echo sprintf( __( '%d', 'themestudio' ), $woocommerce->cart->cart_contents_count ); ?>
        </span>
    </a>
    <?php

    $fragments[ 'a.cart-contents' ] = ob_get_clean();

    return $fragments;

}

/**
 * Add custom tab woocommerce
 */


add_filter( 'woocommerce_product_tabs', 'ess_custom_product_tab' );

function ess_custom_product_tab( $tabs )
{
    if ( !class_exists( 'WooCommerce' ) ):
        return '';
    endif;
    global $product;
    $id_product = $product->id;

    /* Adds the new tab */
    $tab_class = 'ess-custom-tab-';
    $opt_title_tab_1 = get_post_meta( $id_product, 'essence_add-title-tab-1', true );
    $opt_title_tab_2 = get_post_meta( $id_product, 'essence_add-title-tab-2', true );
    $opt_title_tab_3 = get_post_meta( $id_product, 'essence_add-title-tab-3', true );
    $opt_title_tab_4 = get_post_meta( $id_product, 'essence_add-title-tab-4', true );
    if ( trim( $opt_title_tab_1 ) != '' ) {
        $tabs[ $tab_class . '1' ] = array(
            'title'    => __( $opt_title_tab_1, 'essence' ),
            'priority' => 50,
            'callback' => 'ess_put_content_tabs_1',
        );
    }
    if ( trim( $opt_title_tab_2 ) != '' ) {
        $tabs[ $tab_class . '2' ] = array(
            'title'    => __( $opt_title_tab_2, 'essence' ),
            'priority' => 51,
            'callback' => 'ess_put_content_tabs_2',
        );
    }
    if ( trim( $opt_title_tab_3 ) != '' ) {
        $tabs[ $tab_class . '3' ] = array(
            'title'    => __( $opt_title_tab_3, 'essence' ),
            'priority' => 52,
            'callback' => 'ess_put_content_tabs_3',
        );
    }
    if ( trim( $opt_title_tab_4 ) != '' ) {
        $tabs[ $tab_class . '4' ] = array(
            'title'    => __( $opt_title_tab_4, 'essence' ),
            'priority' => 53,
            'callback' => 'ess_put_content_tabs_4',
        );
    }

    return $tabs;  /* Return all  tabs including the new New Custom Product Tab  to display */
}

function ess_put_content_tabs_1()
{
    if ( !class_exists( 'WooCommerce' ) ):
        return '';
    endif;
    global $product;
    $id_product = $product->id;
    $opt_desc_tab_1 = get_post_meta( $id_product, 'essence_add-desc-tab-1', true );

    echo do_shortcode( wpautop( $opt_desc_tab_1 ) );

}

function ess_put_content_tabs_2()
{
    if ( !class_exists( 'WooCommerce' ) ):
        return '';
    endif;
    global $product;
    $id_product = $product->id;
    $opt_desc_tab_2 = get_post_meta( $id_product, 'essence_add-desc-tab-2', true );
    echo do_shortcode( wpautop( $opt_desc_tab_2 ) );

}

function ess_put_content_tabs_3()
{
    if ( !class_exists( 'WooCommerce' ) ):
        return '';
    endif;
    global $product;
    $id_product = $product->id;
    $opt_desc_tab_3 = get_post_meta( $id_product, 'essence_add-desc-tab-3', true );
    echo do_shortcode( wpautop( $opt_desc_tab_3 ) );

}

function ess_put_content_tabs_4()
{
    if ( !class_exists( 'WooCommerce' ) ):
        return '';
    endif;
    global $product;
    $id_product = $product->id;
    $opt_desc_tab_4 = get_post_meta( $id_product, 'essence_add-desc-tab-4', true );
    echo do_shortcode( wpautop( $opt_desc_tab_4 ) );

}