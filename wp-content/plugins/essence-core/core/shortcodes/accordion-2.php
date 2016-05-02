<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'vc_before_init', 'essence_core_VC_MAP_Accordion2' );
function essence_core_VC_MAP_Accordion2()
{
    global $ts_vc_anim_effects_in, $elegant_icons;
    vc_map(
        array(
            'name'                    => __( 'Essence Core Accordion 2', 'essence-core' ),
            'base'                    => 'essence_core_accordion2',
            'show_settings_on_create' => true,
            'is_container'            => true,
            'icon'                    => 'icon-wpb-ui-tab-content',
            'category'                => __( 'Essence', 'essence-core' ),
            'params'                  => array(
                array(
                    'type'          => 'dropdown',
                    'class'         => '',
                    'heading'       => __( 'Accordion Style', 'essence-core' ),
                    'param_name'    => 'style',
                    'value' => array(
                        __( 'Type 1', 'essence-core' ) => 'accordion-style1',
                        __( 'Type 2', 'essence-core' ) => 'accordion-style2'            
                    ),
                    'std'           => 'accordion-style1'
                ),
                array(
                    'type'        => 'param_group',
                    'heading'     => __( 'Accordion Group', 'essence-core' ),
                    'param_name'  => 'essence_accordion_group',
                    'description' => __( 'Enter values for graph - value, title and color.', 'essence-core' ),
                    'value'       => urlencode(
                        json_encode(
                            array(
                                array(
                                    'accordion_title' => __( 'Development', 'essence-core' ),
                                ),
                                array(
                                    'accordion_title' => __( 'Design', 'essence-core' ),
                                ),
                                array(
                                    'accordion_title' => __( 'Marketing', 'essence-core' ),
                                ),
                            )
                        )
                    ),
                    'params'      => array(
                        array(
                            'type'        => 'textfield',
                            'class'       => '',
                            'holder'      => 'div',
                            'admin_label' => true,
                            'heading'     => __( 'Title Accordion', 'essence-core' ),
                            'param_name'  => 'accordion_title',
                            'description' => __( 'Enter text used as title of bar.', 'essence-core' ),
                        ),
                        array(
                            'type'       => 'iconpicker',
                            'holder'     => 'div',
                            'class'      => '',
                            'heading'    => __( 'Icon', 'essence-core' ),
                            'param_name' => 'accordion_icon',
                            'settings'   => array(
                                'emptyIcon' => true, // default true, display an "EMPTY" icon?
                                'type'      => 'elegant',
                                'source'    => $elegant_icons,
                            ),
                        ),
                        array(
                            'type'        => 'textarea',
                            'class'       => '',
                            'heading'     => __( 'Content', 'essence-core' ),
                            'param_name'  => 'accordion_content',
                            'description' => __( 'Select custom single bar text color.', 'essence-core' ),
                            'std'         => '',
                        ),
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
                    'heading'    => __( 'Css', 'essence-core' ),
                    'param_name' => 'css',
                    'group'      => __( 'Design options', 'essence-core' ),
                ),
            ),
        )
    );
}

function essence_core_accordion2( $atts )
{
    $essence_accordion_group = $html = '';
    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_accordion2', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'essence_accordion_group' => '',
                'style'                 => '',
                'css_animation'         => '',
                'animation_delay'       => '0.4',  // In second
                'css'                   => '',
            ), $atts
        )
    );
    $css_class = 'ts-accordion wow ' . $css_animation.' '. $style;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';


    $essence_accordion_group = (array) vc_param_group_parse_atts( $essence_accordion_group );

    $html .= '<div class="' . esc_attr( $css_class ) . ' ts-acordion-data ts-acordion-right" data-icon-header="ts-plus" data-active="ts-minus" data-tab="0" data-wow-delay="' . esc_attr( $animation_delay ) . '">';

    $item_default = array(
        'accordion_title'   => '',
        'accordion_icon'    => '',
        'accordion_content' => '',
    );

    foreach ( $essence_accordion_group as $item ) :

        $item = wp_parse_args( $item, $item_default );

        $html .= '<h5>';
        if ( trim( $item[ 'accordion_icon' ] ) != '' ) {
            $html .= '<span class="icon-basic ' . esc_attr( $item[ 'accordion_icon' ] ) . '"></span>';
        }
        $html .= sanitize_text_field( $item[ 'accordion_title' ] ) . '</h5>';
        $html .= '<div class="acordion-content">';
        $html .= apply_filters( 'the_content', $item[ 'accordion_content' ] );
        $html .= '</div><!-- .acordion-content -->';

    endforeach;

    $html .= '</div>';

    return $html;

}

add_shortcode( 'essence_core_accordion2', 'essence_core_accordion2' );