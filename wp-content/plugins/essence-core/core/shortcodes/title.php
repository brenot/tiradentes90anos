<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_Title' );
function essence_core_VC_MAP_Title()
{
    global $ts_vc_anim_effects_in;
    vc_map(
        array(
            'name'     => __( 'Essence Core Title', 'essence-core' ),
            'base'     => 'essence_core_title', // shortcode
            'class'    => '',
            'category' => __( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Title type', 'essence-core' ),
                    'param_name'  => 'style',
                    'holder'      => 'div',
                    'value'       => array(
                        __( 'Title Type 1', 'essence-core' ) => 'style1',
                        __( 'Title Type 2', 'essence-core' ) => 'style2',
                    ),
                    'std'         => 'style1',
                    'description' => __( 'This is select type for Title shortcode.', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Title', 'essence-core' ),
                    'param_name' => 'title',
                    'std'        => esc_html__( 'OUR SERVICES', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Title Font Size', 'essence-core' ),
                    'param_name' => 'title_font_size',
                    'std'        => '30',
                    'group'      => esc_html__( 'Colors And Sizes', 'essence-core' ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Title Color', 'essence-core' ),
                    'param_name' => 'title_color',
                    'std'        => '#000000',
                    'group'      => esc_html__( 'Colors And Sizes', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Sub Title', 'essence-core' ),
                    'param_name' => 'subtitle',
                    'std'        => esc_html__( 'WE CREATE THE BEST SERVICE', 'essence-core' ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Sub Title Color', 'essence-core' ),
                    'param_name' => 'subtitle_color',
                    'std'        => '#000000',
                    'group'      => esc_html__( 'Colors And Sizes', 'essence-core' ),
                ),
                array(
                    'type'       => 'checkbox',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Have...', 'essence-core' ),
                    'param_name' => 'have',
                    'value'      => array(
                        esc_html__( 'Hyphen', 'essence-core' )           => 'has-hyphen',
                        esc_html__( 'Arrow', 'essence-core' )            => 'has-arrow',
                        esc_html__( 'Dashed Separator', 'essence-core' ) => 'has-dashed',
                    ),
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Hyphen Length', 'essence-core' ),
                    'param_name' => 'hyphen_length',
                    'std'        => '100',
                    'group'      => esc_html__( 'Colors And Sizes', 'essence-core' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Hyphen Color', 'essence-core' ),
                    'param_name' => 'hyphen_color',
                    'std'        => '#000000',
                    'group'      => esc_html__( 'Colors And Sizes', 'essence-core' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Separator Length', 'essence-core' ),
                    'param_name' => 'sep_length',
                    'std'        => '100',
                    'group'      => esc_html__( 'Colors And Sizes', 'essence-core' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Separator Color', 'essence-core' ),
                    'param_name' => 'sep_color',
                    'std'        => '#eeeeee',
                    'group'      => esc_html__( 'Colors And Sizes', 'essence-core' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Align', 'essence-core' ),
                    'param_name' => 'align',
                    'value'      => array(
                        __( 'Left', 'essence-core' )   => 'text-left',
                        __( 'Right', 'essence-core' )  => 'text-right',
                        __( 'Center', 'essence-core' ) => 'text-center',
                    ),
                    'std'        => 'text-center',
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

function essence_core_title( $atts )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_title', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'style'           => '',
                'title'           => '',
                'title_font_size' => '30',
                'title_color'     => '#000000',
                'subtitle'        => '',
                'subtitle_color'  => '#000000',
                'have'            => '',
                'hyphen_length'   => '100',
                'hyphen_color'    => '#000000',
                'sep_length'      => '100',
                'sep_color'       => '#eeeeee',
                'align'           => 'center',
                'css'             => '',
            ), $atts
        )
    );

    $css_class = 'section-title';
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    $html = '';
    $hyphen_html = in_array( 'has-hyphen', explode( ',', $have ) ) ? '<hr class="tr-hyphen-arrow" style="width:1px; height: ' . intval( $hyphen_length ) . 'px; background-color: ' . esc_attr( $hyphen_color ) . '">' : '';
    $title_html = '';
    $subtitle_html = '';
    $sep_dashed_html = '<hr class="tr-dotted" style = "width: ' . intval( $sep_length ) . 'px; border-color: ' . esc_attr( $sep_color ) . '; border-style: dashed;" >';
    if ( $style == 'style1' ) {
        if ( trim( $subtitle ) != '' ) {
            $subtitle_html .= '<h5 class="sub-title-block" style = "color: ' . esc_attr( $subtitle_color ) . ';" >' . sanitize_text_field( $subtitle ) . '</h5 >';
        }
    }
    else {
        if ( trim( $subtitle ) != '' ) {
            $subtitle_html .= '<div class="title-description-style2" style = "color: ' . esc_attr( $subtitle_color ) . ';" >' . sanitize_text_field( $subtitle ) . '</div>';
        }
    }

    if ( trim( $title ) != '' ) {
        $title_font_size = intval( $title_font_size );
        $title_color = esc_attr( $title_color );
        $title_style = "font-size: {$title_font_size}px; color: {$title_color};";
        $title_html .= '<h2 class="title-block" style = "' . $title_style . '" >' . sanitize_text_field( $title ) . '</h2 >';
    }


    $css_class .= ' ' . str_replace( ',', ' ', $have ) . ' ' . $align;
    if ( $style == 'style1' ) {
        $html = '<div class="' . esc_attr( $css_class ) . '">
					' . $hyphen_html . '
					<div class="section-title-wrap section-title-style1">
	                    ' . $title_html . '
	                    ' . $sep_dashed_html . '
	                    ' . $subtitle_html . '
	                </div >
                </div >';
    }
    else {
        $html = '<div class="' . esc_attr( $css_class ) . '">
					<div class="section-title-wrap section-title-style2">
	                    ' . $title_html . '
	                    ' . $subtitle_html . '
	                </div >
                </div >';
    }

    return $html;

}

add_shortcode( 'essence_core_title', 'essence_core_title' );
