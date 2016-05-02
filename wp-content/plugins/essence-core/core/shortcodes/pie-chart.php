<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_PieChart' );
function essence_core_VC_MAP_PieChart()
{
    global $ts_vc_anim_effects_in, $elegant_icons;
    vc_map(
        array(
            'name'     => esc_html__( 'Essence Core Pie Chart', 'essence-core' ),
            'base'     => 'essence_core_pie_chart', // shortcode
            'class'    => '',
            'category' => esc_html__( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'class'      => '',
                    'heading'    => esc_html__( 'Style', 'essence-core' ),
                    'param_name' => 'style',
                    'value'      => array(
                        esc_html__( 'Chart with icon', 'essence-core' )   => 'chart_icon',
                        esc_html__( 'Chart with number', 'essence-core' ) => 'chart_number',
                        esc_html__( 'Chart with text', 'essence-core' )   => 'chart_text',
                        esc_html__( 'Chart with image', 'essence-core' )  => 'chart_img',
                    ),
                    'std'        => 'chart_number',
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Chart Title', 'essence-core' ),
                    'param_name' => 'chart_title',
                    'std'        => esc_html__( 'Essence pie chart', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Chart Percent', 'essence-core' ),
                    'param_name'  => 'chart_percent',
                    'std'         => 75,
                    'description' => esc_html__( 'From 0 - 100.', 'essence-core' ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Icon', 'essence-core' ),
                    'param_name' => 'icon',
                    'settings'   => array(
                        'emptyIcon' => true, // default true, display an "EMPTY" icon?
                        'type'      => 'elegant',
                        'source'    => $elegant_icons,
                    ),
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'chart_icon' ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Chart Unit', 'essence-core' ),
                    'param_name' => 'chart_unit',
                    'std'        => esc_html__( '&#37;', 'essence-core' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'chart_number' ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Chart Text', 'essence-core' ),
                    'param_name' => 'chart_text',
                    'std'        => esc_html__( 'Essencestore', 'essence-core' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'chart_text' ),
                    ),
                ),
                array(
                    'type'        => 'attach_image',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Chart Image', 'essence-core' ),
                    'param_name'  => 'chart_img',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'chart_img' ),
                    ),
                    'description' => esc_html__( 'Choose an image', 'essence-core' ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Track Color', 'essence-core' ),
                    'param_name' => 'trackcolor',
                    'std'        => '#e4e4e4',
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Chart Color', 'essence-core' ),
                    'param_name'  => 'barcolor',
                    'std'         => '#eeb14f',
                    'description' => esc_html__( 'Bar, text and icon color.', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Chart Size', 'essence-core' ),
                    'param_name'  => 'size',
                    'std'         => 215,
                    'description' => esc_html__( 'Chart size in pixel (px).', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Bar Line Width', 'essence-core' ),
                    'param_name'  => 'linewidth',
                    'std'         => 5,
                    'description' => esc_html__( 'Bar line width in pixel (px).', 'essence-core' ),
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

function essence_core_pie_chart( $atts )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_pie_chart', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'style'         => 'chart_icon',
                'chart_title'   => '',
                'chart_percent' => 75,
                'icon'          => '',
                'chart_unit'    => '&#37;',
                'chart_text'    => '',
                'chart_img'     => '',
                'trackcolor'    => '#e4e4e4',
                'barcolor'      => '#eeb14f',
                'size'          => 215,
                'linewidth'     => 5,
                'css'           => '',
            ), $atts
        )
    );

    $css_class = 'ts-progressbar-wrap';
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    $chart_attrs = 'data-trackColor="' . esc_attr( $trackcolor ) . '" data-barColor="' . esc_attr( $barcolor ) . '" data-lineWidth="' . esc_attr( $linewidth ) . '" data-size="' . intval( $size ) . '" data-percent="' . intval( $chart_percent ) . '" data-unit="' . esc_attr( $chart_unit ) . '"';

    $html = '';
    $inner_chart_html = '';
    $title_html = '';

    switch ( trim( $style ) ):

        case 'chart_icon':
            if ( trim( $icon ) != '' ) {
                $inner_chart_html = '<span class="icon ' . esc_attr( $icon ) . '"></span>';
            }
            break;

        case 'chart_number':
            $inner_chart_html = '<span class="title chart-percent">' . intval( $chart_percent ) . esc_attr( $chart_unit ) . '</span>';
            break;

        case 'chart_text':
            $inner_chart_html = '<span class="title chart-text">' . sanitize_text_field( $chart_text ) . '</span>';
            break;

        case 'chart_img':
            $size = max( 1, ( intval( $size ) - 2 * intval( $linewidth ) ) );
            $img = essence_core_resize_image( $chart_img, null, intval( $size ), intval( $size ), true, true, false );
            $inner_chart_html = '<span class="chart-image"><img src="' . esc_url( $img[ 'url' ] ) . '" alt="' . esc_attr( $chart_title ) . '"></span>';
            break;

    endswitch;

    if ( trim( $chart_title ) != '' ) {
        $title_html = '<h5 class="piechar-title">' . sanitize_text_field( $chart_title ) . '</h5>';
    }

    $html = '<div class="' . esc_attr( $css_class ) . '">
                <div class="ts-progressbar">
                    <div class="ts-chart" ' . $chart_attrs . '>
                        ' . $inner_chart_html . '
                    </div><!-- /.ts-chart -->
                    ' . $title_html . '
                </div><!-- /.ts-progressbar -->
            </div><!-- /.' . esc_attr( $css_class ) . ' -->';


    return $html;

}

add_shortcode( 'essence_core_pie_chart', 'essence_core_pie_chart' );
