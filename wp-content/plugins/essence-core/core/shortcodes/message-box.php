<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'vc_before_init', 'essence_core_VC_MAP_messageBox' );
function essence_core_VC_MAP_messageBox()
{
    global $elegant_icons, $ts_vc_anim_effects_in;

    vc_map(
        array(
            'name'     => esc_html__( 'Essence Core Message Box', 'essence-core' ),
            'base'     => 'essence_core_message_box',
            'class'    => '',
            'category' => esc_html__( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Message Type', 'essence-core' ),
                    'param_name' => 'message_type',
                    'value'      => array(
                        esc_html__( 'Info', 'essence-core' )        => 'info',
                        esc_html__( 'Success', 'essence-core' )     => 'success',
                        esc_html__( 'Warning', 'essence-core' )     => 'warning',
                        esc_html__( 'Alert|Error', 'essence-core' ) => 'error',
                        esc_html__( 'Custom', 'essence-core' )      => 'custom',
                    ),
                    'std'        => 'success',
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Message', 'essence-core' ),
                    'param_name' => 'message',
                    'std'        => esc_html__( 'Notice message – Lorem ipsum dolores sit ame', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'message_font_style',
                    'value'      => 'color:#669900|font_size:25px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => esc_html__( 'Enter message font size.', 'essence-core' ),
                            'color_description'     => esc_html__( 'Select message color.', 'essence-core' ),
                        ),
                    ),
                    'dependency' => array(
                        'element' => 'message_type',
                        'value'   => 'custom',
                    ),
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
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'icon_font_style',
                    'value'      => 'color:#669900|font_size:25px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => esc_html__( 'Enter icon font size.', 'essence-core' ),
                            'color_description'     => esc_html__( 'Select icon color.', 'essence-core' ),
                        ),
                    ),
                    'dependency' => array(
                        'element' => 'message_type',
                        'value'   => 'custom',
                    ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Icon Background Color', 'essence-core' ),
                    'param_name' => 'icon_bg_color',
                    'std'        => '#669900',
                    'dependency' => array(
                        'element'   => 'icon_font_style',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Border', 'essence-core' ),
                    'param_name' => 'border',
                    'value'      => array(
                        esc_html__( 'None', 'essence-core' )  => 'none',
                        esc_html__( 'Solid', 'essence-core' ) => 'solid',
                    ),
                    'std'        => 'none',
                    'dependency' => array(
                        'element' => 'message_type',
                        'value'   => 'custom',
                    ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Border Color', 'essence-core' ),
                    'param_name' => 'border_color',
                    'std'        => '#669900',
                    'dependency' => array(
                        'element' => 'message_type',
                        'value'   => 'custom',
                    ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Background Color', 'essence-core' ),
                    'param_name' => 'bg_color',
                    'std'        => '',
                    'dependency' => array(
                        'element' => 'message_type',
                        'value'   => 'custom',
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Show Close Button', 'essence-core' ),
                    'param_name' => 'show_close_btn',
                    'value'      => array(
                        esc_html__( 'Yes', 'essence-core' ) => 'yes',
                        esc_html__( 'No', 'essence-core' )  => 'no',
                    ),
                    'std'        => 'no',
                    'dependency' => array(
                        'element' => 'message_type',
                        'value'   => 'custom',
                    ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Close Button Color', 'essence-core' ),
                    'param_name' => 'close_btn_color',
                    'std'        => '',
                    'dependency' => array(
                        'element' => 'message_type',
                        'value'   => 'custom',
                    ),
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

function essence_core_message_box( $atts )
{

    if ( !class_exists( 'Vc_Manager' ) ) {
        return '';
    }

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_message_box', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'message_type'       => 'success', // info, success, warning, error, custom
                'message'            => '',
                'message_font_style' => '',
                'icon'               => '',
                'icon_font_style'    => '',
                'icon_bg_color'      => '#669900',
                'border'             => '',
                'border_color'       => '#669900',
                'bg_color'           => '#f0f6e7',
                'show_close_btn'     => 'no',
                'close_btn_color'    => '',
                'css_animation'      => '',
                'animation_delay'    => '0.4',   //In second
                'css'                => '',
            ), $atts
        )
    );

    $message_font_style = essence_core_get_font_container_style( $message_font_style );
    $icon_font_style = essence_core_get_font_container_style( $icon_font_style );
    $show_close_btn = trim( $show_close_btn ) == 'yes';

    $css_class = 'ts-message tr-message wow ' . $css_animation . ' ' . $message_type;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';

    $custom_type = $message_type == 'custom';

    $html = '';
    $icon_html = '';
    $close_btn_html = '';

    if ( $show_close_btn ) {
        $close_btn_style = trim( $close_btn_color ) != '' ? 'color: ' . esc_attr( $close_btn_color ) . '; ' : 'color: inherit';
        $close_btn_html .= '<span class="tr-message-close icon_close" style="' . $close_btn_style . '"></span>';
    }

    if ( $custom_type ) {

        $css_class .= ' custom-message';

        if ( trim( $icon_bg_color ) != '' ) {
            $icon_font_style .= '; background-color: ' . esc_attr( $icon_bg_color ) . ';';
        }

        if ( trim( $border ) != 'none' ) {
            $css_class .= ' has-border';
        }

        $html_style = ' border: ' . esc_attr( $border ) . '; border-color: ' . esc_attr( $border_color ) . '; border-width: 1px; background-color: ' . esc_attr( $bg_color ) . ';';
        $icon_font_style .= '; border-right: ' . esc_attr( $border ) . '; border-color: ' . esc_attr( $border_color ) . '; border-width: 1px;';

        if ( trim( $icon ) != '' ) {
            $icon_html .= '<span class="tr-contnet-message message" style="' . $message_font_style . '">' . sanitize_text_field( $message ) . '</span>';
        }

        $html .= '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '" style="' . $html_style . '">
                	<span class="tr-message-icon ' . esc_attr( $icon ) . '" style="' . $icon_font_style . '"></span>
                	' . $icon_html . '
                	' . $close_btn_html . '
	            </div>';

    }
    else {
        if ( trim( $icon ) != '' ) {
            $icon_html .= '<span class="tr-contnet-message message">' . sanitize_text_field( $message ) . '</span>';
        }
        $html .= '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">
                	<span class="tr-message-icon ' . esc_attr( $icon ) . '" style=""></span>
                	' . $icon_html . '
                	' . $close_btn_html . '
	            </div>';
    }

    return $html;
}

add_shortcode( 'essence_core_message_box', 'essence_core_message_box' );




