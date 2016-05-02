<?php
/**
 * Custom Taxonomies
 * @package  Nella Core 1.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
  exit;
}

if (!function_exists('north_core_create_taxonomy_member')) {

  function north_core_create_taxonomy_member() {
	// Taxonomy
	$labels = array(
		'name'                       => _x( 'Member Categories', 'Member Categories', 'north-core' ),
		'singular_name'              => _x( 'Member Category', 'Member Category', 'north-core' ),
		'menu_name'                  => __( 'Member Categories', 'north-core' ),
		'all_items'                  => __( 'All Member Categoties', 'north-core' ),
		'parent_item'                => '',
		'parent_item_colon'          => '',
		'new_item_name'              => __( 'New Member Category', 'north-core' ),
		'add_new_item'               => __( 'Add New Member Category', 'north-core' ),
		'edit_item'                  => __( 'Edit Member Category', 'north-core' ),
		'update_item'                => __( 'Update Member Category', 'north-core' ),
		'search_items'               => __( 'Search Member Category', 'north-core' ),
		'add_or_remove_items'        => __( 'Add New or Delete Member Category', 'north-core' ),
		'choose_from_most_used'      => __( 'Choose from most used', 'north-core' ),
		'not_found'                  => __( 'Member category not found', 'north-core' ),
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
	register_taxonomy( 'member_cat', array( 'member' ), $args );
	//flush_rewrite_rules();
  }
  add_action('init', 'north_core_create_taxonomy_member');
}
