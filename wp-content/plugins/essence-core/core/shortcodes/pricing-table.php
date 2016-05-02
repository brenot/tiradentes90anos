<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'vc_before_init', 'essence_core_pricingTable' );
function essence_core_pricingTable()
{

    global $elegant_icons, $ts_vc_anim_effects_in;

    vc_map(
        array(
            'name'     => esc_html__( 'Essence Core Pricing Table', 'essence-core' ),
            'base'     => 'essence_core_pricing_table',
            'class'    => '',
            'category' => esc_html__( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Style', 'essence-core' ),
                    'param_name' => 'style',
                    'value'      => array(
                        esc_html__( 'Style 1', 'essence-core' ) => 'style1',
                        esc_html__( 'Style 2', 'essence-core' ) => 'style2',
                        esc_html__( 'Style 3', 'essence-core' ) => 'style3',
                    ),
                    'std'        => 'style1',
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Title', 'essence-core' ),
                    'param_name' => 'title',
                    'std'        => esc_html__( 'Pricing Title', 'essence-core' ), 
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Price', 'essence-core' ),
                    'param_name' => 'price',
                    'std'        => esc_html__( '17', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Per', 'essence-core' ),
                    'param_name'  => 'per',
                    'std'         => esc_html__( 'Month', 'essence-core' ),
                    'description' => esc_html__( 'Ex: $17 per month.', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Pricing Unit', 'essence-core' ),
                    'param_name' => 'unit',
                    'std'        => esc_html__( '$', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Unit Position', 'essence-core' ),
                    'param_name' => 'unit_pos',
                    'value'      => array(
                        esc_html__( 'Before Price', 'essence-core' ) => 'before',
                        esc_html__( 'After Price', 'essence-core' )  => 'after',
                    ),
                    'std'        => 'before',
                ),
                array(
                    'type'       => 'textarea',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Description', 'essence-core' ),
                    'param_name' => 'desc',
                    'std'        => esc_html__( 'Billed anually or $19 month-to-month', 'essence-core' ),
                ),
                array(
                    'type'       => 'param_group',
                    'heading'    => esc_html__( 'Pricing List', 'essence-core' ),
                    'param_name' => 'pricing_list',
                    'value'      => urlencode(
                        json_encode(
                            array(
                                array(
                                    'icon' => esc_html__( 'icon-elegant icon_check', 'essence-core' ),
                                    'text' => esc_html__( 'Full access', 'essence-core' ),
                                ),
                                array(
                                    'icon' => esc_html__( 'icon-elegant icon_check', 'essence-core' ),
                                    'text' => esc_html__( 'Documentation', 'essence-core' ),
                                ),
                                array(
                                    'icon' => esc_html__( 'icon-elegant icon_check', 'essence-core' ),
                                    'text' => esc_html__( 'Customers support', 'essence-core' ),
                                ),
                            )
                        )
                    ),
                    'params'     => array(
                        array(
                            'type'        => 'iconpicker',
                            'class'       => '',
                            'holder'      => 'div',
                            'admin_label' => true,
                            'heading'     => esc_html__( 'Icon', 'essence-core' ),
                            'param_name'  => 'icon',
                            'settings'    => array(
                                'emptyIcon' => true, // default true, display an "EMPTY" icon?
                                'type'      => 'elegant',
                                'source'    => $elegant_icons,
                            ),
                        ),
                        array(
                            'type'        => 'textfield',
                            'class'       => '',
                            'holder'      => 'div',
                            'admin_label' => true,
                            'heading'     => esc_html__( 'Text', 'essence-core' ),
                            'param_name'  => 'text',
                        ),
                    ),
                    'group'      => esc_html__( 'Pricing List', 'essence-core' ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Button Text', 'essence-core' ),
                    'param_name' => 'btn_text',
                    'std'        => esc_html__( 'Purchase Now', 'essence-core' ),
                    'group'      => esc_html__( 'Button', 'essence-core' ),
                ),
                array(
                    'type'       => 'font_container',
                    'param_name' => 'btn_font_style',
                    'value'      => 'font_size:14px',
                    'settings'   => array(
                        'fields' => array(
                            'font_size',
                            'font_size_description' => esc_html__( 'Enter button font size.', 'essence-core' ),
                        ),
                    ),
                    'group'       => esc_html__( 'Button', 'essence-core' ),
                ),
                array(
                    'type'       => 'vc_link',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Button Link', 'essence-core' ),
                    'param_name' => 'btn_link',
                    'group'      => esc_html__( 'Button', 'essence-core' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'class'       => '',
                    'holder'      => 'div',
                    'admin_label' => true,
                    'heading'     => esc_html__( 'Button Icon', 'essence-core' ),
                    'param_name'  => 'btn_icon',
                    'std'         => 'icon-elegant arrow_right',
                    'settings'    => array(
                        'emptyIcon' => true, // default true, display an "EMPTY" icon?
                        'type'      => 'elegant',
                        'source'    => $elegant_icons,
                    ),
                    'group'       => esc_html__( 'Button', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Button Icon Position', 'essence-core' ),
                    'param_name' => 'btn_icon_pos',
                    'value'      => array(
                        esc_html__( 'Before', 'essence-core' ) => 'before',
                        esc_html__( 'After', 'essence-core' )  => 'after',
                    ),
                    'std'        => 'after',
                    'group'      => esc_html__( 'Button', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Active Style', 'essence-core' ),
                    'param_name' => 'active_style',
                    'value'      => array(
                        esc_html__( 'Active', 'essence-core' ) => 'active',
                        esc_html__( 'Normal', 'essence-core' ) => 'normal',
                    ),
                    'std'        => 'normal',
                ),
                array(
                    'type'        => 'attach_image',
                    'class'       => '',
                    'heading'     => esc_html__( 'Active Table Image', 'essence-core' ),
                    'param_name'  => 'active_img_id',
                    'description' => esc_html__( 'Select image from media library.', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'active_style',
                        'value'   => 'active',
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Image Rotate', 'essence-core' ),
                    'param_name'  => 'active_img_rotate',
                    'std'         => 0,
                    'dependency'  => array(
                        'element' => 'active_style',
                        'value'   => 'active',
                    ),
                    'description' => esc_html__( 'Rotate angle. Ex: 90.', 'essence-core' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Active Table Image Position', 'essence-core' ),
                    'param_name' => 'active_img_pos',
                    'value'      => array(
                        esc_html__( 'Top Left', 'essence-core' )     => 'top_left',
                        esc_html__( 'Top Right', 'essence-core' )    => 'top_right',
                        esc_html__( 'Bottom Left', 'essence-core' )  => 'bottom_left',
                        esc_html__( 'Bottom Right', 'essence-core' ) => 'bottom_right',
                    ),
                    'std'        => 'top_left',
                    'dependency' => array(
                        'element' => 'active_style',
                        'value'   => 'active',
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Text Align', 'essence-core' ),
                    'param_name' => 'text_align',
                    'value'      => array(
                        esc_html__( 'Left', 'essence-core' )   => 'left',
                        esc_html__( 'Right', 'essence-core' )  => 'right',
                        esc_html__( 'Center', 'essence-core' ) => 'center',
                    ),
                    'std'        => 'left',
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

function essence_core_pricing_table( $atts )
{

    if ( !class_exists( 'Vc_Manager' ) ) {
        return '';
    }

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_pricing_table', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'style'             => 'style1',
                'title'             => '',
                'price'             => '',
                'per'               => '',
                'unit'              => '',
                'unit_pos'          => 'before',
                'desc'              => '',
                'pricing_list'      => '',
                'btn_text'          => '',
                'btn_font_style'    => '',
                'btn_link'          => '',
                'btn_icon'          => '',
                'btn_icon_pos'      => 'after',
                'active_style'      => 'normal',
                'active_img_id'     => 0,
                'active_img_rotate' => 0,
                'active_img_pos'    => 'top_left',
                'text_align'        => 'left',
                'css_animation'     => '',
                'animation_delay'   => '0.4',   //In second
                'css'               => '',
            ), $atts
        )
    );

    $css_class = 'tr-pricing-table ts-pricing-table wow ' . $css_animation . ' tr-pricing-table-' . esc_attr( $style ) . ' tr-pricing-' . esc_attr( $active_style ) . ' text-' . esc_attr( $text_align );
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';

    $html = '';
    $title_html = '';
    $unit_html = '';
    $main_price_html = '';
    $btn_html = '';
    $desc_html = '';
    $active_img_html = '';
    $pricing_list_html = '';

    $unit_html .= trim( $unit ) != '' ? '<span class="price-unit">' . strip_tags( htmlentities2( $unit ) ) . '</span>' : '';
    $desc = trim( $desc ) != '' ? '<div class="desc pricing-desc"><p>' . sanitize_text_field( $desc ) . '</p></div>' : '';

    if ( $unit_pos == 'before' ) {
        $main_price_html = $unit_html . '<span class="price">' . sanitize_text_field( $price ) . '</span>';
    }
    else {
        $main_price_html = '<span class="price">' . sanitize_text_field( $price ) . '</span>' . $unit_html;
    }
    if ( trim( $per ) != '' ) {
        $main_price_html .= '<span class="per-sep"> &frasl; </span>' . sanitize_text_field( $per );
    }

    if ( trim( $main_price_html ) != '' ) {
        $main_price_html = '<h3>' . $main_price_html . '</h3>';
    }

    if ( trim( $active_style ) == 'active' ) {
        if ( intval( $active_img_id ) > 0 ) {
            $img = essence_core_resize_image( $active_img_id, null, 107, 107, false, false, false );
            $active_img_pos = explode( '_', $active_img_pos );
            if ( !isset( $active_img_pos[ 0 ] ) ) {
                $active_img_pos[ 0 ] = 'top';
            }
            if ( !isset( $active_img_pos[ 1 ] ) ) {
                $active_img_pos[ 1 ] = 'left';
            }
            $active_img_rotate = intval( $active_img_rotate ) . 'deg';
            $active_img_style = 'position: absolute; ' . $active_img_pos[ 0 ] . ': 0;' . $active_img_pos[ 1 ] . ': 0;';
            $active_img_style .= '-webkit-transform: rotate(' . esc_attr( $active_img_rotate ) . '); -moz-transform: rotate(' . esc_attr( $active_img_rotate ) . '); -ms-transform: rotate(' . esc_attr( $active_img_rotate ) . '); -o-transform: rotate(' . esc_attr( $active_img_rotate ) . '); transform: rotate(' . esc_attr( $active_img_rotate ) . ');';

            if ( trim( $img[ 'url' ] ) != '' ) {
                $active_img_html .= '<div class="active-img-wrap" style="' . $active_img_style . '">
                                        <img width="' . esc_attr( $img[ 'width' ] ) . '" height="' . esc_attr( $img[ 'height' ] ) . '" src="' . esc_url( $img[ 'url' ] ) . '" alt="' . esc_attr( $title ) . '" />
                                    </div><!-- /.active-img-wrap -->';
            }
        }
    }

    $pricing_list = json_decode( urldecode( $pricing_list ) );

    if ( !empty( $pricing_list ) ) {
        foreach ( $pricing_list as $pricing ) {
            $price_icon = isset( $pricing->icon ) ? '<span class="' . esc_attr( $pricing->icon ) . '"></span>' : '';
            $price_text = isset( $pricing->text ) ? wp_kses( $pricing->text, array( 'a' => array( 'href' => array(), 'target' => array() ) ) ) : '';
            if ( trim( $price_text . $price_icon ) != '' ) {
                $pricing_list_html .= '<li>' . $price_icon . $price_text . '</li>';
            }
        }
        $pricing_list_html = trim( $pricing_list_html ) != '' ? '<ul>' . $pricing_list_html . '</ul>' : '';
    }

    $link_default = array(
        'url'    => '#',
        'title'  => '',
        'target' => '',
    );

    if ( function_exists( 'vc_build_link' ) ):
        $btn_link = vc_build_link( $btn_link );
    else:
        $btn_link = $link_default;
    endif;

    if ( trim( $btn_icon . $btn_text ) != '' ) {
        $btn_icon_html = '';
        if ( trim( $btn_link[ 'url' ] ) == '' ) {
            $btn_link[ 'url' ] = '#';
        }
        if ( trim( $btn_icon ) != '' ) {
            $btn_icon_html = '<span class="' . esc_attr( $btn_icon ) . '"></span>';
        }
        $btn_font_style = essence_core_get_font_container_style( $btn_font_style );

        $btn_html .= trim( $btn_icon_pos ) == 'before' ? $btn_icon_html . '<span>' . sanitize_text_field( $btn_text ) . '</span>' : '<span>' . sanitize_text_field( $btn_text ) . '</span>' . $btn_icon_html;
        $btn_html = '<a class="tr-button btn" href="' . $btn_link[ 'url' ] . '" title="' . $btn_link[ 'title' ] . '" target="' . $btn_link[ 'target' ] . '" style="' . $btn_font_style . '">' . $btn_html . '</a>';
    }

    switch ( $style ):
        case 'style1':
            $title_html .= trim( $title ) != '' ? '<span>' . sanitize_text_field( $title ) . '</span>' : '';

            $css_class .= ' tr-pricing-table1';
            $html .= '<div class="ts-pricing-table-info">
                            ' . $title_html . '
                            ' . $main_price_html . '
                            ' . $desc . '
                        </div><!-- ./ts-pricing-table-info -->';

            if ( trim( $pricing_list_html ) != '' ) {
                $html .= '<div class="feature-unit features-list">' . $pricing_list_html . '</div><!-- ./features-list -->';
            }

            break;
        case 'style2':
            $title_html .= trim( $title ) != '' ? '<h5>' . sanitize_text_field( $title ) . '</h5>' : '';

            $css_class .= ' tr-pricing-table2';
            $html .= '<div class="ts-pricing-table-info">
                            ' . $title_html . '
                            ' . $desc . '
                        </div><!-- ./ts-pricing-table-info -->';
            if ( trim( $pricing_list_html ) != '' ) {
                $html .= '<div class="feature-unit features-list">' . $main_price_html . $pricing_list_html . '</div><!-- ./features-list -->';
            }

            break;

        case 'style3':
            $title_html .= trim( $title ) != '' ? '<span>' . sanitize_text_field( $title ) . '</span>' : '';

            $css_class .= ' tr-pricing-table1';
            $html .= '<div class="ts-pricing-table-info">
                            ' . $title_html . '
                            ' . $main_price_html . '
                        </div><!-- ./ts-pricing-table-info -->';

            if ( trim( $pricing_list_html ) != '' ) {
                $html .= '<div class="feature-unit features-list">' . $pricing_list_html . '</div><!-- ./features-list -->';
            }

            break;

    endswitch;

    if ( trim( $html ) != '' ) {
        $html = '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">'
            . $html . $btn_html . $active_img_html .
            '</div>';
    }

    return $html;
}

add_shortcode( 'essence_core_pricing_table', 'essence_core_pricing_table' );


