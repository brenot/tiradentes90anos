<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_Services' );
function essence_core_VC_MAP_Services()
{
    global $ts_vc_anim_effects_in;
    vc_map(
        array(
            'name'     => esc_html__( 'Essence Core Services', 'essence-core' ),
            'base'     => 'essence_core_services', // shortcode
            'class'    => '',
            'category' => esc_html__( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Title', 'essence-core' ),
                    'param_name' => 'title',
                    'std'        => esc_html__( 'Our History', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'title_font_style',
                    'value'      => 'color:#999|font_size:48px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => __( 'Enter title font size.', 'essence-core' ),
                            'color_description'     => __( 'Select title color.', 'essence-core' ),
                        ),
                    ),
                    'dependency' => array(
                        'element'   => 'title',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'       => 'textarea',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Sub Title', 'essence-core' ),
                    'param_name' => 'subtitle',
                    'std'        => __( 'Brand Identity', 'essence-core' ),
                    'desc'       => __( 'If this filed is empty, it will hidden.', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'desc_font_style',
                    'value'      => 'color:#999|font_size:14px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => __( 'Enter sub title font size.', 'essence-core' ),
                            'color_description'     => __( 'Select sub title color.', 'essence-core' ),
                        ),
                    ),
                    'dependency' => array(
                        'element'   => 'subtitle',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'       => 'vc_link',
                    'param_name' => 'link',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Link', 'essence-core' ),
                ),
                array(
                    'type'        => 'param_group',
                    'heading'     => __( 'List Services', 'essence-core' ),
                    'param_name'  => 'list_services_group',
                    'description' => __( 'Enter values for graph - value, title and color.', 'essence-core' ),
                    'value'       => urlencode(
                        json_encode(
                            array(
                                array(
                                    'service_item' => __( 'Naming', 'essence-core' ),
                                ),
                                array(
                                    'service_item' => __( 'Brand Personality', 'essence-core' ),
                                ),
                                array(
                                    'service_item' => __( 'Logo creative', 'essence-core' ),
                                ),
                                array(
                                    'service_item' => __( 'Visual identity sytem', 'essence-core' ),
                                ),
                                array(
                                    'service_item' => __( 'Corporate brand identity', 'essence-core' ),
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
                            'heading'     => __( 'Service item', 'essence-core' ),
                            'param_name'  => 'service_item',
                            'description' => __( 'Enter service item.', 'essence-core' ),
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
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'essence-core' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'essence-core' ),
                ),
            ),
        )
    );
}

function essence_core_services( $atts, $content = null )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_services', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(

                'title'               => '',
                'title_font_style'    => '',
                'subtitle'            => '',
                'subtitle_font_style' => '',
                'link'                => '',
                'list_services_group' => '',
                'css_animation'       => '',
                'animation_delay'     => '0.4',   //In second
                'css'                 => '',
            ), $atts
        )
    );
    $title_font_style = essence_core_get_font_container_style( $title_font_style );
    $subtitle_font_style = essence_core_get_font_container_style( $subtitle_font_style );

    $list_services_group = (array) vc_param_group_parse_atts( $list_services_group );
    $item_default = array(
        'service_item' => '',
    );

    $link_default = array(
        'url'    => '',
        'title'  => '',
        'target' => '',
    );

    if ( function_exists( 'vc_build_link' ) ):
        $link = vc_build_link( $link );
    else:
        $link = $link_default;
    endif;

    $css_class = 'essence-services wow ' . $css_animation;

    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';

    $html = $befor_a = $after_a = $subtitle_html = $title_html = '';

    if ( trim( $title ) != '' ) {
        $title_html .= '<h2 style="' . $title_font_style . '">' . sanitize_text_field( $title ) . '</h2>';
    }
    if ( trim( $subtitle ) != '' ) {
        $subtitle_html .= '<h3 style="' . $subtitle_font_style . '">' . sanitize_text_field( $subtitle ) . '</h3>';
    }
    if ( trim( $link[ 'url' ] ) != '' ) {
        $befor_a .= '<a href="' . esc_url( $link[ 'url' ] ) . '" target="' . esc_attr( $link[ 'target' ] ) . '">';
        $after_a .= '</a>';
    }


    $html .= '<div class="ts-cart-visiter">
                ' . $title_html . '
                ' . $befor_a . '
                ' . $subtitle_html . '
                ' . $after_a . '
                <ul class="list-visit">';
    foreach ( $list_services_group as $item ) :

        $item = wp_parse_args( $item, $item_default );

        $html .= '<li>' . sanitize_text_field( $item[ 'service_item' ] ) . '</li>';
    endforeach;
    $html .= '    </ul>

            </div>';

    $html = '<div class="' . $css_class . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">' . $html . '</div>';

    return $html;

}

add_shortcode( 'essence_core_services', 'essence_core_services' );
