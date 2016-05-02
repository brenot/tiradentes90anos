<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'vc_before_init', 'essence_core_bulletsList' );
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
 *                'tag_description' => esc_html__('Select element tag.','js_composer'),
 *                'text_align_description' => esc_html__('Select text alignment.','js_composer'),
 *                'font_size_description' => esc_html__('Enter font size.','js_composer'),
 *                'line_height_description' => esc_html__('Enter line height.','js_composer'),
 *                'color_description' => esc_html__('Select color for your element.','js_composer'),
 *            ),
 *        ),
 *    ),
 */
function essence_core_bulletsList()
{
    global $elegant_icons, $ts_vc_anim_effects_in;
    vc_map(
        array(
            'name'     => esc_html__( 'Essence Core Bullets List', 'essence-core' ),
            'base'     => 'essence_core_bullets_list',
            'class'    => '',
            'category' => esc_html__( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'        => 'exploded_textarea',
                    'value'       => 'arrow_triangle-right_alt2|Creative template|http://essence.themestudio.net|_self',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'List', 'essence-core' ),
                    'param_name'  => 'list',
                    'description' => __( 'Input list items here. Divide each item by linebreaks (Enter). <br /> An item fllowing this structure: {icon (or number)}|{item text}|{item link}|{link_target}. <br /> For icons, you can use font <a href="http://fontawesome.io/icons/" target="__blank">Awesome</a> icon or <a href="http://www.elegantthemes.com/blog/resources/elegant-icon-font" target="__blank">Elegant</a> font icon.', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'bullets_font_style',
                    'value'      => 'color:#00cccc|font_size:15px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => esc_html__( 'Enter bullets font size. Default: 15px.', 'essence-core' ),
                            'color_description'     => esc_html__( 'Select bullets color.', 'essence-core' ),
                        ),
                    ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'text_font_style',
                    'value'      => 'color:#a4b1ba|font_size:15px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => esc_html__( 'Enter text font size. Default: 16px.', 'essence-core' ),
                            'color_description'     => esc_html__( 'Select text color.', 'essence-core' ),
                        ),
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
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Custom Class', 'essence-core' ),
                    'param_name'  => 'custom_class',
                    'std'         => '',
                    'description' => esc_html__( 'Custom class for bullets list.', 'essence-core' ),
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

function essence_core_bullets_list( $atts )
{
    if ( !class_exists( 'Vc_Manager' ) ) {
        return '';
    }

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_bullets_list', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'list'               => '',
                'bullets_font_style' => '',
                'text_font_style'    => '',
                'css_animation'      => '',
                'animation_delay'    => '0.4',   //In second
                'custom_class'       => '',   //In second
                'css'                => '',
            ), $atts
        )
    );

    $bullets_font_style = essence_core_get_font_container_style( $bullets_font_style );
    $text_font_style = essence_core_get_font_container_style( $text_font_style );

    $css_class = 'bullet-list-wrap '. $custom_class .' wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';

    $list_args = explode( ',', $list );

    $html = '';

    if ( !empty( $list_args ) ) {

        $html .= '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">';
        $html .= '<ul class="bullet-list list-style" style="' . $text_font_style . '">';
        foreach ( $list_args as $list_item ):

            $list_item_args = explode( '|', $list_item );
            $item_icon = isset( $list_item_args[ 0 ] ) ? $list_item_args[ 0 ] : '';
            $item_text = isset( $list_item_args[ 1 ] ) ? $list_item_args[ 1 ] : '';
            $item_url = isset( $list_item_args[ 2 ] ) ? $list_item_args[ 2 ] : '';
            $link_target = isset( $list_item_args[ 3 ] ) ? $list_item_args[ 3 ] : '_self';

            $has_icon_class = trim( $item_icon ) != '' ? 'has-icon' : 'no-icon';

            if ( is_numeric( $item_icon ) ) {
                $item_icon = '<span class="bullet bullet-number" style="' . $bullets_font_style . '">' . $item_icon . '. </span>';
            }
            else {
                if ( trim( $item_icon ) != '' ) {
                    $item_icon = '<i class="bullet bullet-icon ' . esc_attr( $item_icon ) . '" style="' . $bullets_font_style . '"></i>';
                }
            }

            if ( trim( $item_text ) != '' ) {
                if ( trim( $item_url ) != '' ) {
                    $html .= '<li class="has-link ' . esc_attr( $has_icon_class ) . '" >' . $item_icon . '<a href="' . esc_url( $item_url ) . '" target="' . esc_attr( $link_target ) . '">' . $item_text . '</a></li>';
                }
                else {
                    $html .= '<li class="no-link ' . esc_attr( $has_icon_class ) . '" >' . $item_icon . $item_text . '</li>';
                }
            }

        endforeach;

        $html .= '</ul>';
        $html .= '</div><!-- /.' . esc_attr( $css_class ) . ' -->';

    }

    return $html;

}

add_shortcode( 'essence_core_bullets_list', 'essence_core_bullets_list' );