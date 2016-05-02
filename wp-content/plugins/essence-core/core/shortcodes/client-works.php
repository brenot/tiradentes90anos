<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_ClientWorks' );
function essence_core_VC_MAP_ClientWorks()
{
    global $ts_vc_anim_effects_in;
    vc_map(
        array(
            'name'     => __( 'Essence Client Works', 'essence-core' ),
            'base'     => 'essence_core_client_works', // shortcode
            'class'    => '',
            'category' => __( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'        => 'attach_images',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Images', 'essence-core' ),
                    'param_name'  => 'img_ids',
                    'description' => __( 'Choose slide images', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Image Size', 'essence-core' ),
                    'param_name'    => 'imgs_size',
                    'std'           => '270x135',
                    'description'   => __( '<em>{width}x{height}</em>. Example: <em>270x135</em>', 'essence-core' )
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
                    'heading'    => __( 'Css', 'essence-core' ),
                    'param_name' => 'css',
                    'group'      => __( 'Design options', 'essence-core' ),
                ),
            ),
        )
    );
}

function essence_core_client_works( $atts )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_client_works', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'img_ids'          => '',
                'imgs_size'        => '270x135',
                'loop'             => '',
                'autoplay'         => '',
                'autoplay_timeout' => '',
                'css_animation'    => '',
                'animation_delay'  => '',   // In second
                'css'              => '',
            ), $atts
        )
    );

    $css_class = 'ts-client-shortcode client-style-2 wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }

    $animation_delay = $animation_delay . 's';

    $img_size_x = 270;
    $img_size_y = 135;
    if ( trim( $imgs_size ) != '' ) {
        $imgs_size = explode( 'x', $imgs_size );
    }
    $img_size_x = isset( $imgs_size[ 0 ] ) ? max( 0, intval( $imgs_size[ 0 ] ) ) : $img_size_x;
    $img_size_y = isset( $imgs_size[ 1 ] ) ? max( 0, intval( $imgs_size[ 1 ] ) ) : $img_size_y;

    $html = '';
    $logo_items_html = '';

    if ( trim( $img_ids ) != '' ) {

        $img_ids = explode( ',', $img_ids );

        $count_item = intval( count( $img_ids ) );

        if ( $count_item == 2 ) {
            $class_item = 'client-item col-sm-6 col-xs-6';
            $class_client = 'client-2item';
        }
        elseif ( $count_item == 3 || $count_item == 6 ) {
            $class_item = 'client-item  col-sm-4 col-xs-6';
            $class_client = 'client-36item';
        }
        else {
            $class_item = 'client-item col-sm-3 col-xs-6';
            $class_client = 'client-otheritem';
        }

        foreach ( $img_ids as $img_id ):

            $img = essence_core_resize_image( $img_id, null, $img_size_x, $img_size_y, true, true, false );

            $logo_items_html .= '<div class="' . esc_attr( $class_item ) . '">
									<a href="#" target="_blank"><figure><img width="' . esc_attr( $img['width'] ) . '" height="' . esc_attr( $img['height'] ) . '" src="' . esc_url( $img[ 'url' ] ) . '" alt=""></figure></a>
								</div>';
        endforeach;

        if ( trim( $logo_items_html ) != '' ) {
            $html = $logo_items_html;
        }

    }

    $html = '<div class="' . esc_attr( $css_class ) . ' ' . esc_attr( $class_client ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">
             <div class="row">
                ' . $html . '
             </div> <!--End .row-->
            </div><!--End  .ts-client-shortcode-->';

    return $html;

}

add_shortcode( 'essence_core_client_works', 'essence_core_client_works' );
