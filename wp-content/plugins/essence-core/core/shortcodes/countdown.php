<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'vc_before_init', 'essence_core_VC_MAP_countDown' );


function essence_core_VC_MAP_countDown()
{

    global $elegant_icons, $ts_vc_anim_effects_in, $ts_border_styles;

    vc_map(
        array(
            'name'              => esc_html__( 'Essence Core Count Down', 'essence-core' ),
            'base'              => 'essence_core_count_down',
            'class'             => '',
            'category'          => esc_html__( 'Essence', 'essence-core' ),
            'admin_enqueue_css' => ESSENCE_CORE_VENDORS_URL . 'bootstrap/css/bootstrap-for-datepicker.css',
            'front_enqueue_css' => ESSENCE_CORE_VENDORS_URL . 'bootstrap/css/bootstrap-for-datepicker.css',
            'params'            => array(
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Additional Class', 'essence-core' ),
                    'param_name'  => 'additional_class',
                    'std'         => '',
                    'description' => esc_html__( 'Additional Class. Ex: show_colon', 'essence-core' ),
                ),
                array(
                    'type'       => 'essence_core_datepicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Date', 'essence-core' ),
                    'param_name' => 'date',
                    'std'        => esc_html__( '', 'essence-core' ),
                    'group'      => esc_html__( 'Countdown Date', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'countdown_font_style',
                    'value'      => 'color:#ffffff|font_size:40px|line_height:40px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'line_height',
                            'font_size_description'   => esc_html__( 'Enter countdown numbers font size.', 'essence-core' ),
                            'color_description'       => esc_html__( 'Select countdown numbers color.', 'essence-core' ),
                            'line_height_description' => esc_html__( 'Enter countdown numbers line height.', 'essence-core' ),
                        ),
                    ),
                    'group'      => esc_html__( 'Countdown Date', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Countdown Number Border', 'essence-core' ),
                    'param_name' => 'countdown_number_border',
                    'value'      => $ts_border_styles,
                    'std'        => 'none',
                    'group'      => esc_html__( 'Countdown Date', 'essence-core' ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Border Color', 'essence-core' ),
                    'param_name'  => 'number_border_color',
                    'std'         => '#999999',
                    'description' => esc_html__( 'Color of countdown number border.', 'essence-core' ),
                    'group'       => esc_html__( 'Countdown Date', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Number Width', 'essence-core' ),
                    'param_name'  => 'countdown_number_width',
                    'std'         => 'auto',
                    'description' => esc_html__( 'Width in pixel of countdown numbers. Ex: auto or 90px.', 'essence-core' ),
                    'group'       => esc_html__( 'Countdown Date', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Number Height', 'essence-core' ),
                    'param_name'  => 'countdown_number_height',
                    'std'         => 'auto',
                    'description' => esc_html__( 'Height in pixel of countdown numbers. Ex: auto or 90px.', 'essence-core' ),
                    'group'       => esc_html__( 'Countdown Date', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Border Radius', 'essence-core' ),
                    'param_name'  => 'countdown_number_border_radius',
                    'std'         => '0',
                    'description' => esc_html__( 'Border radius of countdown numbers. Ex: 50% or 100px.', 'essence-core' ),
                    'group'       => esc_html__( 'Countdown Date', 'essence-core' ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Background Color', 'essence-core' ),
                    'param_name'  => 'countdown_number_bg_color',
                    'std'         => '',
                    'description' => esc_html__( 'Countdown numbers background color', 'essence-core' ),
                    'group'       => esc_html__( 'Countdown Date', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'text_font_style',
                    'value'      => 'color:#ffffff|font_size:14px|line_height:24px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'line_height',
                            'font_size_description'   => esc_html__( 'Enter font size of days, hours... text.', 'essence-core' ),
                            'color_description'       => esc_html__( 'Select color of days, hours... text.', 'essence-core' ),
                            'line_height_description' => esc_html__( 'Enter text line height.', 'essence-core' ),
                        ),
                    ),
                    'group'      => esc_html__( 'Countdown Text', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Days', 'essence-core' ),
                    'param_name' => 'days',
                    'std'        => esc_html__( 'Days', 'essence-core' ),
                    'group'      => esc_html__( 'Countdown Text', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Hours', 'essence-core' ),
                    'param_name' => 'hours',
                    'std'        => esc_html__( 'Hours', 'essence-core' ),
                    'group'      => esc_html__( 'Countdown Text', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Minutes', 'essence-core' ),
                    'param_name' => 'mins',
                    'std'        => esc_html__( 'Mins', 'essence-core' ),
                    'group'      => esc_html__( 'Countdown Text', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Seconds', 'essence-core' ),
                    'param_name' => 'secs',
                    'std'        => esc_html__( 'Secs', 'essence-core' ),
                    'group'      => esc_html__( 'Countdown Text', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'CSS Animation', 'essence-core' ),
                    'param_name' => 'css_animation',
                    'value'      => $ts_vc_anim_effects_in,
                    'std'        => 'fadeInUp',
                    'group'      => esc_html__( 'Design options', 'essence-core' ),
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

function essence_core_count_down( $atts )
{

    if ( !class_exists( 'Vc_Manager' ) ) {
        return '';
    }

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_count_down', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'additional_class'               => '', // For example: show_colon
                'date'                           => '', // info, success, warning, error, custom
                'countdown_font_style'           => '',
                'countdown_number_border'        => 'none',
                'number_border_color'            => '',
                'countdown_number_border_radius' => 0,
                'countdown_number_width'         => 'auto',
                'countdown_number_height'        => 'auto',
                'countdown_number_bg_color'      => '',
                'days'                           => '',
                'hours'                          => '',
                'mins'                           => '',
                'secs'                           => '',
                'text_font_style'                => '',
                'css_animation'                  => '',
                'animation_delay'                => '0.4',   //In second
                'css'                            => '',
            ), $atts
        )
    );

    $countdown_font_style = essence_core_get_font_container_style( $countdown_font_style );
    $text_font_style = essence_core_get_font_container_style( $text_font_style );

    $css_class = 'ts-countdown-wrap wow ' . $additional_class . ' ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';

    $number_style = '';

    $number_style .= $countdown_font_style . '; border: ' . esc_attr( $countdown_number_border ) . '; border-color: ' . esc_attr( $number_border_color ) . '; border-radius: ' . esc_attr( $countdown_number_border_radius ) . ';';
    $number_style .= ' width: ' . esc_attr( $countdown_number_width ) . '; height: ' . esc_attr( $countdown_number_height ) . ';';
    if ( trim( $countdown_number_bg_color ) != '' ) {
        $number_style .= ' background-color: ' . esc_attr( $countdown_number_bg_color ) . ';';
    }

    $html = '';

    $html .= '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">
                    <div data-time="' . esc_attr( $date ) . '" class="tr-countdown ts-countdown">
                        <div class="tr-countdown-content ts-countdown-content">
                            <div class="ts-datetime">
                                <span class="ts-cdown-days tr-countdown-time" style="' . $number_style . '">00</span>
                                <span class="text-date" style="' . $text_font_style . '"> ' . sanitize_text_field( $days ) . '</span>
                            </div>
                            <div class="ts-datetime">
                                <span class="ts-cdown-hours tr-countdown-time" style="' . $number_style . '">00</span>
                                <span class="text-date" style="' . $text_font_style . '"> ' . sanitize_text_field( $hours ) . '</span>
                            </div>
                            <div class="ts-datetime">
                                <span class="ts-cdown-minutes tr-countdown-time" style="' . $number_style . '">00</span>
                                <span class="text-date" style="' . $text_font_style . '"> ' . sanitize_text_field( $mins ) . '</span>
                            </div>
                            <div class="ts-datetime">
                                <span class="ts-cdown-seconds tr-countdown-time" style="' . $number_style . '">00</span>
                                <span class="text-date" style="' . $text_font_style . '"> ' . sanitize_text_field( $secs ) . '</span>
                            </div>
                        </div><!-- .ts-countdown-content -->
                    </div><!-- .ts-countdown -->
                </div>';

    return $html;
}

add_shortcode( 'essence_core_count_down', 'essence_core_count_down' );