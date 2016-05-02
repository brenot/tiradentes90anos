<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_PostsSlide' );
function essence_core_VC_MAP_PostsSlide() {
    global $ts_vc_anim_effects_in;
    vc_map( 
        array(
            'name'        => __( 'Essence Core Posts Slide', 'essence-core' ),
            'base'        => 'essence_core_posts_slide', // shortcode
            'class'       => '',
            'category'    => __( 'Essence', 'essence-core'),
            'params'      => array(
                array(
                    'type'          => 'essence_core_select_cat_field',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Select Category', 'essence-core' ),
                    'param_name'    => 'cat_slug', 
                    'std'           => '',
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Images Size', 'essence-core' ),
                    'param_name'    => 'img_size',
                    'std'           => '360x320',
                    'description'   => sprintf( __( 'Format %s. Default <strong>360x320</strong>.', 'essence-core' ), '{width}x{height}' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Number Of Items', 'essence-core' ),
                    'param_name'    => 'number_of_items',
                    'std'           => 12,
                    'description'   => __( 'Maximum number of posts will load', 'essence-core' ),
                ),
                array(
                    'type'          => 'textfield',
                    'holder'        => 'div',
                    'class'         => '',
                    'heading'       => __( 'Items Per Slide', 'essence-core' ),
                    'param_name'    => 'items_per_slide',
                    'std'           => 3,
                    'description'   => __( 'Post per slide on large screen', 'essence-core' ),
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


function essence_core_posts_slide( $atts ) {
    
    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_posts_slide', $atts ) : $atts;
    
    extract( shortcode_atts( array(
        'cat_slug'          =>  '',
        'img_size'          =>  '360x320',
        'number_of_items'   =>  9,
        'items_per_slide'   =>  3,
        'loop'              =>  'yes',
        'autoplay'          =>  'yes',
        'autoplay_timeout'  =>  5000,
        'css_animation'     =>  '',
        'animation_delay'   =>  '0.4',  // In second
        'css'               =>  '',
	), $atts ) );
    
    $css_class = 'ts-slide-post-wrap wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;  
    
    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = '0';
    }
    $animation_delay = $animation_delay . 's';
    
    $args = array(
		'post_type'				=> 'post',
		'post_status'			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'showposts' 		    => intval( $number_of_items ),
	);
    
    $cat_slug = intval( $cat_slug );
    if ( $cat_slug > 0 ):
        
        $args['tax_query'] = array(
            array(
                'taxonomy'  => 'category',
                'field'     => 'slug',
                'terms'     => $cat_slug
            )
        );
        
    endif;
    
    $html = '';
    
    ob_start();
    
    $posts = new WP_Query( $args );
    $total_posts = $posts->post_count;
    $loop = $total_posts <= 1 ? 'no' : $loop;
    $autoplay = $total_posts <= 1 ? 'no' : $autoplay;
    
    $img_size_x = 360;
    $img_size_y = 320;
    if ( trim( $img_size ) != '' ) {
        $img_size = explode( 'x', $img_size );
    }
    $img_size_x = isset( $img_size[0] ) ? max( 1, intval( $img_size[0] ) ) : $img_size_x;
    $img_size_y = isset( $img_size[1] ) ? max( 1, intval( $img_size[1] ) ) : $img_size_y;
    
    $gallery_unid_id = uniqid( 'gallery-' );
    
    ?>
    
    <?php if ( $posts->have_posts() ): ?>
        <div class="<?php echo esc_attr( $css_class ); ?>" data-wow-delay="<?php echo esc_attr( $animation_delay ); ?>">
            <div class="essence-owl-carousel ts-slide-post" data-margin="20" data-number="<?php echo intval( $items_per_slide ); ?>" data-loop="<?php echo esc_attr( $loop ); ?>" data-autoPlayTimeout="<?php echo intval( $autoplay_timeout ); ?>" data-autoPlay="<?php echo esc_attr( $autoplay ); ?>" data-Dots="yes">
                <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
                    <?php
                        $img = essence_core__resize_image( null, null, $img_size_x, $img_size_y, true, true, false );
                        $img_full = essence_core__resize_image( null, null, 2000, 2000, true, true, false );
                    ?>
            		<div class="item-post">
                        <a class="img-post" href="<?php echo esc_url( $img_full['url'] ); ?>" data-lightbox="<?php echo esc_attr( $gallery_unid_id ); ?>">
                            <figure><img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php the_title(); ?>" /></figure>
                            <span class="icon-hover"></span>
                        </a>
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <div class="content-post"><?php echo function_exists( 'essence_get_the_excerpt_max_charlength' ) ? essence_get_the_excerpt_max_charlength( 300 ): get_the_excerpt(); ?></div>
                        <?php if ( function_exists( 'essence_posted_on' ) ): ?>
                            <ul class="entry-meta post-meta">
                    			<?php essence_posted_on(); ?>
                    		</ul><!-- /.entry-meta -->
                        <?php endif; // End if ( function_exists( 'essence_posted_on' ) ) ?>
            		</div>
                <?php endwhile; ?>
            </div><!-- /.ts-slide-post -->
        </div><!-- /.<?php echo esc_attr( $css_class ); ?> -->
    <?php endif; // End if ( $posts->have_posts() ) ?>
    
    <?php
    
    wp_reset_postdata();
    
    $html .= ob_get_clean();
    
    return $html;
    
}

add_shortcode( 'essence_core_posts_slide', 'essence_core_posts_slide' );
