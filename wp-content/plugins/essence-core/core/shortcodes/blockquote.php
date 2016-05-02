<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_BlockQuote' );
function essence_core_VC_MAP_BlockQuote()
{
    global $ts_vc_anim_effects_in;
    vc_map(
        array(
            'name'     => __( 'Essence Core Block Quote', 'essence-core' ),
            'base'     => 'essence_core_block_quote', // shortcode
            'class'    => '',
            'category' => __( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'class'      => '',
                    'heading'    => __( 'Style', 'essence-core' ),
                    'param_name' => 'style',
                    'value'      => array(
                        esc_html__( 'Style 1', 'essence-core' ) => 'blockquote-style1',
                        esc_html__( 'Style 2', 'essence-core' ) => 'blockquote-style2',
                        esc_html__( 'Style 3', 'essence-core' ) => 'blockquote-style3',
                        esc_html__( 'Style 4', 'essence-core' ) => 'blockquote-style4',
                    ),
                    'std'        => 'blockquote-style1',
                ),
                array(
                    'type'       => 'textarea',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Quote', 'essence-core' ),
                    'param_name' => 'quote',
                    'std'        => esc_html__( 'Meh synth Schlitz, tempor duis single-origin coffee eate next level ethnic finogerstache fanny pack nostrud. Vladimar adsine crostine. Salvia essentia nihil, flest pritarian Truffaut.', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Cite', 'essence-core' ),
                    'param_name' => 'cite',
                    'std'        => 'THEME-STUDIO',
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
                    'group'      => esc_html__( 'Design options', 'essence-core' ),
                ),
            ),
        )
    );
}

function essence_core_block_quote( $atts )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_block_quote', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'style'           => 'blockquote-style1',
                'quote'           => '',
                'cite'            => '',
                'css_animation'   => '',
                'animation_delay' => '0.4',   //In second
                'css'             => '',
            ), $atts
        )
    );

    $css_class = 'blockquote wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';

    $html = '';

    $css_class .= ' ' . $style;

    $html .= '<blockquote class="' . $css_class . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">
					<p>' . sanitize_text_field( $quote ) . '</p>
					<cite class="author-quote">' . sanitize_text_field( $cite ) . '</cite>
				</blockquote>';

    return $html;

}

add_shortcode( 'essence_core_block_quote', 'essence_core_block_quote' );
