<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_Banner_Slide' );
function essence_core_VC_MAP_Banner_Slide()
{
    global $ts_vc_anim_effects_in;
    vc_map(
        array(
            'name'     => __( 'Essence Core Banner Slider', 'essence-core' ),
            'base'     => 'essence_core_banner_slider', // shortcode
            'class'    => '',
            'category' => __( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'        => 'attach_image',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Images', 'essence-core' ),
                    'param_name'  => 'img_ids',
                    'description' => __( 'Choose banner image', 'essence-core' ),
                ),

                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Title', 'essence-core' ),
                    'param_name' => 'title',
                    'std'        => __( 'Banner title', 'essence-core' ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Title Color', 'essence-core' ),
                    'param_name' => 'title_color',
                    'std'        => '#000000',
                    'dependency' => array(
                        'element'   => 'title',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'       => 'textarea',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Sub Title', 'essence-core' ),
                    'param_name' => 'sub_title',
                    'std'        => __( 'Banner sub title', 'essence-core' ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Sub title Color', 'essence-core' ),
                    'param_name' => 'sub_title_color',
                    'std'        => '#949494',
                    'dependency' => array(
                        'element'   => 'sub_title',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Custom class', 'essence-core' ),
                    'param_name' => 'cus_class',
                ),
            ),
        )
    );
}

function essence_core_banner_slider( $atts )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_banner_slider', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'img_ids'         => 0,
                'title'           => '',
                'title_color'     => '#000000',
                'sub_title'       => '',
                'sub_title_color' => '#949494',
                'cus_class'       => '',
            ), $atts
        )
    );

    $css_class = 'ts-banner_wrap' . $cus_class;

    if ( trim( $img_ids ) != '' ) {
        $img_ids = explode( ',', $img_ids );
    }
    else {
        $img_ids = array();
    }

    $html = $title_html = $subtitle_html = '';

    if ( trim( $title ) != '' ) {
        $title_html .= '<h2 style="color:'. esc_attr($title_color) .'">' . sanitize_text_field( $title ) . '</h2>';
    }
    if ( trim( $sub_title ) != '' ) {
        $subtitle_html .= '<div class="sub-title" style="color:'. esc_attr($sub_title_color) .'">' . $sub_title . '</div>';
    }
    $html .= '<div class="ts-slide-banner"><div id="' . esc_attr( $css_class ) . '">';
    if ( !empty( $img_ids ) ) {
        foreach ( $img_ids as $img_id ):
            $img_full = essence_core_resize_image( $img_id, null, 4000, 4000, true, true, false );
            $html .= '<div class="large-header" style = "background-image:url(' . esc_url( $img_full[ 'url' ] ) . ')" >';
            $html .= '<canvas id="demo-canvas"></canvas>';
            $html .= '</div> <!--End #large-header --> ';
        endforeach;
    }
    $html .= '</div> <!--End .ts-slide-banner -->';
    $html .= '<div class="ts-banner-content">';
    $html .= $title_html;
    $html .= $subtitle_html;
    $html .= '</div> <!--End .ts-banner-content -->';
    $html .= '</div> <!--End #banner-slides -->';


    return $html;

}

add_shortcode( 'essence_core_banner_slider', 'essence_core_banner_slider' );
