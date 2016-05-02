<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_Member' );
function essence_core_VC_MAP_Member() {
    global $ts_vc_anim_effects_in;
    vc_map( 
        array(
            'name'        => __( 'Essence Core Member', 'essence-core' ),
            'base'        => 'essence_core_member', // shortcode
            'class'       => '',
            'category'    => __( 'Essence', 'essence-core'),
            'params'      => array(
                array(
                    'type'          => 'attach_image',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Member Image', 'essence-core' ),
                    'param_name'    => 'mem_img',
                    'description'   => __( 'Choose member image', 'essence-core' )
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Image Size', 'essence-core' ),
                    'param_name'    => 'img_size',
                    'std'           => '360x425',
                    'description'   => __( '<em>{width}x{height}</em>. Example: <em>360x425</em>', 'essence-core' )
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Member name', 'essence-core' ),
                    'param_name'    => 'mem_name',
                    'std'           => __( 'Darlene Buchanan', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Member position', 'essence-core' ),
                    'param_name'    => 'mem_pos',
                    'std'           => __( 'Founder & CEO', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Description', 'essence-core' ),
                    'param_name'    => 'desc',
                    'std'           => __( 'Proactively procrastinate market-driven niche markets Energistically provide access to future-proof deliverables and distinctive manufactured products.', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Twitter', 'essence-core' ),
                    'param_name'    => 'twitter',
                    'group'         => __( 'Social Links', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Facebook', 'essence-core' ),
                    'param_name'    => 'facebook',
                    'group'         => __( 'Social Links', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Google Plus', 'essence-core' ),
                    'param_name'    => 'google_plus',
                    'group'         => __( 'Social Links', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Dribbble', 'essence-core' ),
                    'param_name'    => 'dribbble',
                    'group'         => __( 'Social Links', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Behance', 'essence-core' ),
                    'param_name'    => 'behance',
                    'group'         => __( 'Social Links', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Tumblr', 'essence-core' ),
                    'param_name'    => 'tumblr',
                    'group'         => __( 'Social Links', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Instagram', 'essence-core' ),
                    'param_name'    => 'instagram',
                    'group'         => __( 'Social Links', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Pinterest', 'essence-core' ),
                    'param_name'    => 'pinterest',
                    'group'         => __( 'Social Links', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Youtube', 'essence-core' ),
                    'param_name'    => 'youtube',
                    'group'         => __( 'Social Links', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Vimeo', 'essence-core' ),
                    'param_name'    => 'vimeo',
                    'group'         => __( 'Social Links', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Linkedin', 'essence-core' ),
                    'param_name'    => 'linkedin',
                    'group'         => __( 'Social Links', 'essence-core' ),
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
                )
            )
        )
    );
}

function essence_core_member( $atts ) {
    
    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_member', $atts ) : $atts;
    
    extract( shortcode_atts( array(
        'mem_img'           =>  0,
        'img_size'          =>  '360x425',
        'mem_name'          =>  '',
        'mem_pos'           =>  '',
        'desc'              =>  '',
        'twitter'           =>  '',
        'facebook'          =>  '',
        'google_plus'       =>  '',
        'dribbble'          =>  '',
        'behance'           =>  '',
        'tumblr'            =>  '',
        'instagram'         =>  '',
        'pinterest'         =>  '',
        'youtube'           =>  '',
        'vimeo'             =>  '',
        'linkedin'          =>  '',
        'css_animation'     =>  '',
        'animation_delay'   =>  '0.4',   //In second
        'css'               =>  '',
	), $atts ) );
    
    $css_class = 'member-wrap wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;  
    
    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';
    
    $html = '';
    $img_html = '';
    $social_html = '';
    $name_html = '';
    $pos_html = '';
    $desc_html = '';
    
    $img_size_x = 360;
    $img_size_y = 425;
    if ( trim( $img_size ) != '' ) {
        $img_size = explode( 'x', $img_size );
    }
    $img_size_x = isset( $img_size[0] ) ? max( 0, intval( $img_size[0] ) ) : $img_size_x;
    $img_size_y = isset( $img_size[1] ) ? max( 0, intval( $img_size[1] ) ) : $img_size_y;
    
    $img = essence_core_resize_image( $mem_img, null, $img_size_x, $img_size_y, true, true, false );
    
    // Member image html
    $img_html = '<figure><img src="' . esc_url( $img['url'] ) . '" alt=""></figure>';
    
    // Member social links html
    if ( trim( $twitter ) != '' ) {
        $social_html .= '<li>
                            <a href="' . esc_url( $twitter ) . '" target="_blank">
                                <i class="fa fa-twitter"></i>
                                <span class="screen-reader-text">' . __( 'Twitter link', 'essence-core' ) . '</span>
                            </a>
                        </li>';
    }
    if ( trim( $facebook ) != '' ) {
        $social_html .= '<li>
                            <a href="' . esc_url( $facebook ) . '" target="_blank">
                                <i class="fa fa-facebook"></i>
                                <span class="screen-reader-text">' . __( 'Facebook link', 'essence-core' ) . '</span>
                            </a>
                        </li>';
    }
    if ( trim( $google_plus ) != '' ) {
        $social_html .= '<li>
                            <a href="' . esc_url( $google_plus ) . '" target="_blank">
                                <i class="fa fa-google-plus"></i>
                                <span class="screen-reader-text">' . __( 'Google Plus link', 'essence-core' ) . '</span>
                            </a>
                        </li>';
    }
    if ( trim( $dribbble ) != '' ) {
        $social_html .= '<li>
                            <a href="' . esc_url( $dribbble ) . '" target="_blank">
                                <i class="fa fa-dribbble"></i>
                                <span class="screen-reader-text">' . __( 'Dribbble link', 'essence-core' ) . '</span>
                            </a>
                        </li>';
    }
    if ( trim( $behance ) != '' ) {
        $social_html .= '<li>
                            <a href="' . esc_url( $behance ) . '" target="_blank">
                                <i class="fa fa-behance"></i>
                                <span class="screen-reader-text">' . __( 'Behance link', 'essence-core' ) . '</span>
                            </a>
                        </li>';
    }
    if ( trim( $tumblr ) != '' ) {
        $social_html .= '<li>
                            <a href="' . esc_url( $tumblr ) . '" target="_blank">
                                <i class="fa fa-tumblr"></i>
                                <span class="screen-reader-text">' . __( 'Tumblr link', 'essence-core' ) . '</span>
                            </a>
                        </li>';
    }
    if ( trim( $instagram ) != '' ) {
        $social_html .= '<li>
                            <a href="' . esc_url( $instagram ) . '" target="_blank">
                                <i class="fa fa-instagram"></i>
                                <span class="screen-reader-text">' . __( 'Instagram link', 'essence-core' ) . '</span>
                            </a>
                        </li>';
    }
    if ( trim( $pinterest ) != '' ) {
        $social_html .= '<li>
                            <a href="' . esc_url( $pinterest ) . '" target="_blank">
                                <i class="fa fa-pinterest"></i>
                                <span class="screen-reader-text">' . __( 'Pinterest link', 'essence-core' ) . '</span>
                            </a>
                        </li>';
    }
    if ( trim( $youtube ) != '' ) {
        $social_html .= '<li>
                            <a href="' . esc_url( $youtube ) . '" target="_blank">
                                <i class="fa fa-youtube"></i>
                                <span class="screen-reader-text">' . __( 'Youtube link', 'essence-core' ) . '</span>
                            </a>
                        </li>';
    }
    if ( trim( $vimeo ) != '' ) {
        $social_html .= '<li>
                            <a href="' . esc_url( $vimeo ) . '" target="_blank">
                                <i class="fa fa-vimeo"></i>
                                <span class="screen-reader-text">' . __( 'Vimeo link', 'essence-core' ) . '</span>
                            </a>
                        </li>';
    }
    if ( trim( $linkedin ) != '' ) {
        $social_html .= '<li>
                            <a href="' . esc_url( $linkedin ) . '" target="_blank">
                                <i class="fa fa-linkedin"></i>
                                <span class="screen-reader-text">' . __( 'LinkedIn link', 'essence-core' ) . '</span>
                            </a>
                        </li>';
    }
    
    if ( trim( $social_html ) != '' ) {
        $social_html = '<ul class="member-social-links">' . $social_html . '</ul>';
    }
    
    if ( trim( $mem_name ) != '' ) {
        $name_html = '<h5>' . sanitize_text_field( $mem_name ) . '</h5>';
    }
    
    if ( trim( $mem_pos ) != '' ) {
        $pos_html = '<span class="mem-pos">' . sanitize_text_field( $mem_pos ) . '</span>';
    }
    
    if ( trim( $desc ) != '' ) {
        $desc_html = wpautop( $desc );
    }
    
    $html = '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '">
                <div class="member">
                    <div class="mem-top">
                        ' . $img_html . '
                        ' . $social_html . '
                    </div><!-- /.mem-top -->
                    <div class="mem-bottom">
                        ' . $name_html . '
                        ' . $pos_html . '
                        ' . $desc_html . '
                    </div><!-- /.mem-bottom -->
                </div><!-- /.member -->
            </div><!-- /.' . esc_attr( $css_class ) . ' -->';
    
    return $html;
    
}

add_shortcode( 'essence_core_member', 'essence_core_member' );
