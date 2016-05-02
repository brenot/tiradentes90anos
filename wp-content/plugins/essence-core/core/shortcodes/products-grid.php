<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_ProductsGrid' );
function essence_core_VC_MAP_ProductsGrid() {
    global $ts_vc_anim_effects_in;
    
    $order_by_values = array(
		'',
		__( 'Date', 'essence-core' ) => 'date',
		__( 'ID', 'essence-core' ) => 'ID',
		__( 'Author', 'essence-core' ) => 'author',
		__( 'Title', 'essence-core' ) => 'title',
		__( 'Modified', 'essence-core' ) => 'modified',
		__( 'Random', 'essence-core' ) => 'rand',
		__( 'Comment count', 'essence-core' ) => 'comment_count',
		__( 'Menu order', 'essence-core' ) => 'menu_order',
	);

	$order_way_values = array(
		'',
		__( 'Descending', 'essence-core' ) => 'DESC',
		__( 'Ascending', 'essence-core' ) => 'ASC',
	);
    
    
    vc_map( 
        array(
            'name'        => __( 'Essence Core Products Grid', 'essence-core' ),
            'base'        => 'essence_core_products_grid', // shortcode
            'class'       => '',
            'category'    => __( 'Essence', 'essence-core'),
            'params'      => array(
                array(
					'type' => 'noren_select_product_cat_field', // slug
					'heading' => __( 'Category', 'essence-core' ),
					'param_name' => 'cat_slug',
                    'std' => 0,
					'description' => __( 'Product category list', 'essence-core' ),
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Per page', 'essence-core' ),
					'value' => 12,
					'save_always' => true,
					'param_name' => 'per_page',
					'description' => __( 'How much items per page to show', 'essence-core' ),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Columns', 'essence-core' ),
					'value' => 4,
					'save_always' => true,
					'param_name' => 'columns',
					'description' => __( 'How much columns grid. Min = 2, max = 4.', 'essence-core' ),
				),
                array(
                    'type'          => 'dropdown',
                    'class'         => '',
                    'heading'       => __( 'Show product title', 'essence-core' ),
                    'param_name'    => 'show_product_title',
                    'value' => array(
                        __( 'Always show', 'essence-core' ) => 'always_show',
                        __( 'Show on hover', 'essence-core' ) => 'show_on_hover'		    
                    ),
                    'std'           => 'show_on_hover'
                ),
                array(
                    'type'          => 'dropdown',
                    'class'         => '',
                    'heading'       => __( 'Margin between products', 'essence-core' ),
                    'param_name'    => 'products_margin',
                    'value' => array(
                        __( 'Margin', 'essence-core' ) => 'products-grid-margin',
                        __( 'No margin', 'essence-core' ) => 'products-grid-no-margin'		    
                    ),
                    'std'           => 'products-grid-no-margin'
                ),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order by', 'essence-core' ),
					'param_name' => 'orderby',
					'value' => $order_by_values,
					'save_always' => true,
					'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'essence-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Sort order', 'essence-core' ),
					'param_name' => 'order',
					'value' => $order_way_values,
					'save_always' => true,
					'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'essence-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
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

function essence_core_products_grid( $atts ) {
    global $essence; // Theme options
    
    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_products_grid', $atts ) : $atts;
    
    if ( !class_exists( 'WooCommerce' ) ):
        return '';
    endif;
    
    extract( shortcode_atts( array(
        'cat_slug'              =>  '',
        'per_page'              =>  '',
        'columns'               =>  '',
        'show_product_title'    =>  'show_on_hover',
        'products_margin'       =>  '',
        'orderby'               =>  '',
        'order'                 =>  '',
        'css_animation'         =>  '',
        'animation_delay'       =>  '0.4',   //In second
        'css'                   =>  '',
	), $atts ) );
    
    $css_class = 'ts-products-grid-wrap';
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;  
    
    $html = '';
    
    // Validate columns in [2, 4]
    $columns = max( 2, min( 4, intval( $columns ) ) );
    $current_products_per_row_setting = isset( $essence['woo_products_per_row'] ) ? max( 2, intval( $essence['woo_products_per_row'] ) ) : 3;
    $essence['woo_products_per_row'] = $columns; // Set products per row
    $atts['columns'] = $columns;
    
    // Default ordering args
	$ordering_args = WC()->query->get_catalog_ordering_args( $orderby, $order );
	$meta_query    = WC()->query->get_meta_query();
    
    $query_args    = array(
		'post_type'				=> 'product',
		'post_status' 			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'orderby' 				=> $ordering_args['orderby'],
		'order' 				=> $ordering_args['order'],
		'posts_per_page' 		=> $per_page,
		'meta_query' 			=> $meta_query,
	);
    
    if ( trim( $cat_slug ) != '' ) {
        $query_args['tax_query'] = array(
            array(
				'taxonomy' 		=> 'product_cat',
				'terms' 		=> array_map( 'sanitize_title', explode( ',', $cat_slug ) ),
				'field' 		=> 'slug',
				'operator' 		=> 'IN'
			)
        );
    }
    
    if ( isset( $ordering_args['meta_key'] ) ) {
		$query_args['meta_key'] = $ordering_args['meta_key'];
	}
    
    // Always show title or show on hover?
    $current_show_title_setting = isset( $essence['opt_show_product_title_on_loop'] ) ? $essence['opt_show_product_title_on_loop'] : 'always_show';
    $essence['opt_show_product_title_on_loop'] = trim( $show_product_title );
    
    // Set loop grid
    $current_enable_shop_grid_masonry_setting = isset( $essence['opt_enable_shop_grid_masonry'] ) ? $essence['opt_enable_shop_grid_masonry'] : 0;
    $essence['opt_enable_shop_grid_masonry'] = 0; // Disable grid masonry
    
    $html = essence_core_product_loop( $query_args, $atts, 'product_cat', esc_attr( $products_margin ) );
    
    // Reset old settings
    $essence['opt_enable_shop_grid_masonry'] = $current_enable_shop_grid_masonry_setting;
    $essence['woo_products_per_row'] = $current_products_per_row_setting;
    $essence['opt_show_product_title_on_loop'] = $current_show_title_setting;
    
    // Remove ordering query arguments
	WC()->query->remove_ordering_args();
    
    $html = '<div class="' . esc_attr( $css_class ) . '">
                ' . $html . '
            </div><!-- /.' . esc_attr( $css_class ) . ' -->';
    
    return $html;
    
}

add_shortcode( 'essence_core_products_grid', 'essence_core_products_grid' );
