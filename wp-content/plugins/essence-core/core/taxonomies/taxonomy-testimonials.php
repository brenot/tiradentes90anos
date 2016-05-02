<?php
/**
 * Custom Taxonomies
 * @package  Nella Core 1.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
  exit;
}

if (!function_exists('north_core_create_taxonomy_testimonial')) {

  function north_core_create_taxonomy_testimonial() {
	// Taxonomy
	$labels = array(
		'name'                       => _x( 'Testimonial Categories', 'Testimonial Categories', 'north-core' ),
		'singular_name'              => _x( 'Testimonial Category', 'Testimonial Category', 'north-core' ),
		'menu_name'                  => __( 'Testimonial Categories', 'north-core' ),
		'all_items'                  => __( 'All Testimonial Categoties', 'north-core' ),
		'parent_item'                => '',
		'parent_item_colon'          => '',
		'new_item_name'              => __( 'New Testimonial Category', 'north-core' ),
		'add_new_item'               => __( 'Add New Testimonial Category', 'north-core' ),
		'edit_item'                  => __( 'Edit Testimonial Category', 'north-core' ),
		'update_item'                => __( 'Update Testimonial Category', 'north-core' ),
		'search_items'               => __( 'Search Testimonial Category', 'north-core' ),
		'add_or_remove_items'        => __( 'Add New or Delete Testimonial Category', 'north-core' ),
		'choose_from_most_used'      => __( 'Choose from most used', 'north-core' ),
		'not_found'                  => __( 'Testimonial category not found', 'north-core' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'hierarchical'               => true
	);
	register_taxonomy( 'testimonial_cat', array( 'testimonial' ), $args );
	//flush_rewrite_rules();
  }
  add_action('init', 'north_core_create_taxonomy_testimonial');
}
