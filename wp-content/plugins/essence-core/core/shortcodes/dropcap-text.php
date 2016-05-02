<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'vc_before_init', 'essence_core_VC_MAP_DopcapText' );
function essence_core_VC_MAP_DopcapText()
{
    global $ts_vc_anim_effects_in, $ts_border_styles;
    vc_map(
        array(
            'name'     => esc_html__( 'Essence Core Dropcap Text', 'essence-core' ),
            'base'     => 'essence_core_dropcap_text', // shortcode
            'class'    => '',
            'category' => esc_html__( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'        => 'textarea',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Text', 'essence-core' ),
                    'param_name'  => 'text_desc',
                    'std'         => esc_html__( 'periam ratione officiis fuga, nesciunt? Netus integer, alias mollis ultricies et aperiam osuere dui vehicula possimus fusce.Neque harum nostrud quam sapiente voluptas volutpat landitiis pretium nibh nisl taciti nam Blanditiis pretium nibh nisl taciti nam, auctor aut recusandae totam nascetur proident nesciunt nisl illum deserunt temporibus? Nibh quidem, sed felis, commodo aliquam sagittis dui etiam unde possimus, earum voluptatum! Sociosqu conubia. Pulvinar autem? Dui molestiae iste iure, ratione parturient', 'essence-core' ),
                    'description' => esc_html__( '', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'dropcap_font_style',
                    'value'      => 'color:#333333|font_size:60px|line_height:60px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'line_height',
                            'font_size_description'   => esc_html__( 'Enter dropcap font size.', 'essence-core' ),
                            'color_description'       => esc_html__( 'Select dropcap color.', 'essence-core' ),
                            'line_height_description' => esc_html__( 'Enter dropcap line height.', 'js_composer' ),
                        ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Dropcap Width', 'essence-core' ),
                    'param_name' => 'dropcap_width',
                    'std'        => '60px',
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Dropcap Height', 'essence-core' ),
                    'param_name' => 'dropcap_height',
                    'std'        => '60px',
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Dropcap Bg Color', 'essence-core' ),
                    'param_name'  => 'dropcap_bg_color',
                    'std'         => '',
                    'description' => esc_html__( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Dropcap Border Radius', 'essence-core' ),
                    'param_name'  => 'dropcap_border_radius',
                    'std'         => '0',
                    'description' => esc_html__( 'Border radius unit is pixel', 'essence-core' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Dropcap Border Style', 'essence-core' ),
                    'param_name'  => 'dropcap_border_style',
                    'value'       => $ts_border_styles,
                    'std'         => 'none',
                    'description' => esc_html__( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Button Border width', 'essence-core' ),
                    'param_name'  => 'dropcap_border_width',
                    'std'         => '1',
                    'description' => esc_html__( 'Border width unit is pixel', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'dropcap_border_style',
                        'value'   => array( 'solid', 'dotted', 'dashed', 'hidden', 'double', 'groove', 'ridge', 'inset', 'outset' ),
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Dropcap Border Color', 'essence-core' ),
                    'param_name'  => 'dropcap_border_color',
                    'std'         => '#333333',
                    'description' => esc_html__( '', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'dropcap_border_style',
                        'value'   => array( 'solid', 'dotted', 'dashed', 'hidden', 'double', 'groove', 'ridge', 'inset', 'outset' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Dropcap Margin Right', 'essence-core' ),
                    'param_name'  => 'dropcap_margin_right',
                    'std'         => '',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Dropcap Margin Bottom', 'essence-core' ),
                    'param_name'  => 'dropcap_margin_bottom',
                    'std'         => '',
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'CSS Animation', 'essence-core' ),
                    'param_name'  => 'css_animation',
                    'value'       => $ts_vc_anim_effects_in,
                    'std'         => 'fadeInUp',
                    'description' => esc_html__( '', 'essence-core' ),
                    'group'       => esc_html__( 'Design options', 'essence-core' ),
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
                    'group'       => esc_html__( 'Design options', 'essence-core' ),
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


function essence_core_dropcap_text( $atts )
{
    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_dropcap_text', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'text_desc'             => '',
                'dropcap_font_style'    => '',
                'dropcap_width'         => '',
                'dropcap_height'        => '',
                'dropcap_bg_color'      => '',
                'dropcap_border_radius' => '',
                'dropcap_border_style'  => '',
                'dropcap_border_width'  => '',
                'dropcap_border_color'  => '',
                'dropcap_margin_right' => '',
                'dropcap_margin_bottom' => '',
                'css_animation'         => '',
                'animation_delay'       => '',
                'css'                   => '',
            ), $atts
        )
    );

    $dropcap_font_style = essence_core_get_font_container_style( $dropcap_font_style );
    $dropcap_width = trim( $dropcap_width ) == '' ? 'auto' : esc_attr( $dropcap_width );
    $dropcap_height = trim( $dropcap_width ) == '' ? 'auto' : esc_attr( $dropcap_height );
    $dropcap_font_style .= '; width: ' . $dropcap_width . '; height: ' . $dropcap_height . ';';

    $css_class = '';
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;
    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = '0';
    }
    $animation_delay = $animation_delay . 's';

    $html = '';
    $first_char_html = '';
    $remaining_text_html = '';

    $text_desc = trim( $text_desc );
    if ( $text_desc != '' ) {
        $first_char = substr( $text_desc, 0, 1 );
        $remaining_text_html = sanitize_text_field( substr( $text_desc, 1 ) );

        //$dropcap_style = 'font-size: ' . intval( $dropcap_font_size ) . 'px;';
        //$dropcap_style .= trim( $dropcap_color ) != '' ? ' color: ' . esc_attr( $dropcap_color ) . ';' : '';

        $dropcap_style = $dropcap_font_style;
        $dropcap_style .= trim( $dropcap_bg_color ) != '' ? ' background-color: ' . esc_attr( $dropcap_bg_color ) . ';' : '';
        $dropcap_style .= ' border-radius: ' . esc_attr( $dropcap_border_radius ) . 'px;';
        $dropcap_style .= trim( $dropcap_border_style ) != '' ? ' border-style: ' . esc_attr( $dropcap_border_style ) . ';' : '';
        $dropcap_style .= ' border-width: ' . esc_attr( $dropcap_border_width ) . 'px;';
        $dropcap_style .= trim( $dropcap_border_color ) != '' ? ' border-color: ' . esc_attr( $dropcap_border_color ) . ';' : '';
        $dropcap_style .= trim( $dropcap_margin_right ) != '' ? ' margin-right: ' . esc_attr( $dropcap_margin_right ) . ';' : '';
        $dropcap_style .= trim( $dropcap_margin_bottom ) != '' ? ' margin-bottom: ' . esc_attr( $dropcap_margin_bottom ) . ';' : '';

        $dropcap_style = 'style="' . $dropcap_style . '"';

        $first_char_html .= '<span class="dropcap" ' . $dropcap_style . ' >' . sanitize_text_field( $first_char ) . '</span>';

    }

    $html .= '<div class="text-dropcap wow ' . esc_attr( $css_animation . ' ' . $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">
                    <p>' . $first_char_html . $remaining_text_html . '</p>
                </div><!-- /.text-dropcap -->';

    return $html;

}

add_shortcode( 'essence_core_dropcap_text', 'essence_core_dropcap_text' );