<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

// Essence Testimonials Carousel: testimonials_carousel
add_action( 'vc_before_init', 'essence_core_VC_MAP_Testimonial' );
function essence_core_VC_MAP_Testimonial()
{
    global $ts_vc_anim_effects_in;
    vc_map(
        array(
            'name'     => __( 'Testimonials Carousel', 'essence-core' ),
            'base'     => 'testimonials_carousel', // shortcode
            'class'    => '',
            'category' => __( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'        => 'essence_core_select_testimonial_cat_field',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Select Category', 'essence-core' ),
                    'param_name'  => 'tes_cat_id',
                    'description' => __( 'Select category testimonial.', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Loop slider posts', 'essence-core' ),
                    'param_name' => 'essence-core_loop_latest',
                    'value'      => array(
                        __( 'Yes', 'essence-core' ) => 'yes',
                        __( 'No', 'essence-core' )  => 'no',
                    ),
                    'std'        => 'yes',
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Limit', 'essence-core' ),
                    'param_name'  => 'post_limit',
                    'std'         => '5',
                    'description' => __( 'Maximum of post will be shown', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Autoplay posts', 'essence-core' ),
                    'param_name' => 'essence-core_autoplay_latest',
                    'value'      => array(
                        __( 'Yes', 'essence-core' ) => 'yes',
                        __( 'No', 'essence-core' )  => 'no',
                    ),
                    'std'        => 'no',
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Autoplay Timeout', 'essence-core' ),
                    'param_name'  => 'autoplay_timeout',
                    'std'         => '5000',
                    'description' => __( '', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'essence-core_autoplay_latest',
                        'value'   => array( 'yes' ),
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'CSS Animation', 'essence-core' ),
                    'param_name'  => 'css_animation',
                    'value'       => $ts_vc_anim_effects_in,
                    'std'         => 'fadeInUp',
                    'description' => __( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Animation Delay', 'essence-core' ),
                    'param_name'  => 'animation_delay',
                    'std'         => '0.4',
                    'description' => __( 'Delay unit is second.', 'essence-core' ),
                    'dependency'  => array(
                        'element'   => 'css_animation',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'essence-core' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'essence-core' ),
                ),
            ),
        )
    );
}

//Testimonial Carousel
function testimonials_carousel( $atts )
{
    //Get attribute
    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'testimonials_carousel', $atts ) : $atts;
    extract(
        shortcode_atts(
            array(
                'tes_cat_id'                 => '',
                'essence-core_loop_latest'     => '',
                'post_limit'                 => '',
                'essence-core_autoplay_latest' => '',
                'autoplay_timeout'           => '',
                'css_animation'              => '',
                'animation_delay'            => '',
                'css'                        => '',
            ), $atts
        )
    );
    // Extra CSS + Animation

    $css_class = $html_loop_items = $html = '';
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = '0';
    }
    $animation_delay = $animation_delay . 's';

    // Query
    $query_args = array(
        'post_type'   => 'testimonial',
        'showposts'   => $post_limit,
        'post_status' => array( 'publish' ),
    );

    if ( $tes_cat_id > 0 ):

        $query_args[ 'tax_query' ] = array(
            array(
                'taxonomy' => 'testimonial_cat',
                'field'    => 'ids',
                'terms'    => $tes_cat_id,
            ),
        );

    endif;
    $query_posts = new WP_Query( $query_args );
    // Loop
    $thumb = array(
        'url'    => '',
        'width'  => 0,
        'height' => 0,
    );



    if ( $query_posts->have_posts() ):
        while ( $query_posts->have_posts() ) : $query_posts->the_post();
            $testimonial_position = get_post_meta( get_the_ID(), 'essence_testimonial_pos', true );
            if ( has_post_thumbnail() ):
                $thumb = essence_core_resize_image( get_post_thumbnail_id( get_the_ID() ), null, 69, 69, true, true, false );
            endif;
            $html_loop_items .= '<div class="essence-core-testimonials-carousel-item">
                                    <div class="thumbnail-testimonial">
										<figure><img src="' . esc_url( $thumb[ 'url' ] ) . '" alt=""></figure>
        							</div><!-- /.thumbnail-testimonial -->
        							<div class="info-testimonial">
                                        <div class="testi-content">' . get_the_content() . '</div>
                                        <div class="testi-author">
                                            <h5 class="testi-title">' . get_the_title() . '</h5>';
            if ( trim( $testimonial_position ) !='' ) {
                $html_loop_items .= '           <span>' . esc_attr( $testimonial_position ) . '</span>';
            }
            $html_loop_items .= '       </div>
        							</div><!-- /.info-testimonial -->
        						</div><!-- /.essence-core-testimonials-carousel-item-->';
        endwhile;
        wp_reset_postdata();
    endif;
    $html .= '<div class="ts-testimonial-wrap wow ' . esc_attr( $css_class . ' ' . $css_animation ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '" >';
    $html .= '<div class="essence-owl-carousel owl-carousel" data-number="1" data-navcontrol="yes" data-dots="no">';
    $html .= $html_loop_items;
    $html .= '</div>';
    $html .= '</div><!-- /.ts-testimonial-posts-wrap -->';

    return $html;
}

add_shortcode( 'testimonials_carousel', 'testimonials_carousel' );