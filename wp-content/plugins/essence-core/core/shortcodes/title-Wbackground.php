<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_TitleWBackground' );
function essence_core_VC_MAP_TitleWBackground()
{
    global $ts_vc_anim_effects_in;
    vc_map(
        array(
            'name'     => __( 'Essence Core Title With Background', 'essence-core' ),
            'base'     => 'essence_core_titlewbackground', // shortcode
            'class'    => '',
            'category' => __( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Image or Text', 'essence-core' ),
                    'param_name' => 'suport_img_text',
                    'value'      => array(
                        esc_html__( 'Text', 'essence-core' )  => 'text',
                        esc_html__( 'Image', 'essence-core' ) => 'background',
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Box Align', 'essence-core' ),
                    'param_name' => 'suport_box_align',
                    'value'      => array(
                        esc_html__( 'Align Normal', 'essence-core' )  => 'box-normal',
                        esc_html__( 'Align Left', 'essence-core' )  => 'box-left',
                        esc_html__( 'Align Right', 'essence-core' ) => 'box-right',
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Box Layout', 'essence-core' ),
                    'param_name' => 'suport_box_layout',
                    'value'      => array(
                        esc_html__( 'Dark', 'essence-core' )  => 'dark',
                        esc_html__( 'Light', 'essence-core' )  => 'light',
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Text ( background )', 'essence-core' ),
                    'param_name' => 'textbackground',
                    'std'        => esc_html__( '01', 'essence-core' ),
                    'dependency' => array(
                        'element' => 'suport_img_text',
                        'value'   => array( 'text' ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Title Font Size', 'essence-core' ),
                    'param_name' => 'title_font_size',
                    'std'        => '300',
                    'dependency' => array(
                        'element' => 'suport_img_text',
                        'value'   => array( 'text' ),
                    ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Title Color', 'essence-core' ),
                    'param_name' => 'title_color',
                    'std'        => '#e1e1e1',
                    'dependency' => array(
                        'element' => 'suport_img_text',
                        'value'   => array( 'text' ),
                    ),
                ),
                array(
                    'type'       => 'attach_image',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Image background', 'essence-core' ),
                    'param_name' => 'imgbackground',
                    'std'        => esc_html__( '01', 'essence-core' ),
                    'dependency' => array(
                        'element' => 'suport_img_text',
                        'value'   => array( 'background' ),
                    ),
                ),

                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Sub Title', 'essence-core' ),
                    'param_name' => 'title',
                    'std'        => esc_html__( 'OUR HISTORY', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Sub Title Font Size', 'essence-core' ),
                    'param_name' => 'sub_title_font_size',
                    'std'        => '30',
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Sub Title Color', 'essence-core' ),
                    'param_name' => 'sub_title_color',
                    'std'        => '#000000',
                ),

                array(
                    'type'       => 'css_editor',
                    'heading'    => __( 'Css', 'essence-core' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'essence-core' ),
                ),
            ),
        )
    );
}

function essence_core_titlewbackground( $atts )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_titlewbackground', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'title'                 => '',
                'suport_box'            => '',
                'title_font_size'       => '300',
                'title_color'           => '',
                'sub_title_font_size'   => '30',
                'sub_title_color'       => '',
                'suport_img_text'       => '',
                'textbackground'        => '',
                'boder_width'           => '',
                'boder_width_color'     => '',
                'suport_box_align'      => '',
                'suport_box_layout'     => '',
                'imgbackground'         => '',
                'css'                   => '',
            ), $atts
        )
    );

    $css_class = 'title-background '.$suport_box_align.' '.$suport_box_layout;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    $html = $title_html = $background_html = $border_style = '';
    $img_size_x = 431;
    $img_size_y = 400;
    if ( intval( $imgbackground ) > 0 ) {
        $img = essence_core_resize_image( $imgbackground, null, $img_size_x, $img_size_y, true, true, false );
    }
    if ( trim( $title ) != '' ) {
        $title_font_size = intval( $title_font_size );
        $title_color = esc_attr( $title_color );
        $sub_title_style = "font-size: {$sub_title_font_size}px; color: {$sub_title_color};";
        $title_html .= '<span class="short-sub-title" style = "' . $sub_title_style . '">' . sanitize_text_field( $title ) . '</span>';
    }
    if ( $suport_img_text == 'text' ) {
        $title_style = "font-size: {$title_font_size}px; color: {$title_color};";
        $background_html = '<span class="short-title" style = "' . $title_style . '">' . sanitize_text_field( $textbackground ) . '</span>';
    }
    else {
        $background_html = '<img src="' . esc_url( $img[ 'url' ] ) . '" alt />';
    }

    $html = '<div class="' . esc_attr( $css_class ) . '">
				<div class="ts-short-title">
                    ' . $background_html . '
                    ' . $title_html . '

	            </div>
             </div >';

    return $html;

}

add_shortcode( 'essence_core_titlewbackground', 'essence_core_titlewbackground' );
