<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_ContactInfo' );
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
function essence_core_VC_MAP_ContactInfo()
{
    global $ts_vc_anim_effects_in, $elegant_icons;
    vc_map(
        array(
            'name'     => esc_html__( 'Essence Core Contact Info', 'essence-core' ),
            'base'     => 'essence_core_contact_info', // shortcode
            'class'    => '',
            'category' => __( 'Essence', 'essence-core' ),
            'params'   => array(            	
            	array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Contact info type', 'essence-core' ),
                    'param_name'  => 'style',
                    'holder'      => 'div',
                    'value'       => array(
                        __( 'Contact Info Type 1', 'essence-core' )        => 'style1',
                        __( 'Contact Info Type 2', 'essence-core' )       => 'style2',                        
                    ),
                    'std'         => 'style1',
                    'description' => __( 'This is select type for contact info.', 'essence-core' ),
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
                    'desc'       => __( 'Select icon for contact info.If this filed is empty, it will hidden.', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'icon_font_style',
                    'value'      => 'color:#999|font_size:40px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => __( 'Enter icon font size.', 'essence-core' ),
                            'color_description'     => __( 'Select icon color.', 'essence-core' ),
                        ),
                    ),
                    'dependency' => array(
                        'element'   => 'icon',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Title', 'essence-core' ),
                    'param_name' => 'title',
                    'std'        => __( 'Clients', 'essence-core' ),
                    'desc'       => __( 'If this filed is empty, it will hidden.', 'essence-core' ),
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
                    'heading'    => __( 'Description', 'essence-core' ),
                    'param_name' => 'description',
                    'std'        => __( 'UNITED KINGDOM, LONDON', 'essence-core' ),
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
                            'font_size_description' => __( 'Enter description font size.', 'essence-core' ),
                            'color_description'     => __( 'Select description color.', 'essence-core' ),
                        ),
                    ),
                    'dependency' => array(
                        'element'   => 'description',
                        'not_empty' => true,
                    ),
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

function essence_core_contact_info( $atts )
{

    if ( !class_exists( 'Vc_Manager' ) ) {
        return '';
    }

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_contact_info', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'style'            => '',
                'icon'             => '',
                'icon_font_style'  => '',
                'title'            => '',
                'title_font_style' => '',
                'description'      => '',
                'desc_font_style'  => '',
                'css_animation'    => '',
                'animation_delay'  => '0.4',   //In second
                'css'              => '',
            ), $atts
        )
    );


    $icon_font_style = essence_core_get_font_container_style( $icon_font_style );
    $title_font_style = essence_core_get_font_container_style( $title_font_style );
    $description_font_style = essence_core_get_font_container_style( $desc_font_style );


    $title = sanitize_text_field( $title );
    $icon = esc_attr( $icon );

    $css_class = 'ts-contact-info ts-contact-info-'.esc_attr($style).'  wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';


    $html = '';
    $icon_html = '';
    $title_html = '';
    $description_html = '';


    if ( trim( $title ) != '' ) {
        $title_html .= '<h5 class="contact-info-title" style="' . $title_font_style . '">' . sanitize_text_field( $title ) . '</h5>';
    }
    if ( trim( $description ) != '' ) {
        $description_html .= '<div class="ts-contact-info-content" style="' . $description_font_style . '"><p>' . $description . '</p></div>';
    }
    if ( trim( $icon ) != '' ) {
        $icon_html .= '<span class="contact-info-icon ' . $icon . '" style="' . $icon_font_style . '"></span>';
    }

    $html .= '<div class="ts-contact-info-content-wrap">
                ' . $icon_html . '
                ' . $title_html . '
                ' . $description_html . '
            </div>';


    $html = '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">
                ' . $html . '
            </div><!-- /.' . esc_attr( $css_class ) . ' -->';

    return $html;

}

add_shortcode( 'essence_core_contact_info', 'essence_core_contact_info' );
