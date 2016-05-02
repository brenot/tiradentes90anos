<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_IconBox' );
function essence_core_VC_MAP_IconBox()
{
    global $ts_vc_anim_effects_in, $elegant_icons, $ts_border_styles;
    vc_map(
        array(
            'name'     => __( 'Essence Core Icon Box', 'essence-core' ),
            'base'     => 'essence_core_icon_box', // shortcode
            'class'    => '',
            'category' => __( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Style', 'essence-core' ),
                    'param_name' => 'style',
                    'value'      => array(
                        __( 'Style 1 - Simple', 'essence-core' )               => 'style1',
                        __( 'Style 2 - Icon hover effect', 'essence-core' )    => 'style2',
                        __( 'Style 3 - Small icon', 'essence-core' )           => 'style3',
                        __( 'Style 4 - Small icon underline', 'essence-core' ) => 'style4',
                    ),
                    'std'        => 'iconbox-style1',
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Icon Library', 'essence-core' ),
                    'param_name' => 'icon_lib',
                    'value'      => array(
                        __( 'Linea', 'essence-core' )       => 'linea',
                        __( 'Elegant', 'essence-core' )     => 'elegant',
                    ),
                    'std'        => 'linea',
                    'group'      => __( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Icon', 'essence-core' ),
                    'param_name' => 'icon',
                    'settings'   => array(
                        'emptyIcon'    => true, // default true, display an "EMPTY" icon?
                        'type'         => 'linea',
                        'iconsPerPage' => 100, // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'icon_lib',
                        'value'   => array( 'linea' ),
                    ),
                    'group'      => __( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Icon', 'essence-core' ),
                    'param_name' => 'icon_elegant',
                    'settings'   => array(
                        'emptyIcon' => true, // default true, display an "EMPTY" icon?
                        'type'      => 'elegant',
                        'source'    => $elegant_icons,
                    ),
                    'dependency' => array(
                        'element' => 'icon_lib',
                        'value'   => array( 'elegant' ),
                    ),
                    'group'      => __( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Icon Color', 'essence-core' ),
                    'param_name' => 'icon_color',
                    'std'        => '#bda47d',
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style1', 'style2', 'style3', 'style4' ),
                    ),
                    'group'      => __( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Icon Background Color', 'essence-core' ),
                    'param_name' => 'icon_bg_color',
                    'std'        => '#fa7468',
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style2' ),
                    ),
                    'group'      => __( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Icon Font Size', 'essence-core' ),
                    'param_name'  => 'font_icon_size',
                    'description' => __( 'Enter value font size for icon. Ex: 40px', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style1', 'style2', 'style3', 'style4' ),
                    ),
                    'group'       => __( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Icon Border Style', 'essence-core' ),
                    'param_name' => 'icon_border_style',
                    'std'        => '',
                    'value'      => array_merge( array( __( ' -- No Border --', 'essence-core' ) => '' ), $ts_border_styles ),
                    'group'      => __( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Icon Border Color', 'essence-core' ),
                    'param_name' => 'icon_border_color',
                    'std'        => '#cccccc',
                    'dependency' => array(
                        'element' => 'icon_border_style',
                        'value'   => array_values( $ts_border_styles ),
                    ),
                    'group'      => __( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Icon Border Radius', 'essence-core' ),
                    'param_name'  => 'icon_border_radius',
                    'std'         => '50%',
                    'description' => __( 'Ex: 50%', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'icon_border_style',
                        'value'   => array_values( $ts_border_styles ),
                    ),
                    'group'       => __( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Icon Padding', 'essence-core' ),
                    'param_name'  => 'icon_padding',
                    'std'         => '0',
                    'description' => __( 'Ex: 15px', 'essence-core' ),
                    'group'       => __( 'Icon', 'essence-core' ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Underline Color', 'essence-core' ),
                    'param_name' => 'underline_color',
                    'std'        => '#bda47d',
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style4' ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Title', 'essence-core' ),
                    'param_name' => 'title',
                    'std'        => __( 'Branding indentity', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'title_font_container',
                    'value'      => '',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => __( 'Enter font size for title.', 'essence-core' ),
                            'color_description'     => __( 'Select  color title.', 'essence-core' ),
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
                    'heading'    => __( 'Short Description', 'essence-core' ),
                    'param_name' => 'short_desc',
                    'std'        => __( 'Proactively procrastinate market-driven niche markets and Energistically provide access to future-proof deliverables and distinctive manufactured products.', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'desc_font_container',
                    'value'      => '',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'color',
                            'font_size_description' => __( 'Enter font size for title.', 'essence-core' ),
                            'color_description'     => __( 'Select  color title.', 'essence-core' ),
                        ),
                    ),
                    'dependency' => array(
                        'element'   => 'short_desc',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'       => 'vc_link',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Link', 'essence-core' ),
                    'param_name' => 'link',
                    'std'        => __( 'Branding indentity', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Show Read More Button', 'essence-core' ),
                    'param_name' => 'show_read_more_btn',
                    'value'      => array(
                        __( 'Yes', 'essence-core' ) => 'yes',
                        __( 'No', 'essence-core' )  => 'no',
                    ),
                    'std'        => 'no',
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Read More Button Text', 'essence-core' ),
                    'param_name' => 'read_more_text',
                    'std'        => __( 'Learn more', 'essence-core' ),
                    'dependency' => array(
                        'element' => 'show_read_more_btn',
                        'value'   => array( 'yes' ),
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Text Align', 'essence-core' ),
                    'param_name' => 'text_align',
                    'value'      => array(
                        __( 'Left', 'essence-core' )   => 'left',
                        __( 'Right', 'essence-core' )  => 'right',
                        __( 'Center', 'essence-core' ) => 'center',
                    ),
                    'std'        => 'center',
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

function essence_core_icon_box( $atts )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_icon_box', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'style'                => 'style1',
                'sep_type'             => 'dashed',
                'icon_lib'             => 'linea',
                'icon'                 => '',
                'icon_elegant'         => '',
                'icon_color'           => '',
                'icon_bg_color'        => '',
                'font_icon_size'       => '',
                'icon_border_style'    => '',
                'icon_border_radius'   => 0,
                'icon_border_color'    => '',
                'icon_padding'         => '',
                'underline_color'      => '',
                'title'                => '',
                'title_font_container' => '',
                'short_desc'           => '',
                'desc_font_container'  => '',
                'link'                 => '',
                'show_read_more_btn'   => '',
                'read_more_text'       => '',
                'text_align'           => 'center',
                'css_animation'        => '',
                'animation_delay'      => '0.4',   //In second
                'css'                  => '',
            ), $atts
        )
    );

    $title_font_container = essence_core_get_font_container_style( $title_font_container );
    $desc_font_container = essence_core_get_font_container_style( $desc_font_container );

    $css_class = 'icon-boxes-wrap wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';

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

    $html = '';
    $title_html = '';
    $icon_html = '';
    $short_desc_html = '';
    $read_more_html = '';

    $class = 'ts-icon-boxes iconbox-' . $style . ' text-' . $text_align;
    $icon_hover_attr = '';

    if ( trim( $title ) != '' ) {
        if ( trim( $link[ 'url' ] ) != '' ) {
            $title_html = '<h4 style="' . $title_font_container . '"><a href="' . esc_url( $link[ 'url' ] ) . '" target="' . esc_attr( $link[ 'target' ] ) . '" title="' . esc_attr( $link[ 'title' ] ) . '">' . sanitize_text_field( $title ) . '</a></h4>';
        }
        else {
            $title_html = '<h4 style="' . $title_font_container . '">' . sanitize_text_field( $title ) . '</h4>';
        }
    }
    
    if ( trim( $icon_lib ) == 'elegant' ) {
        $icon = $icon_elegant;
    }

    if ( trim( $icon ) != '' ) {
        $icon_style = trim( $icon_color ) != '' ? 'color: ' . esc_attr( $icon_color ) . ';' : '';
        $icon_style .= trim( $icon_bg_color ) != '' && $style == 'style2' ? 'background-color: ' . esc_attr( $icon_bg_color ) . ';' : '';
        $icon_style .= trim( $icon_border_style ) != '' ? 'border-style: ' . esc_attr( $icon_border_style ) . '; border-width: 1px;' : '';
        $icon_style .= trim( $icon_border_color ) != '' && trim( $icon_border_style ) != '' ? 'border-color: ' . esc_attr( $icon_border_color ) . ';' : '';
        $icon_style .= trim( $icon_border_radius ) != '' ? 'border-radius: ' . esc_attr( $icon_border_radius ) . ';' : '';
        $icon_style .= trim( $icon_padding ) != '' ? 'padding: ' . esc_attr( $icon_padding ) . ';' : '';

        if ( trim( $icon_style ) != '' ) {
            $icon_style = 'style="' . $icon_style . ';font-size:' . $font_icon_size . ' "';
        }

        $icon_hover_attr = trim( $icon_bg_color ) != '' && $style == 'style2' ? 'data-hover-box-shadow-color="' . essence_core_color_hex2rgba( $icon_bg_color, '0.3' ) . '"' : '';

        $icon_html = '<span class="icon ' . esc_attr( $icon ) . '" ' . $icon_style . '></span>';
    }

    if ( trim( $short_desc ) != '' ) {
        $short_desc_html = '<p style="' . $desc_font_container . '">' . sanitize_text_field( $short_desc ) . '</p>';
    }

    $show_read_more_btn = trim( $show_read_more_btn ) == 'yes';
    if ( trim( $link[ 'url' ] ) != '' && $show_read_more_btn && trim( $read_more_text ) != '' ) {
        $read_more_html = '<a href="' . esc_url( $link[ 'url' ] ) . '" target="' . esc_attr( $link[ 'target' ] ) . '" title="' . esc_attr( $link[ 'title' ] ) . '" class="learn-more">' . sanitize_text_field( $read_more_text ) . '</a>';
    }

    $html = '<div class="' . esc_attr( $class ) . '" ' . $icon_hover_attr . '>
				<div class="iconbox-title">
					' . $icon_html . '
				
                    <div class="iconbox-title-content">
                        ' . $title_html . '
                        <hr class="iconbox-underline" style="border-color: ' . esc_attr( $underline_color ) . ' ">
    				    ' . $short_desc_html . $read_more_html . '
                    </div>
                </div>
			</div><!-- /.' . esc_attr( $class ) . ' -->';

    $html = '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">
                ' . $html . '
            </div><!-- /.' . esc_attr( $css_class ) . ' -->';

    return $html;

}

add_shortcode( 'essence_core_icon_box', 'essence_core_icon_box' );
