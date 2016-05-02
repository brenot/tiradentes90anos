<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'vc_before_init', 'essence_core_VC_MAP_Button' );
function essence_core_VC_MAP_Button()
{
    global $ts_vc_anim_effects_in, $elegant_icons;
    vc_map(
        array(
            'name'     => __( 'Essence Button', 'essence-core' ),
            'base'     => 'essence_core_button', // shortcode
            'class'    => '',
            'category' => __( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Hover Animation Effect', 'essence-core' ),
                    'param_name'  => 'style',
                    'value'       => array(
                        __( 'Default', 'essence-core' ) => 'button-default',
                        __( 'Outline', 'essence-core' ) => 'button-outline',
                        __( '3D', 'essence-core' )      => 'button-3d',
                    ),
                    'std'         => 'button-default',
                    'description' => __( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Button Size', 'essence-core' ),
                    'param_name'  => 'button_size',
                    'holder'      => 'div',
                    'value'       => array(
                        __( 'Mini', 'essence-core' )        => 'mini-button',
                        __( 'Small', 'essence-core' )       => 'small-button',
                        __( 'Medium', 'essence-core' )      => 'medium-button',
                        __( 'Large', 'essence-core' )       => 'large-button',
                        __( 'Extra Large', 'essence-core' ) => 'extra-button',
                    ),
                    'std'         => 'medium-button',
                    'description' => __( 'This is select size button', 'essence-core' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Style', 'essence-core' ),
                    'param_name'  => 'hover_effect',
                    'value'       => array(
                        __( 'Default', 'essence-core' )                             => '',
                        __( 'Bg Color Fill To Right', 'essence-core' )              => 'button-hover-1',
                        __( 'Emerge', 'essence-core' )                              => 'button-hover-2',
                        __( 'Downward + Bg Color Fill To Bottom', 'essence-core' )  => 'button-hover-3',
                        __( 'Oscillate', 'essence-core' )                           => 'button-hover-4',
                        __( 'Bg Color Fill To Bottom + Show Icon', 'essence-core' ) => 'button-hover-5',
                        __( 'Oscillate + Show Icon', 'essence-core' )               => 'button-hover-6',
                        __( 'Bg Color Fill To Bottom', 'essence-core' )             => 'button-hover-7',
                        __( 'Small Scale', 'essence-core' )                         => 'button-hover-8',
                        __( 'Expand To Right', 'essence-core' )                     => 'button-hover-9',
                        __( 'Running Cross', 'essence-core' )                       => 'button-hover-10',
                        __( 'Bg Color Vertical Expansion', 'essence-core' )         => 'button-hover-11',
                        __( 'Bg Color Horizontal Expansion', 'essence-core' )       => 'button-hover-12',
                    ),
                    'std'         => '',
                    'description' => __( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Icon', 'essence-core' ),
                    'param_name'  => 'icon',
                    'settings'    => array(
                        'emptyIcon' => true, // default true, display an "EMPTY" icon?
                        'type'      => 'linea',
                        'source'    => $elegant_icons,
                    ),
                    'description' => __( 'Select icon from library.', 'essence-core' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Postion icon', 'essence-core' ),
                    'param_name'  => 'icon_align',
                    'holder'      => 'div',
                    'value'       => array(
                        __( 'Icon left', 'essence-core' )  => 'icon-left',
                        __( 'Icon right', 'essence-core' ) => 'icon-right',
                    ),
                    'std'         => 'icon-left',
                    'description' => __( 'This is select postion icon button', 'essence-core' ),
                    'dependency'  => array(
                        'element'   => 'icon',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Button Text', 'essence-core' ),
                    'param_name'  => 'button_text',
                    'std'         => __( 'I\'m Button', 'essence-core' ),
                    'description' => __( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Button Link', 'essence-core' ),
                    'param_name'  => 'button_link',
                    'std'         => '#',
                    'description' => __( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Button Link Target', 'essence-core' ),
                    'param_name'  => 'link_target',
                    'value'       => array(
                        __( '_self', 'essence-core' )   => '_self',
                        __( '_blank', 'essence-core' )  => '_blank',
                        __( '_parent', 'essence-core' ) => '_parent',
                        __( '_top', 'essence-core' )    => '_top',
                    ),
                    'std'         => '_self',
                    'description' => __( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Button Text Color', 'essence-core' ),
                    'param_name'  => 'btn_text_color',
                    'std'         => '#fff',
                    'description' => __( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Button Text Hover Color', 'essence-core' ),
                    'param_name'  => 'btn_text_hover_color',
                    'std'         => 'rgb(170, 157, 113)',
                    'description' => __( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Button Border Radius', 'essence-core' ),
                    'param_name'  => 'btn_border_radius',
                    'std'         => '0',
                    'description' => __( 'Border radius unit is pixel', 'essence-core' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Button Border Style', 'essence-core' ),
                    'param_name'  => 'btn_border_style',
                    'value'       => array(
                        __( 'none', 'essence-core' )    => 'none',
                        __( 'hidden', 'essence-core' )  => 'hidden',
                        __( 'dotted', 'essence-core' )  => 'dotted',
                        __( 'dashed', 'essence-core' )  => 'dashed',
                        __( 'solid', 'essence-core' )   => 'solid',
                        __( 'double', 'essence-core' )  => 'double',
                        __( 'groove', 'essence-core' )  => 'groove',
                        __( 'ridge', 'essence-core' )   => 'ridge',
                        __( 'inset', 'essence-core' )   => 'inset',
                        __( 'outset', 'essence-core' )  => 'outset',
                        __( 'initial', 'essence-core' ) => 'initial',
                        __( 'inherit', 'essence-core' ) => 'inherit',
                    ),
                    'std'         => 'solid',
                    'description' => __( '', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'button-outline' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Button Border width', 'essence-core' ),
                    'param_name'  => 'btn_border_width',
                    'std'         => '2',
                    'description' => __( 'Border width unit is pixel', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'button-outline' ),
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Button Border Color', 'essence-core' ),
                    'param_name'  => 'btn_border_color',
                    'std'         => '#fff',
                    'description' => __( '', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'button-outline' ),
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Button Bg Color', 'essence-core' ),
                    'param_name'  => 'btn_bg_color',
                    'std'         => '#aa9d71',
                    'description' => __( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Button Bg Hover Color', 'essence-core' ),
                    'param_name'  => 'btn_bg_hover_color',
                    'std'         => '#000',
                    'description' => __( '', 'essence-core' ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Button Shadow Color', 'essence-core' ),
                    'param_name'  => 'btn_shadow_color',
                    'std'         => '#887d55',
                    'description' => __( '', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'button-3d' ),
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Button Shadow Hover Color', 'essence-core' ),
                    'param_name'  => 'btn_shadow_hover_color',
                    'std'         => '#96af8a',
                    'description' => __( '', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'button-3d' ),
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

function essence_core_button( $atts )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_button', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'style'                  => '',
                'button_size'            => '',
                'hover_effect'           => '',
                'icon'                   => '',
                'icon_align'             => '',
                'text_color'             => '',
                'button_text'            => '',
                'button_link'            => '',
                'link_target'            => '',
                'btn_text_color'         => '',
                'btn_text_hover_color'   => '',
                'btn_bg_color'           => '',
                'btn_bg_hover_color'     => '',
                'btn_border_radius'      => '',
                'btn_border_width'       => '',
                'btn_border_color'       => '',
                'btn_border_style'       => '',
                'btn_shadow_color'       => '',
                'btn_shadow_hover_color' => '',
                'css'                    => '',
            ), $atts
        )
    );

    $css_class = $button_size . ' ' . $style . ' ' . $hover_effect;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    $btn_attrs = 'data-bg="' . esc_attr( $btn_bg_color ) . '" data-color="' . esc_attr( $btn_text_color ) . '" data-hoverbg="' . esc_attr( $btn_bg_hover_color ) . '" data-colorhover="' . esc_attr( $btn_text_hover_color ) . '"';

    $html = '';
    $icon_html = trim( $icon ) != '' ? '<span class="ts-icon-button"><span class="' . esc_attr( $icon ) . '"></span></span>' : '';
    $btn_html = '';
    $btn_style = '';
    $btn_style .= 'border-radius: ' . intval( $btn_border_radius ) . 'px;';
    if ( trim( $style ) == 'button-outline' ) {
        $btn_style .= trim( $btn_border_style ) != '' ? ' border-style: ' . esc_attr( $btn_border_style ) . '; border-color: ' . esc_attr( $btn_border_color ) . '; border-witdh: ' . intval( $btn_border_width ) . 'px;' : '';
    }
    if ( trim( $style ) == 'button-3d' ) {
        $btn_attrs .= ' data-colorshadow="' . esc_attr( $btn_shadow_color ) . '" data-shadowhover="' . esc_attr( $btn_shadow_hover_color ) . '"';
    }

    $btn_style = 'style="' . $btn_style . '"';

    $btn_html .= '<a href="' . esc_url( $button_link ) . '" class="ts-button-shortcode ' . esc_attr( $css_class ) . ' ' . esc_attr( $icon_align ) . '" ' . $btn_attrs . ' ' . $btn_style . '>
    					' . $icon_html . '
    					<span class="ts-button-hover"></span>
    					<span class="ts-button-text">' . sanitize_text_field( $button_text ) . '</span>
    				</a>';

    $html .= $btn_html;

    return $html;
}

add_shortcode( 'essence_core_button', 'essence_core_button' );
?>