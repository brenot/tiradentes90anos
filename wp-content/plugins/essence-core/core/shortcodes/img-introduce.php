<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_Image_Intro' );
function essence_core_VC_MAP_Image_Intro()
{
    global $ts_vc_anim_effects_in;
    vc_map(
        array(
            'name'     => esc_html__( 'Essence Core Image With Introduce', 'essence-core' ),
            'base'     => 'essence_core_img_intro', // shortcode
            'class'    => '',
            'category' => esc_html__( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Introduce Type', 'essence-core' ),
                    'param_name'  => 'introduce_type',
                    'value'       => array(
                        __( 'Introduce Type 1', 'essence-core' ) => 'introduce_type_1',
                        __( 'Introduce Type 2', 'essence-core' ) => 'introduce_type_2',
                    ),
                    'std'         => 'introduce_type_1',
                    'description' => __( 'Select introduce type for shortcode image with introduce', 'essence-core' ),
                ),
                array(
                    'type'        => 'attach_image',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Image', 'essence-core' ),
                    'param_name'  => 'img_id',
                    'description' => esc_html__( 'Choose image', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Image Size', 'essence-core' ),
                    'param_name'  => 'img_size',
                    'std'         => '670x670',
                    'description' => wp_kses( __( '<em>{width}x{height}</em>. Example: type 1:<em>670x670</em>, type 2 : <em>775x761</em>', 'essence-core' ), array( 'em' => array() ) ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Title', 'essence-core' ),
                    'param_name' => 'title',
                    'std'        => esc_html__( 'Our History', 'essence-core' ),
                ),
                array(
                    'type'        => 'textarea_html',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Content', 'essence-core' ),
                    'param_name'  => 'content',
                    'std'         => __( '<h2>Minimal Creative <em>Studio</em></h2>Our basic principle is to get the maximum quality within the existing budget and the deadline.  The company currently consists of 14 employees.ents.', 'essence-core' ),
                    'description' => esc_html__( 'Note: Font size of h1 is 72px, h2 is 60px, h3 is 48px, h4 is 36px, h5 is 30px, h6 is 24px.', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Show Text Border', 'essence-core' ),
                    'param_name' => 'show_text_border',
                    'value'      => array(
                        esc_html__( 'Yes', 'essence-core' ) => 'yes',
                        esc_html__( 'No', 'essence-core' )  => 'no',
                    ),
                    'std'        => 'yes',
                ),
                array(
                    'type'       => 'vc_link',
                    'param_name' => 'link',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Link', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'CSS Animation', 'essence-core' ),
                    'param_name' => 'css_animation',
                    'value'      => $ts_vc_anim_effects_in,
                    'std'        => 'fadeInUp',
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Animation Delay', 'essence-core' ),
                    'param_name'  => 'animation_delay',
                    'std'         => '0.4',
                    'description' => esc_html__( 'Delay unit is second.', 'essence-core' ),
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

function essence_core_img_intro( $atts, $content = null )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_img_intro', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'introduce_type'   => '',
                'img_id'           => 0,
                'img_size'         => '670x670',
                'title'            => '',
                'show_text_border' => '',
                'link'             => '',
                'css_animation'    => '',
                'animation_delay'  => '0.4',   //In second
                'css'              => '',
            ), $atts
        )
    );
    $link_default = array(
        'url'    => '',
        'title'  => '',
        'target' => '',
    );

    if ( function_exists( 'vc_build_link' ) ):
        $link = vc_build_link( $link );
    else:
        $link = $link_default;
    endif;

    if ( $introduce_type == 'introduce_type_1' ) {
        $css_class = 'image-intro-wrap wow ' . $css_animation;
    }
    else {
        $css_class = 'image-intro-type2 wow ' . $css_animation;
    }
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';

    $show_text_border = trim( $show_text_border ) == 'yes';

    $html = '';
    $title_html = '';
    $intro_box_border_html = '';

    if ( $show_text_border ) {
        $intro_box_border_html .= '<div class="intro-border intro-border-top"></div>';
        $intro_box_border_html .= '<div class="intro-border intro-border-bottom"></div>';
        $intro_box_border_html .= '<div class="intro-border intro-border-right"></div>';
        $intro_box_border_html .= '<div class="intro-border intro-border-left"></div>';
    }

    $content = wpb_js_remove_wpautop( $content, true );

    $img_size_x = 670;
    $img_size_y = 670;
    if ( trim( $img_size ) != '' ) {
        $img_size = explode( 'x', $img_size );
    }
    $img_size_x = isset( $img_size[ 0 ] ) ? max( 0, intval( $img_size[ 0 ] ) ) : $img_size_x;
    $img_size_y = isset( $img_size[ 1 ] ) ? max( 0, intval( $img_size[ 1 ] ) ) : $img_size_y;

    $img = essence_core_resize_image( $img_id, null, $img_size_x, $img_size_y, true, true, false );
    $readmore_intro = '<a class="introduct-readmore" href="' . esc_url( $link[ 'url' ] ) . '" target="' . esc_attr( $link[ 'target' ] ) . '">' . esc_attr( $link[ 'title' ] ) . '</a>';

    if ( $introduce_type == 'introduce_type_1' ) {
        $html .= '<div class="image-wrap">
                <figure>
                    <img width="' . esc_attr( $img[ 'width' ] ) . '" height="' . esc_attr( $img[ 'height' ] ) . '" src="' . esc_url( $img[ 'url' ] ) . '" alt="' . esc_attr( get_post_meta( $img_id, '_wp_attachment_image_alt', true ) ) . '" />
                </figure>
            </div>';

        $title_html .= trim( $title ) != '' ? '<h3 class="intro-title">' . sanitize_text_field( $title ) . '</h3>' : '';

        $html .= '<div class="intro-box">
                ' . $title_html . '
                <div class="intro-content">
                    ' . $content . '
                </div>
                ' . $intro_box_border_html . '
                ' . $readmore_intro . '
            </div>';
    }
    else {
        $title_html .= trim( $title ) != '' ? '<h2 class="introduct-title">' . sanitize_text_field( $title ) . '</h2>' : '';
        $html .= '<!-- Shortcode Introduction -->
	            <div class="ts-introduction">
	            	<div class="row">
	            		<div class="col-sm-6">
	            			<div class="ts-introduct-content">
	            				' . $title_html . '
	            				<div class="introduct-desc">
	            				' . $content . '
	            				</div>
								' . $readmore_intro . '
	            			</div>
	            		</div>
	            		<div class="col-sm-6">
	            			<div class="ts-introduct-img">
	            				<figure>
                                    <img width="' . esc_attr( $img[ 'width' ] ) . '" height="' . esc_attr( $img[ 'height' ] ) . '" src="' . esc_url( $img[ 'url' ] ) . '" alt="' . esc_attr( get_post_meta( $img_id, '_wp_attachment_image_alt', true ) ) . '" />
                                </figure>
	            			</div>
	            		</div>
	            	</div>
	            </div>
	            <!-- End Shortcode Introduction -->';
    }


    $html = '<div class="' . $css_class . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">' . $html . '</div>';

    return $html;

}

add_shortcode( 'essence_core_img_intro', 'essence_core_img_intro' );
