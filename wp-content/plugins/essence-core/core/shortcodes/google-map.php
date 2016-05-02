<?php 
add_action( 'vc_before_init', 'essence_core_VC_MAP_Gmap' );
function essence_core_VC_MAP_Gmap() {
    global $ts_vc_anim_effects_in;
    vc_map( 
        array(
            'name'        => __( 'Essence Core Google Map', 'essence-core' ),
            'base'        => 'essence_core_gmap', // shortcode
            'class'       => '',
            'category'    => __( 'Essence', 'essence-core'),
            'params'      => array(
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Map Type', 'essence-core' ),
                    'param_name' => 'map_type',
                    'value' => array(
                        __( 'ROADMAP', 'essence-core' ) => 'ROADMAP',
                        __( 'SATELLITE', 'essence-core' ) => 'SATELLITE',
                        __( 'HYBRID', 'essence-core' ) => 'HYBRID',
                        __( 'TERRAIN', 'essence-core' ) => 'TERRAIN',	    
                    ),
                    'std' => 'ROADMAP',
                    'description' => __( 'ROADMAP displays the default road map view. SATELLITE displays Google Earth satellite images. HYBRID displays a mixture of normal and satellite views. TERRAIN displays a physical map based on terrain information.', 'essence-core' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Hue', 'essence-core' ),
                    'param_name'    => 'hue',
                    'description'   => __( 'An RGB hex string. indicates the basic color.', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Lightness', 'essence-core' ),
                    'param_name'    => 'lightness',
                    'std'           => '1',
                    'description'   => __( 'A floating point value between -100 and 100. Indicates the percentage change in brightness of the element.', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Saturation', 'essence-core' ),
                    'param_name'    => 'saturation',
                    'std'           => '-100',
                    'description'   => __( 'A floating point value between -100 and 100. Indicates the percentage change in intensity of the basic color to apply to the element.', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Address', 'essence-core' ),
                    'param_name'    => 'address',
                    'std'           => '',
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Infomation Title', 'essence-core' ),
                    'param_name'    => 'info_title',
                    'std'           => '',
                    'description'   => __( 'Title of infomation box will show when click on pin icon.', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Phone', 'essence-core' ),
                    'param_name'    => 'phone',
                    'std'           => '',
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Email', 'essence-core' ),
                    'param_name'    => 'email',
                    'std'           => '',
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Website', 'essence-core' ),
                    'param_name'    => 'website',
                    'std'           => '',
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Latitude', 'essence-core' ),
                    'param_name'    => 'latitude',
                    'std'           => '21.582668',
                    'description'   => __( '1. Open <a href="https://www.google.com/maps" target="_blank">Google Maps</a><br />2. Right-click the place or area on the map.<br />3. Select <b>What&#39;s here</b>?<br />4. Under the search box, an info card with coordinates will appear.', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Longitude', 'essence-core' ),
                    'param_name'    => 'longitude',
                    'std'           => '105.807298',
                    'description'   => __( '1. Open <a href="https://www.google.com/maps" target="_blank">Google Maps</a><br />2. Right-click the place or area on the map.<br />3. Select <b>What&#39;s here</b>?<br />4. Under the search box, an info card with coordinates will appear.', 'essence-core' ),
                ),
                array(
                    'type'          => 'attach_image',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Pin Icon', 'essence-core' ),
                    'param_name'    => 'pin_icon',
                    'std'           => '',
                    'description'   => __( 'If not choose, default pin icon will show.', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Zoom', 'essence-core' ),
                    'param_name'    => 'zoom',
                    'std'           => '14',
                    'description'   => __( 'Most roadmap imagery is available from zoom levels 0 to 18.', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Map Height', 'essence-core' ),
                    'param_name'    => 'map_height',
                    'std'           => '555',
                    'description'   => __( 'Map height unit is pixel.', 'essence-core' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'CSS Animation', 'essence-core' ),
                    'param_name'    => 'css_animation',
                    'value'         => $ts_vc_anim_effects_in,
                    'std'           => 'fadeInUp',
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
                ),
            )
        )
    );
}

function essence_core_gmap( $atts ) {
    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_gmap', $atts ) : $atts;
    
    extract( shortcode_atts( array(
        'map_type'          =>  'ROADMAP',
        'hue'               =>  '',
        'lightness'         =>  '',
        'saturation'        =>  '',
        'address'           =>  '',
        'info_title'        =>  '',
        'phone'             =>  '',
        'email'             =>  '',
        'website'           =>  '',
        'longitude'         =>  '',
        'latitude'          =>  '',
        'pin_icon'          =>  '',
        'zoom'              =>  '',
        'map_height'        =>  555,
        'css_animation'     =>  '',
        'animation_delay'   =>  '',
        'css'               =>  '',
	), $atts ) );
    
    $css_class = 'ts-gmaps-wrap wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;
    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = '0';
    }
    $animation_delay = $animation_delay . 's';
    
    $html = '';
    
    $map_id = uniqid( 'google-map-' );
    
    $pin_icon = intval( $pin_icon );
    $pin_icon_url = ESSENCE_CORE_IMG_URL . '/marker.png';
    if ( $pin_icon > 0 ) {
        $pin_img = essence_core_resize_image( $pin_icon, null, 52, 58, false, false );
        $pin_icon_url = isset( $pin_img['url'] ) ? $pin_img['url'] : $pin_icon_url;
        
        if ( trim( $pin_icon_url ) == '' ) {
            $pin_icon_url = ESSENCE_CORE_IMG_URL . '/marker.png';
        }
    }
    
    $info_title = trim( $info_title ) != '' ? sanitize_text_field( $info_title ) : '';
    
    if ( !is_email( sanitize_email( $email ) ) ) {
        $email = '';
    }
    else{
        $email = sanitize_email( $email );
    }
    
    $website = trim( $website ) != '' ? esc_url( $website ) : '';
    
    $html .=    '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">
                    <div id="' . esc_attr( $map_id ) . '" 
            			class="ts-gmaps" 
            			data-hue="' . esc_attr( $hue ) . '" 
            			data-lightness="' . intval( $lightness ) . '" 
            			data-saturation="' . intval( $saturation ) . '" 
            			data-modify-coloring="true" 
            			data-draggable="true" 
            			data-scale-control="true" 
            			data-map-type-control="true" 
            			data-zoom-control="true" 
            			data-pan-control="true" 
                        data-scrollwheel="true"
            			data-address="' . esc_attr( htmlentities2( $address ) ) . '" 
                        data-info_title="' . esc_attr( $info_title ) . '"
                        data-phone="' . esc_attr( sanitize_text_field( $phone ) ) . '"
                        data-email="' . esc_attr( $email ) . '"
                        data-website="' . $website . '"
            			data-longitude="' . esc_attr( $longitude ) . '" 
            			data-latitude="' . esc_attr( $latitude ) . '" 
            			data-pin-icon="' . esc_url( $pin_icon_url ) . '" 
            			data-zoom="' . esc_attr( $zoom ) . '" 
            			style="height: ' . intval( $map_height ) . 'px; width: 100%;" 
            			data-map-type="' . esc_attr( $map_type ) . '">
                    </div><!-- /.ts-gmaps -->
                </div><!-- /.ts-gmaps-wrap -->';
    
    return $html;
    
}

add_shortcode( 'essence_core_gmap', 'essence_core_gmap' );