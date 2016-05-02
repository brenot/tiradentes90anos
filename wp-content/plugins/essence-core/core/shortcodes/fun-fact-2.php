<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_FunFact2' );
/**
 * array(
 *        'type' => 'font_container',
 *        'param_name' => 'font_container',
 *        'value'=>'',
 *        'settings'=>array(
 *            'fields'=>array(
 *                'tag'=>'h2',
 *                'text_align',
 *                'font_size',
 *                'line_height',
 *                'color',
 *
 *                'tag_description' => __('Select element tag.','js_composer'),
 *                'text_align_description' => __('Select text alignment.','js_composer'),
 *                'font_size_description' => __('Enter font size.','js_composer'),
 *                'line_height_description' => __('Enter line height.','js_composer'),
 *                'color_description' => __('Select color for your element.','js_composer'),
 *            ),
 *        ),
 *    ),
 */
function essence_core_VC_MAP_FunFact2()
{
    global $ts_vc_anim_effects_in, $elegant_icons;
    vc_map(
        array(
            'name'     => esc_html__( 'Essence Core Fun Fact 2', 'essence-core' ),
            'base'     => 'essence_core_fun_fact2', // shortcode
            'class'    => '',
            'category' => __( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Style', 'essence-core' ),
                    'param_name' => 'style',
                    'value'      => array(
                        esc_html__( 'Style 1', 'essence-core' ) => 'style1',
                        esc_html__( 'Style 2', 'essence-core' ) => 'style2',
                    ),
                    'std'        => 'style1',
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Align', 'essence-core' ),
                    'param_name' => 'align',
                    'value'      => array(
                        esc_html__( 'Left', 'essence-core' )   => 'text-left',
                        esc_html__( 'Right', 'essence-core' )  => 'text-right',
                        esc_html__( 'Center', 'essence-core' ) => 'text-center',
                    ),
                    'std'        => 'text-left',
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Number', 'essence-core' ),
                    'param_name' => 'number',
                    'std'        => 3600,
                    'group'      => esc_html__( 'Number', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'number_font_style',
                    'value'      => 'color:#000|font_size:48px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => __( 'Enter font size.', 'essence-core' ),
                            'color_description'     => __( 'Select number color.', 'essence-core' ),
                        ),
                    ),
                    'group'      => esc_html__( 'Number', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Unit', 'essence-core' ),
                    'param_name' => 'unit',
                    'std'        => '',
                    'group'      => esc_html__( 'Unit', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'unit_font_style',
                    'value'      => 'color:#000|font_size:48px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => __( 'Enter font size.', 'essence-core' ),
                            'color_description'     => __( 'Select unit color.', 'essence-core' ),
                        ),
                    ),
                    'group'      => esc_html__( 'Unit', 'essence-core' ),
                ),
                array(
                    'type'       => 'textarea',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Title', 'essence-core' ),
                    'param_name' => 'title',
                    'std'        => __( 'Clients', 'essence-core' ),
                    'group'      => esc_html__( 'Title', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'title_font_style',
                    'value'      => 'color:#999|font_size:48px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => __( 'Enter font size.', 'essence-core' ),
                            'color_description'     => __( 'Select title color.', 'essence-core' ),
                        ),
                    ),
                    'group'      => esc_html__( 'Title', 'essence-core' ),
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
                    'group'      => esc_html__( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'icon_font_style',
                    'value'      => 'color:#999|font_size:30px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => __( 'Enter font size.', 'essence-core' ),
                            'color_description'     => __( 'Select icon color.', 'essence-core' ),
                        ),
                    ),
                    'group'      => esc_html__( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'CSS Animation', 'essence-core' ),
                    'param_name' => 'css_animation',
                    'value'      => $ts_vc_anim_effects_in,
                    'std'        => 'fadeInUp',
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

function essence_core_fun_fact2( $atts )
{

    if ( !class_exists( 'Vc_Manager' ) ) {
        return '';
    }

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_fun_fact2', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'style'             => 'style1',
                'align'             => 'text-left',
                'number'            => 3600,
                'number_font_style' => '',
                'unit'              => '',
                'unit_font_style'   => '',
                'title'             => '',
                'title_font_style'  => '',
                'icon'              => '',
                'icon_font_style'   => '',
                'css_animation'     => '',
                'animation_delay'   => '0.4',   //In second
                'css'               => '',
            ), $atts
        )
    );


    $number_font_style = essence_core_get_font_container_style( $number_font_style );
    $unit_font_style = essence_core_get_font_container_style( $unit_font_style );
    $title_font_style = essence_core_get_font_container_style( $title_font_style );
    $icon_font_style = essence_core_get_font_container_style( $icon_font_style );

    $number = intval( $number );
    $unit = strip_tags( $unit );
    $title = sanitize_text_field( $title );
    $icon = esc_attr( $icon );

    $css_class = 'ts-funfact-wrap wow ' . $css_animation . ' ' . $style . ' ' . $align;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';

    $number = max( 1, intval( $number ) );

    $html = '';
    $number_html = '';
    $unit_html = '';
    $title_html = '';
    $icon_html = '';

    if ( trim( $number ) != '' ) {
        $number_html .= '<span class="funfact-number" data-number="' . $number . '" style="' . $number_font_style . '">' . $number . '</span>';
    }

    if ( trim( $unit ) != '' ) {
        $unit_html .= '<span class="funfact-unit" style="' . $unit_font_style . '">' . $unit . '</span>';
    }

    if ( trim( $title ) != '' ) {
        $title_html .= '<h5 class="funfact-number-title" style="' . $title_font_style . '">' . sanitize_text_field( $title ) . '</h5>';
    }

    if ( trim( $icon ) != '' ) {
        $icon_html .= '<span class="funfact-icon ' . $icon . '" style="' . $icon_font_style . '"></span>';
    }

    $html .= '<div class="ts-funfact">
				' . $icon_html . '
				' . $number_html . '
				' . $unit_html . '
				' . $title_html . '
			</div><!-- /.ts-funfact -->';

    $html = '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">
                ' . $html . '
            </div><!-- /.' . esc_attr( $css_class ) . ' -->';

    return $html;

}

add_shortcode( 'essence_core_fun_fact2', 'essence_core_fun_fact2' );
