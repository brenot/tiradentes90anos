<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_Address' );
function essence_core_VC_MAP_Address() {
    global $ts_vc_anim_effects_in;
    vc_map( 
        array(
            'name'        => __( 'Essence Core Address', 'essence-core' ),
            'base'        => 'essence_core_address', // shortcode
            'class'       => '',
            'category'    => __( 'Essence', 'essence-core'),
            'params'      => array(
                array(
                    'type'          => 'dropdown',
                    'class'         => '',
                    'heading'       => __( 'Style', 'essence-core' ),
                    'param_name'    => 'style',
                    'value' => array(
                        __( 'Style 1', 'essence-core' ) => 'style1',
                        __( 'Style 2', 'essence-core' ) => 'style2'		    
                    ),
                    'std'           => 'style1'
                ),
                array(
                    'type'          => 'textarea_html',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Content', 'helmets-core' ),
                    'param_name'    => 'content',
                    'value'         => __( '<p>17 Princess Road, London,<br>
            								Greater London, NW1 8JR, UK<br>
            								T: 708.783.1124 <br>
            								E: <a href="mailto:contact@essence.com">contact@essence.com</a></p>', 'essence-core' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Location Icon', 'essence-core' ),
                    'param_name'    => 'location_icon',
                    'settings' => array(
        				'emptyIcon' => true, // default true, display an "EMPTY" icon?
        				'type' => 'linea',
        				'iconsPerPage' => 100, // default 100, how many icons per/page to display
        			),
                    'std'           => 'icon-basic-geolocalize-01',
                    'dependency' => array(
    				    'element'   => 'style',
    				    'value' => array( 'style2' )
    			   	),
                ),
                array(
                    'type'          => 'dropdown',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'CSS Animation', 'essence-core' ),
                    'param_name'    => 'css_animation',
                    'value'         => $ts_vc_anim_effects_in,
                    'std'           => 'fadeInUp'
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Animation Delay', 'essence-core' ),
                    'param_name'    => 'animation_delay',
                    'std'           => '0.4',
                    'description'   => __( 'Delay unit is second.', 'essence-core' ),
                    'dependency' => array(
    				    'element'   => 'css_animation',
    				    'not_empty' => true,
    			   	),
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

function essence_core_address( $atts, $content = null ) {
    
    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_address', $atts ) : $atts;
    
    extract( shortcode_atts( array(
        'style'             =>  '',
        'location_icon'     =>  'icon-basic-geolocalize-01',
        'css_animation'     =>  '',
        'animation_delay'   =>  '0.4',   //In second
        'css'               =>  '',
	), $atts ) );
    
    $css_class = 'ts-address-wrap wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;  
    
    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';
    
    if ( function_exists( 'wpb_js_remove_wpautop' ) ) {
        $content = wpb_js_remove_wpautop( $content, true );   
    }
    
    $html = '';
    $icon_html = '';
    
    if ( trim( $location_icon ) != '' && $style == 'style2' ) {
        $icon_html = '<span class="icon ' . esc_attr( $location_icon ) . '"></span>';
    }
    
    $html = '<div class="ts-address address-' . esc_attr( $style ) . '">
				' . $icon_html . '
				<address>
					' . apply_filters( 'the_content', $content ) . '
				</address>
			</div><!-- /.ts-address -->';
   
    $html = '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">
                ' . $html . '
            </div><!-- /.' . esc_attr( $css_class ) . ' -->';
    
    return $html;
    
}

add_shortcode( 'essence_core_address', 'essence_core_address' );
