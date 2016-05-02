<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_Separator' );
function essence_core_VC_MAP_Separator()
{
    global $ts_vc_anim_effects_in, $ts_border_styles, $elegant_icons;
    vc_map(
        array(
            'name'     => esc_html__( 'Essence Core Separator With Text', 'essence-core' ),
            'base'     => 'essence_core_separator', // shortcode
            'class'    => '',
            'category' => esc_html__( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Title', 'essence-core' ),
                    'param_name' => 'title',
                    'std'        => esc_html__( 'Separators', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Short Description', 'essence-core' ),
                    'param_name' => 'short_desc',
                    'std'        => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in urna eu mi egestas laciniance vitae at dui. Aliquam erat volutpat. Etiam dignissim condimentum egestas.', 'essence-core' ),
                ),
                array(
                    'type'       => 'vc_link',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Link', 'essence-core' ),
                    'param_name' => 'link',
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Type', 'essence-core' ),
                    'param_name' => 'sep_type',
                    'value'      => array(
                        esc_html__( 'Solid', 'essence-core' )        => 'tr-devider-line',
                        esc_html__( 'Dashed', 'essence-core' )       => 'tr-devider-dashed',
                        esc_html__( 'Dotted', 'essence-core' )       => 'tr-devider-dotted',
                        esc_html__( 'Double', 'essence-core' )       => 'tr-devider-double',
                        esc_html__( 'Shadow', 'essence-core' )       => 'tr-devider-shadow',
                        esc_html__( 'Icon', 'essence-core' )         => 'tr-devider-icon',
                        esc_html__( 'No Separator', 'essence-core' ) => 'tr-devider-no-separator',
                    ),
                    'std'        => 'tr-devider-line',
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
                    'std'        => 'icon-elegant arrow_carrot-up',
                    'dependency' => array(
                        'element' => 'sep_type',
                        'value'   => array( 'tr-devider-icon' ),
                    ),
                ),
                array(
                    'type'       => 'checkbox',
                    'param_name' => 'apply_link_to_icon',
                    'heading'    => esc_html__( 'Apply Link To Icon', 'essence-core' ),
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

function essence_core_separator( $atts )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_separator', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'title'              => '',
                'short_desc'         => '',
                'link'               => '',
                'sep_type'           => 'tr-devider-line',
                'icon'               => 'icon-elegant arrow_carrot-up',
                'apply_link_to_icon' => '',
                'css'                => '',
            ), $atts
        )
    );

    $css_class = 'tr-devider ' . $sep_type;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    $link_default = array(
        'url'    => '',
        'title'  => '',
        'target' => '_self',
    );

    if ( function_exists( 'vc_build_link' ) ):
        $link = vc_build_link( $link );
    else:
        $link = $link_default;
    endif;

    $html = '';
    $title_html = '';
    $desc_html = trim( $short_desc ) != '' ? '<p class="devider-desct">' . sanitize_text_field( $short_desc ) . '</p>' : '';
    //$icon_html = trim( $sep_type ) == 'tr-devider-icon' && trim( $icon ) != '' ? '<span class="' . esc_attr( $icon ) . '"></span>' : '';
    $icon_html = '';

    if ( trim( $title ) != '' ) {
        $link_html = '';
        if ( trim( $link[ 'url' ] ) != '' ) {
            $link_html = '<a href="' . esc_attr( $link[ 'url' ] ) . '" target="' . esc_attr( $link[ 'target' ] ) . '" title="' . esc_attr( $link[ 'title' ] ) . '">' . sanitize_text_field( $title ) . '</a>';
            $title_html .= '<h3 class="title-devider">' . $link_html . '</h3>';
        }
        else {
            $title_html .= '<h3 class="title-devider">' . sanitize_text_field( $title ) . '</h3>';
        }
    }

    if ( trim( $sep_type ) == 'tr-devider-icon' && trim( $icon ) != '' ) {
        if ( $apply_link_to_icon == 'true' && trim( $link[ 'url' ] ) != '' ) {
            $icon_link_html = '<a href="' . esc_attr( $link[ 'url' ] ) . '" target="' . esc_attr( $link[ 'target' ] ) . '" title="' . esc_attr( $link[ 'title' ] ) . '"><span class="' . esc_attr( $icon ) . '"></span></a>';
            $icon_html .= $icon_link_html;
        }
        else {
            $icon_html .= '<span class="' . esc_attr( $icon ) . '"></span>';
        }
    }

    $html .= '<div class="' . esc_attr( $css_class ) . '">
                ' . $title_html . '
                ' . $desc_html . '
                ' . $icon_html . '
            </div>';

    return $html;

}

add_shortcode( 'essence_core_separator', 'essence_core_separator' );
