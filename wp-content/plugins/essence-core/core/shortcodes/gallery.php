<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_Gallery' );
function essence_core_VC_MAP_Gallery() {
    global $ts_vc_anim_effects_in;
    vc_map( 
        array(
            'name'        => __( 'Essence Core Gallery', 'essence-core' ),
            'base'        => 'essence_core_gallery', // shortcode
            'class'       => '',
            'category'    => __( 'Essence', 'essence-core'),
            'params'      => array(
                array(
                    'type'          => 'attach_images',
                    //'vc_single_param_edit_holder_class' => '["vc_col-xs-12 vc_column","wpb_el_type_attach_images","vc_wrapper-param-type-attach_images","vc_shortcode-param"]',
                    'class'         => '',
                    'heading'       => __( 'Image Icon', 'essence-core' ),
                    'param_name'    => 'img_ids',
                    'description'   => __( 'Select images from media library.', 'essence-core' )
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'Css', 'essence-core' ),
                    'param_name'    => 'css',
                    'group'         => __( 'Design options', 'essence-core' ),
                )
            )
        )
    );
}

function essence_core_gallery( $atts ) {
    
    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_gallery', $atts ) : $atts;
    
    extract( shortcode_atts( array(
        'img_ids'           =>  '',
        'css'               =>  '',
	), $atts ) );
    
    $css_class = 'ts-gallery-wrap';
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;  
    
    if ( trim( $img_ids ) != '' ) {
        $img_ids = explode( ',', $img_ids );
    }
    else{
        $img_ids = array();
    }
    
    $html = '';
    $items_gallery_html = '';
    
    $gallery_group = uniqid( 'gallery-' );
    
    if ( !empty( $img_ids ) ) {
        foreach ( $img_ids as $img_id ):
            
            $img = essence_core_resize_image( $img_id, null, 460, 460, true, true, false );
            $img_full = essence_core_resize_image( $img_id, null, 4000, 4000, true, true, false );
            
            $items_gallery_html .= '<a class="item-gallery" href="' . esc_url( $img_full['url'] ) . '" data-lightbox="' . esc_attr( $gallery_group ) . '">
                        				<img width="' . esc_attr( $img['width'] ) . '" height="' . esc_attr( $img['height'] ) . '" src="' . esc_url( $img['url'] ) . '" alt="' . esc_attr( get_post_meta( get_post_thumbnail_id( $img_id ), '_wp_attachment_image_alt', true ) ) . '">
                        				<span class="icon-hover"></span>
                        			</a>';
            
        endforeach;
        
        $html = '<div class="ts-gallery">
                    ' . $items_gallery_html . '
                </div><!-- /.ts-gallery -->';
        
    }
    
    $html = '<div class="' . esc_attr( $css_class ) . '">
                ' . $html . '
            </div><!-- /.' . esc_attr( $css_class ) . ' -->';
    
    return $html;
    
}

add_shortcode( 'essence_core_gallery', 'essence_core_gallery' );
