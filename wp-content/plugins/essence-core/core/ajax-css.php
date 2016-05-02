<?php

/**
 * Customize css for Noren theme
 **/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


if ( !function_exists( 'essence_core_enqueue_style_via_ajax' ) ) {
    function essence_core_enqueue_style_via_ajax()
    {
        global $essence;

        $base_color = isset( $essence[ 'opt_general_accent_color' ] ) ? $essence[ 'opt_general_accent_color' ] : array( 'color' => '#bda47d', 'alpha' => 1 );
        $base_color = essence_core_color_hex2rgba( $base_color[ 'color' ], $base_color[ 'alpha' ] );

        // For custom frontend if needed

        $post_id = isset( $_GET[ 'post_id' ] ) ? intval( $_GET[ 'post_id' ] ) : 0;

        $breadcrumbs_color = get_post_meta( $post_id, 'essence_breadcrumb_color', true );
        $breadcrumbs_hover_color = get_post_meta( $post_id, 'essence_breadcrumb_hover_color', true );
        $breadcrumbs_cur_page_color = get_post_meta( $post_id, 'essence_breadcrumb_cur_page_color', true );
        $breadcrumbs_sep_color = get_post_meta( $post_id, 'essence_breadcrumb_sep_color', true );

        $breadcrumbs_color = trim( $breadcrumbs_color ) != '' ? esc_attr( $breadcrumbs_color ) : '#999999';
        $breadcrumbs_hover_color = trim( $breadcrumbs_hover_color ) != '' ? esc_attr( $breadcrumbs_hover_color ) : '#ffffff';
        $breadcrumbs_cur_page_color = trim( $breadcrumbs_cur_page_color ) != '' ? esc_attr( $breadcrumbs_cur_page_color ) : '#999999';
        $breadcrumbs_sep_color = trim( $breadcrumbs_sep_color ) != '' ? esc_attr( $breadcrumbs_sep_color ) : '#333333';

        header( 'Content-type: text/css; charset: UTF-8' );

        $css = 'a:hover, a:focus{
                    color: ' . esc_attr( $base_color ) . ';
                }
                button:hover, button:focus, input[type="submit"]:hover, input[type="submit"]:focus,
                .button:hover, .button:focus, .ts-button:hover, .ts-button:focus{
                    background: ' . esc_attr( $base_color ) . ';
                    border-color: ' . esc_attr( $base_color ) . ';
                }
                .ts-our-blog .ts-our-blog-item-info a:hover, .ts-our-blog .ts-our-blog-item-info p:hover, .ts-our-blog .ts-our-blog-item-info span:hover, .ts-our-blog .ts-our-blog-item-info h4:hover, .ts-our-blog .ts-our-blog-item-info h4 a:hover, ul.essence-meta-latestpost .author a:hover, .ts-our-blog .our-more a:hover {
                  color: ' . esc_attr( $base_color ) . ';
                }
                .ts-our-blog .ts-our-blog-item-info:hover .item-title:before{
                  color: ' . esc_attr( $base_color ) . ';
                }
                .esg-grid .esg-loadmore-wrapper .esg-loadmore:hover {
                  border-color: ' . esc_attr( $base_color ) . ';
                  color: ' . esc_attr( $base_color ) . ';
                }
                .esg-grid .esg-loadmore-wrapper .esg-loadmore:hover {
                  color: ' . esc_attr( $base_color ) . ';
                }
                .entry-title:hover,.read-more.ts-button:hover {
                  color: ' . esc_attr( $base_color ) . ';
                }
                .single .entry-meta li a:hover {
                  color: ' . esc_attr( $base_color ) . ';
                }
                .content-post .page-links > span {
                  color: ' . esc_attr( $base_color ) . ';
                }
                footer.footer-style-3 .footer-left .copyright p a:hover, footer.footer-style-3 .backtotop:hover span {
                    color: ' . esc_attr( $base_color ) . ';
                }
                footer.footer-style-4 .backtotop:hover span {
                    color: ' . esc_attr( $base_color ) . ';
                }
                .footer-style-4 .menu-footer a:hover::before {
                    color: ' . esc_attr( $base_color ) . ';
                }
                .footer-style-4 .footer-top .copyright p a:hover {
                    color: ' . esc_attr( $base_color ) . ';
                }
                #contact .bullet-list-wrap .bullet-list li a:hover, #contact form .tr-form-v4 .tr-submit:hover {
                    color: ' . esc_attr( $base_color ) . ';
                }
                #contact form .tr-form-v4 .tr-submit:hover {
                    color: ' . esc_attr( $base_color ) . ';
                }
                div.member-style1 .ts-team-content .social-links a:hover, .member-style1 .ts-team-content .ts-team-name a:hover {
                    color: ' . esc_attr( $base_color ) . ';
                }
                .showcase-page-nav .pull-left a:hover, .showcase-page-nav .pull-right a:hover, .showcase-page-icon a:hover, .ts-members-wrap .ts-team-content .ts-team-name a:hover, .ts-members-wrap .ts-team-content .social-links a:hover {
                    color: ' . esc_attr( $base_color ) . ';
                }
                .essence-portfolio-content-wrap .owl-carousel .owl-nav > div {
                    background: ' . esc_attr( $base_color ) . ' none repeat scroll 0 0;
                }
                .blog-single .tags-links.tagcloud a:hover, .blog-single .social-share li a:hover, .page-blog-single .date-reply-comment a:hover, .comment-respond .logged-in-as a:hover, .blog .blog-content-area .entry-meta a:hover {
                  color: ' . esc_attr( $base_color ) . ';
                }
                .essence-portfolio-content .west-port-socialshare a:hover, .essence-portfolio-info .essence-button:hover {
                  color: ' . esc_attr( $base_color ) . ';
                }
                .sidebar-latest-posts .sidebar-latest-post-item h4 a:hover, .sidebar .widget.widget_categories ul li a:hover, aside.widget_tag_cloud .tagcloud a:hover, .sidebar .widget a:hover {
                    color: ' . esc_attr( $base_color ) . ';
                }
                .essence-portfolio-category .ts_cats a:hover{
                    color: ' . esc_attr( $base_color ) . ';
                }
                .ts-newsletter-shortcode .form-newsletter .button_newletter:hover {
                    color: ' . esc_attr( $base_color ) . ';
                }';

        // For woocommerce
        $css .= '.woocommerce div.product p.price, .woocommerce div.product span.price {
                  color: ' . esc_attr( $base_color ) . ';
                }
                .woocommerce .product .add_to_cart_button:hover {
                  background: ' . esc_attr( $base_color ) . ' none repeat scroll 0 0;
                }
                .added_to_cart:hover,.woocommerce .product .product_type_variable:hover {
                  background: ' . esc_attr( $base_color ) . ' none repeat scroll 0 0;
                }
                .woocommerce .chosen-container .chosen-results li.highlighted {
                  background: ' . esc_attr( $base_color ) . ';
                }
                .woocommerce div.product p.stock {
                  color: ' . esc_attr( $base_color ) . ';
                }
                .woocommerce div.product form.cart .button.single_add_to_cart_button:hover {
                  background: ' . esc_attr( $base_color ) . ' none repeat scroll 0 0;;
                }
                .entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:hover, .entry-summary .yith-wcwl-wishlistaddedbrowse a:hover, .entry-summary .yith-wcwl-wishlistexistsbrowse a:hover {
                  border: 1px solid ' . esc_attr( $base_color ) . ';
                  background: ' . esc_attr( $base_color ) . ';
                }
                }
                .entry-summary .yith-wcwl-wishlistaddedbrowse.show a, .entry-summary .yith-wcwl-wishlistexistsbrowse.show a {
                  background: ' . esc_attr( $base_color ) . ' none repeat scroll 0 0;
                  border-color: ' . esc_attr( $base_color ) . ';
                }
                .woocommerce #respond input#submit.alt:hover,.woof_redraw_zone .button.woof_reset_search_form :hover,.woocommerce .shipping-calculator-form .button:hover,.woocommerce .shipping-calculator-form .button:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.shipping-calculator-button:hover {
                  background-color: ' . esc_attr( $base_color ) . ';
                }';
        // For Breadcrumb
        $css .= '.header-breadcrumb-wrap ul .trail-item a span {
                    color: ' . $breadcrumbs_color . ';
                }
                .header-breadcrumb-wrap ul .trail-item a:hover span {
                    color: ' . $breadcrumbs_hover_color . ';
                }
                .header-breadcrumb-wrap ul .trail-item span {
                    color: ' . $breadcrumbs_cur_page_color . ';
                }
                .header-breadcrumb-wrap ul li::before {
                    color: ' . $breadcrumbs_sep_color . ';
                }
                ';

        // Overide file style.css in plugins/essence-core/assets/css/woocommerce.css

        $custom_css = isset( $essence[ 'opt_general_css_code' ] ) ? $essence[ 'opt_general_css_code' ] : '';

        $css .= $custom_css;
        echo $css;

        wp_die();
    }
}

add_action( 'wp_ajax_essence_core_enqueue_style_via_ajax', 'essence_core_enqueue_style_via_ajax' );
add_action( 'wp_ajax_nopriv_essence_core_enqueue_style_via_ajax', 'essence_core_enqueue_style_via_ajax' );


if ( !function_exists( 'essence_core_color_hex2rgba' ) ) {
    function essence_core_color_hex2rgba( $hex, $alpha = 1 )
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

if ( !function_exists( 'essence_core_color_rgb2hex' ) ) {
    function essence_core_color_rgb2hex( $rgb )
    {
        $hex = '#';
        $hex .= str_pad( dechex( $rgb[ 0 ] ), 2, '0', STR_PAD_LEFT );
        $hex .= str_pad( dechex( $rgb[ 1 ] ), 2, '0', STR_PAD_LEFT );
        $hex .= str_pad( dechex( $rgb[ 2 ] ), 2, '0', STR_PAD_LEFT );

        return $hex; // returns the hex value including the number sign (#)
    }
}
