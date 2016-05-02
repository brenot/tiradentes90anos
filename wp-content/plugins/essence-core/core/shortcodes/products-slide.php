<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_ProductsSlide' );
function essence_core_VC_MAP_ProductsSlide() {
    global $ts_vc_anim_effects_in;
    vc_map( 
        array(
            'name'        => __( 'Essence Core Products Slide', 'essence-core' ),
            'base'        => 'essence_core_products_slide', // shortcode
            'class'       => '',
            'category'    => __( 'Essence', 'essence-core'),
            'params'      => array(
                array(
                    'type'          => 'essence_core_select_product_cat_field',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Select Category', 'essence-core' ),
                    'param_name'    => 'cat_slug',
                    'std'           => 0,
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Images Size', 'essence-core' ),
                    'param_name'    => 'img_size',
                    'std'           => '920x930',
                    'description'   => sprintf( __( 'Format %s. Default <strong>920x930</strong>.', 'essence-core' ), '{width}x{height}' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Number Of Items', 'essence-core' ),
                    'param_name'    => 'number_of_items',
                    'std'           => 3,
                    'description'   => __( 'Maximum number of products will load', 'essence-core' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'class'         => '',
                    'heading'       => __( 'Loop', 'essence-core' ),
                    'param_name'    => 'loop',
                    'value' => array(
                        __( 'Yes', 'essence-core' ) => 'yes',
                        __( 'No', 'essence-core' ) => 'no'		    
                    ),
                    'std'           => 'yes'
                ),
                array(
                    'type'          => 'dropdown',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Autoplay', 'essence-core' ),
                    'param_name'    => 'autoplay',
                    'value' => array(
                        __( 'Yes', 'essence-core' ) => 'yes',
                        __( 'No', 'essence-core' ) => 'no'		    
                    ),
                    'std'           => 'yes',
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Autoplay Timeout', 'essence-core' ),
                    'param_name'    => 'autoplay_timeout',
                    'std'           => 5000,
                    'description'   => __( 'Unit is milliseconds (ms). 1000ms = 1s.', 'essence-core' ),
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


function essence_core_products_slide( $atts ) {
    
    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_products_slide', $atts ) : $atts;
    
    if ( !class_exists( 'WooCommerce' ) ):
        return false;
    endif;
    
    extract( shortcode_atts( array(
        'cat_slug'          =>  '',
        'img_size'          =>  '920x930',
        'number_of_items'   =>  3,
        'loop'              =>  'yes',
        'autoplay'          =>  'yes',
        'autoplay_timeout'  =>  5000,
        'css_animation'     =>  '',
        'animation_delay'   =>  '0.4',  // In second
        'css'               =>  '',
	), $atts ) );
    
    $css_class = 'ts-slide-product-wrap wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;  
    
    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = '0';
    }
    $animation_delay = $animation_delay . 's';
    
    $args = array(
		'post_type'				=> 'product',
		'post_status'			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'showposts' 		    => intval( $number_of_items ),
	);
    
    $cat_slug = trim( $cat_slug );
    if ( $cat_slug != '' ):
        
        $args['tax_query'] = array(
            array(
                'taxonomy'  => 'product_cat',
                'field'     => 'slug',
                'terms'     => $cat_slug
            )
        );
        
    endif;
    
    $html = '';
    
    ob_start();
    
    $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );
    $total_products = $products->post_count;
    $loop = $total_products <= 1 ? 'no' : $loop;
    $autoplay = $total_products <= 1 ? 'no' : $autoplay;
    
    $img_size_x = 920;
    $img_size_y = 930;
    if ( trim( $img_size ) != '' ) {
        $img_size = explode( 'x', $img_size );
    }
    $img_size_x = isset( $img_size[0] ) ? max( 1, intval( $img_size[0] ) ) : $img_size_x;
    $img_size_y = isset( $img_size[1] ) ? max( 1, intval( $img_size[1] ) ) : $img_size_y;
    
    
    ?>
    
    <?php if ( $products->have_posts() ): ?>
        <div class="<?php echo esc_attr( $css_class ); ?>" data-wow-delay="<?php echo esc_attr( $animation_delay ); ?>">
            <div class="essence-owl-carousel ts-slide-product" data-number="1" data-loop="<?php echo esc_attr( $loop ); ?>" data-autoPlayTimeout="<?php echo intval( $autoplay_timeout ); ?>" data-autoPlay="<?php echo esc_attr( $autoplay ); ?>" data-Dots="yes">
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    <?php
                        
                        $img = essence_core_resize_image( null, null, $img_size_x, $img_size_y, true, true, false );
                        $product = new WC_Product( get_the_ID() );
                    ?>
            		<div class="item-slide">
            			<figure><img width="<?php echo esc_attr( $img['width'] ); ?>" height="<?php echo esc_attr( $img['height'] ); ?>" src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php the_title(); ?>" /></figure>
            			<div class="info-product">
            				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            				<span class="price-product"><?php echo $product->get_price_html(); ?></span>
            				<a href="<?php the_permalink(); ?>" class="ts-viewdetail">
                                <span class="icon icon-arrows-slim-right"></span>
                                <span class="screen-reader-text"><?php echo sprintf( __( 'View product "%s" details', 'essence-core' ), get_the_title() ); ?></span>
                            </a>
            			</div>
            		</div>
                <?php endwhile; ?>
            </div><!-- /.ts-slide-product -->
        </div><!-- /.<?php echo esc_attr( $css_class ); ?> -->
    <?php endif; // End if ( $products->have_posts() ) ?>
    
    <?php
    
    wp_reset_postdata();
    
    $html .= ob_get_clean();
    
    return $html;
    
}

add_shortcode( 'essence_core_products_slide', 'essence_core_products_slide' );
